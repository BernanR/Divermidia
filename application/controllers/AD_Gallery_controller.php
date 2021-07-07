<?php

/**
 *  PerfilController é o controlador para o gerenciamento dos dados dos usuarios.
 * Aqui o usuário pode trocar sua senha e outras informações relevantes
 * 
 */
// Verifica se o BASEPATH está definido, caso contrário não carrega o controlador
if (!defined('BASEPATH'))    exit('No direct script access allowed');

class AD_Gallery_controller extends CI_Controller {

    public $template = 'adm_template';
    public $module = 'admin/gallery/';

    // Aqui é feito a reescrita da classe construtora e a verificação
    // da autenticidade do usuário
    public function __construct()
    {
        parent::__construct();

        is_logged();

        $this->load->library('Image_handler');
        $this->load->model("Gallery_model","Gallery");
        $this->load->model("Media_model","Media");
        $this->load->model("Page_model","Page");
        $this->load->library('Image_handler');
    }

    /**
     * Método invocado depois do método construtor 
     */

    /**
     * Método invocado depois do método construtor 
     */
    public function index(){
        $this->manage();
    }

    public function manage() {
        
        $data = [];

        if($this->input->get()) $filter = $this->input->get();

        // Quantidade de registro a serem mostrados por páginma
        $filter['qtd_by_pag'] = 100;

        /**
         * Bibliotecas e ajudantes carregados
         * @filesource system/libraries/pagination.php
         * @filesource application/model/usuariosModel.php
         */
        $this->load->library('pagination');
        
        /**
         * Dados passados por Get, para gerar a paginação
         * Se o segmento 4 existir, o mesmo será passado àos parãmetros
         */
        $filter['page_init'] = $this->uri->segment(4) == "" ? 0 : $this->uri->segment(4);
 
        // Metodo para selecionar e retornar os dados 
        // mediante os parametros passados
        $media = $this->Gallery->get($filter);

        // Parâmetros para a biblioteca de paginação
        $config['base_url'] = base_url() . "/" . $this->uri->segment(1) . "/" . $this->uri->segment(2) . "/" . $this->uri->segment(3) . "/";
        $config['total_rows'] = $media->qtd;
        $config['uri_segment'] = 4;
        $config['per_page'] = $filter['qtd_by_pag'];
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_link'] = 'Início';
        $config['first_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='page-item active'><a class=\"page-link\"  href='javascript:void(0)'>";
        $config['cur_tag_close'] = '</a></li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_link'] = 'Fim';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_link'] = '>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_link'] = '<';
        $config['prev_tag_close'] = '</li>';
        $config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>  ';
        $this->pagination->initialize($config);
        $data['paginacao'] = $this->pagination->create_links();

        $data['galleries'] = $media->data_result;

        load_module(
            $this->module . "list",
            $data,
            $this->template
        );
    }

    /*
      Metodo para chamar a pagina de cadastro
    */

    public function create() {
       if ($this->input->post()) $this->insert();
    
        $data = [];

        load_module(
            $this->module . "create",
            $data,
            $this->template
        );

    }

    public function insert() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title','Título','trim|required');
        $this->form_validation->set_rules('type','Tipo','trim|required');

