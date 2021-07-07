<?php

/**
 *  PerfilController é o controlador para o gerenciamento dos dados dos usuarios.
 * Aqui o usuário pode trocar sua senha e outras informações relevantes
 * 
 */
// Verifica se o BASEPATH está definido, caso contrário não carrega o controlador
if (!defined('BASEPATH'))    exit('No direct script access allowed');

class AD_Media_controller extends CI_Controller {

    public $template = 'adm_template';
    public $module = 'admin/media/';

    // Aqui é feito a reescrita da classe construtora e a verificação
    // da autenticidade do usuário
    public function __construct()
    {
        parent::__construct();

        is_logged();

        $this->load->library('Image_handler');
        $this->load->model("Media_model","Media");
        $this->load->model("Gallery_model","Gallery");
    }

    /**
     * Método invocado depois do método construtor 
     */

    /**
     * Método invocado depois do método construtor 
     */
    public function index()
    {
        $this->manage();
    }

    public function manage()
    {        
        $data = [];

        if($this->input->get()) $filter = $this->input->get();

        // Quantidade de registro a serem mostrados por páginma
        $filter['qtd_by_pag'] = 10;

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
        if ($this->uri->segment(4) == "")
        {
            $filter['page_init'] = 0;
        }
        else
        {
            $filter['page_init'] = $this->uri->segment(4);
        }
 
        // Metodo para selecionar e retornar os dados 
        // mediante os parametros passados
        $media = $this->Media->get($filter);

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

        $data['media'] = $media->data_result;

        load_module(
            $this->module . "list",
            $data,
            $this->template
        );
    }

    /*
      Metodo para chamar a pagina de cadastro
     */

    public function create()
    {

       if ($this->input->post()) {
           $this->insert();
       }

        $data = [];

        load_module(
            $this->module . "create",
            $data,
            $this->template
        );

    }

    public function insert()
    {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('title','Título','trim|required');
        $this->form_validation->set_rules('key','Nome','trim|required');

        $data['key'] = $this->input->post('key');
        $data['title'] = $this->input->post('title');
        $data['created_dt'] = date('Y-m-d H:i:s');  

        if($this->form_validation->run()){    
            
            if($_FILES["upload"]["size"] > 0 ){
                $upload = $this->do_upload($data['title']);
                var_dump($upload["status"]);
                if($upload["status"]){

                    $data['file'] = $upload["upload_data"]["file_name"];
                    $id = $this->Media->insert($data);                   
                    set_msg('msgOk', "Mídia cadastrada com sucesso", $tipo='sucess');
                    redirect('admin/media/manage');

                }else{                
                    set_msg('msgErro', $upload['error'], $tipo='error');
                }
            }else{
                set_msg('msgErro', "Imagem é obrigatória!", $tipo='error');
            }
        }
    }

    public function edit($id)
    {
        if ($this->input->post()) {
            $this->update();
        }

        $media = $this->Media->get([ "id" => $id ]);

        if (1 == $media->qtd) {           
            
            $data = [];
            $data['media'] = $media->data_result[0];

            load_module(
                $this->module . "edit",
                $data,
                $this->template
            );
        } else {
            echo "erro";
            set_msg('msgOk', "id inválido!", $tipo='error');
            redirect('admin/media/manage');
        }

    }

    public function update(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('title','Título','trim|required');

        $data['title'] = $this->input->post('title');
        $data['note'] = $this->input->post('note');
        $data['path'] = $this->input->post('path');
        $data['created_dt'] = date('Y-m-d H:i:s');

        $id = $this->input->post('id');

        if ($this->form_validation->run()) {    
            
            if(isset($_FILES['upload']) and $_FILES['upload']['size'] > 0 ){
            
                $upload = $this->Media->uploadFile('upload', $data['path'], $data['title']);
                dd($upload, true);
                if(isset($upload['error'])){
                    set_msg('msgErro', $upload['error'], 'error');
                    redirect('admin/media/manage');
                }
                
                if($upload['status']) $data['file'] = $upload['upload_data']['file_name'];
            }
            
            if($this->Media->update($data, $id)) set_msg('msgOk', 'Mídia alterada com sucesso!', 'sucess');
            else set_msg('msgErro', 'Não foi possível alterar mídia', 'error');
            
            redirect('admin/media/manage');
        }
    }

    public function do_upload($name, $isResponsiveBanner=false, $isBanner=false){
        $name = !$isBanner ? slug($name) . '-' . date_timestamp_get(date_create()) : slug($name);

        if($isResponsiveBanner) {
            $path = './assets/img/banners/mobile';
            if(!is_dir($path)) mkdir($path, 0777, true);

            $retorno_upload = $this->image_handler->upload_file(
                'mobile',
                $path,
                $name
            );

        }else{
            $path = './assets/img/banners';

            if(!is_dir($path)) mkdir($path, 0777, true);

            $retorno_upload = $this->image_handler->upload_file(
                'upload',
                $path,
                $name
            );
        }
        return  $retorno_upload;
    }

    public function get_files_upload($key=null) {

        $filter['key'] = $key;
        $media = $this->Media->get($filter);

        load_module(
            $this->module . "media_list_ajax",
            ['data' => $media->data_result],
           'ajax_template'
        );
    }

    public function delete_file_upload($id) {
        $this->Media->delete($id);

        echo json_encode(['status' => true]);
    }

}