        if($this->form_validation->run()){    
            $data = (object) [
                'title' => $this->input->post('title'),
                'type' => $this->input->post('type'),
                'created_dt' => date('Y-m-d H:i:s'),
                'description' => $this->input->post('title'),
                'carousel' => $this->input->post('carousel'),
                'lightbox' => $this->input->post('lightbox'),
            ];

            if($this->Gallery->get(['title' => $data->title])->data_result->id){
                set_msg('msgErro',"Já existe uma galeria com o título '{$data->title}'", 'error');
                return redirect("{$this->module}create");
            }

            if(! $id = $this->Gallery->insert($data)){
                set_msg('msgErro', "Não foi possível criar a galeria", 'error');
                return redirect("{$this->module}create");
            }else{
                set_msg('msgOk', "Galeria {$data->title} criada com sucesso!", 'sucess');
                return redirect("{$this->module}edit/{$id}");
            }
        }
    }

    public function edit($id)
    {
        if ($this->input->post()) $this->update();        

        $search = $this->Gallery->get([ "id" => $id ]);

        if ($search->qtd) {
            $data['gallery'] = $search->data_result[0];      
            $data['medias'] = json_decode($data['gallery']->json);
            if (!$data['medias']) $data['medias'] = [];           
            $data['counter'] = $data['medias'] ? count($data['medias']) - 1 : 0;

            $page = ($data['gallery']->type == 1) ? 'img_edit' : 'video_edit';

            //if($data['gallery']->type == 1) 
            $data['medias'] = orderGalleryJson($data['medias']);

            load_module(
                $this->module . $page,
                $data,
                $this->template
            );

        } else {
            set_msg('msgOk', "id inválido!", $tipo='error');
            redirect("{$this->module}manage");
        }
    }

    public function delete($id){
        $gallery = $this->Gallery->get([ "id" => $id ])->data_result[0];
        if(!$gallery){
            set_msg('msgOk', "ID inválido!", $tipo='error');
            redirect("{$this->module}manage");
        }

        if(!$this->Gallery->update(['deleted' => true], $id))
            set_msg('msgOk', "Erro ao excluir galeria!", $tipo='error');
        else
            $this->Page->removerGaleria($id);
            set_msg('msgOk', "Galeria excluída com sucesso!", $tipo='sucess');

        redirect("{$this->module}manage");

    }

    public function delete_video($galleryID, $key){
        
        $gallery = $this->Gallery->get(['id' => $galleryID])->data_result[0];
        if(!$gallery){
            set_msg('msgOk', "id inválido!", $tipo='error');
            redirect("{$this->module}manage");
        }
        $medias = json_decode($gallery->json);

        $arr = [];
        foreach ($medias as $index => $media) if(removeBar(parse_url( $media->key)['path']) !== $key) array_push($arr, $media);

        if(!$this->Gallery->update(['json'=> json_encode($arr)], $gallery->id)) set_msg('msgOk', "Não foi possível exlcuir a mídia!", $tipo='error');
        else set_msg('msgOk', "Mídia excluída, da galeria {$gallery->title} com sucesso!", $tipo='sucess');
        
        redirect("{$this->module}edit/$galleryID");
    }


    public function delete_file($galleryID, $file){

        $gallery = $this->Gallery->get(['id' => $galleryID])->data_result[0];

        if(!$gallery){
            set_msg('msgOk', "id inválido!", $tipo='error');
            redirect("admin/gallery/edit/" . $galleryID);
        }
        $medias = json_decode($gallery->json);

        $array = [];
        foreach ($medias as $media) if($media->file !== $file) array_push($array, $media);
        
        $save = $this->Gallery->update(['json' => json_encode($array)], $galleryID); 

        redirect("admin/gallery/edit/" . $galleryID);
    }

    public function update(){

        $this->load->library('form_validation');        
        
        $this->form_validation->set_rules('title','Título','trim|required');

        $data['title'] = $this->input->post('title');
        $data['updated_dt'] = date('Y-m-d H:i:s'); 
        $data['lightbox'] = ($this->input->post('lightbox')) ? 1: 0;
        $data['carousel'] = ($this->input->post('carousel')) ? 1: 0;
        
        $id = $this->input->post('id');
        
        if ($this->input->post('medias')) {
            $type = $this->input->post('type');
            $medias = $type == 1 ? $this->tratamento_img($this->input->post('medias'), $id) : $this->tratamento_videos($this->input->post('medias'), $id);
            $data['json'] = json_encode($medias);
        }               

        if ($this->form_validation->run()) {  
            if($this->Gallery->update($data, $id)) set_msg('msgOk', 'Mídia alterada com sucesso!', 'sucess');
            else set_msg('msgErro', 'Não foi possível alterar mídia', 'error');
            
            
            redirect("admin/gallery/edit/" . $id);
        }else{
            
        }
    }

    private function tratamento_videos($videosArr, $gID){//trata as ARRAYS de inserção de vídeos
        $gallery = $this->Gallery->get(['id' => $gID])->data_result;
        
        $medias = json_decode($gallery[0]->json);

        $arr = [];

        foreach ($videosArr as $m) {
            if(!isset($m['key']) || !$m['key']) {
                $m['key'] = date_timestamp_get(date_create());
            }
            array_push($arr, (array)$m);
        }
        
        return $arr;
    }

    private function tratamento_img($images, $galleryID) {
        $gallery = $this->Gallery->get(['id' => $galleryID])->data_result;
        
        $medias = json_decode($gallery[0]->json);
        $orders = [];

        foreach ($medias as $media) {
            $file = explode(".", $media->file)[0];
            foreach ($images as $key => $img) {
                
                if ($file == $key) {
                    $media->title = $img['title'];
                    $media->ordem = $img['ordem'];
                    array_push($orders, $media->ordem);
                }
            }
        }

        $array = [];
        
        foreach ($medias as $value) array_push($array, (array) $value);                
        
        return $array;
    }
    public function upload_image($galleryID){
        
        $gallery = $this->Gallery->get(['id' => $galleryID])->data_result;

        if (count($gallery) > 0) {
            $medias = json_decode($gallery[0]->json);
            
            if (!$medias) $medias = [];
        } else {
            $medias = [];
        }

        $upload = $this->upload_file();
        
        if ($upload['status']) {
            unset($upload['status']);
            $upload['title'] = '';
            $upload['key'] = explode(".", $upload['file'])[0];

            array_push($medias, $upload);
            //echo '<pre>'; print_r($medias); echo '</pre>'; die;
            $data['json'] = json_encode($medias);
        } else  {
            echo json_encode(["status"=>false,"msg"=> $upload['error']]);
            die;
        }

        // dd($data, true);
 
        $this->Gallery->update($data, $galleryID);  

        echo json_encode([
            "status"=>true, 
            "id"=> $galleryID, 
            "file_url" => base_url('assets/img/uploads') .'/'. $upload['file'] 
        ]);

    }

    public function upload_file() {
       
        $file = [];
        foreach ($_FILES['files'] as $key => $value) {
            $file[$key] = $value[0];
        }

        $_FILES['upload'] = $file;       
        $file = $this->Media->uploadFile('upload', './assets/img/gallery');

        if($file['status']){
            return [
                "status"=>true,
                "file" => $file['upload_data']['file_name']
            ];

        }else{
            return ["status"=>false,"msg"=> $file['error']];
        }
    }

}