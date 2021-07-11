<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class AD_Page_controller extends CI_Controller {

    public $template = 'adm_template';
    public $module = 'admin.pages.';
    private $pathUrl = 'admin/pages';

    // Aqui é feito a reescrita da classe construtora e a verificação
    // da autenticidade do usuário
    public function __construct()
    {
        parent::__construct();
        
        is_logged();

        $this->load->model("Page_model","Page");
        $this->load->model("Menus_model","Menus");
        $this->load->model("Media_model","Media");
        $this->load->model("Gallery_model","Gallery");
        $this->load->library('Image_handler');
    }

    /**
     * Método invocado depois do método construtor 
     */
    public function index()
    {
        $this->load->view('principal');
    }

    /*
      Metodo para chamar a pagina de cadastro
     */

    public function create()
    {       
        if ($this->input->post()) $this->save();
        $data['menus'] = $this->Menus->get()->data_result;      
        $data['galleries'] = $this->Gallery->get()->data_result;
        $data['ckeditor'] = true;

        load_module(
            $this->module . "create",
            $data,
            $this->template
        );
    }

    public function manage(){

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
        $pages = $this->Page->get($filter);

        // Parâmetros para a biblioteca de paginação
        $config['base_url'] = base_url() . "/" . $this->uri->segment(1) . "/" . $this->uri->segment(2) . "/" . $this->uri->segment(3) . "/";
        $config['total_rows'] = $pages->qtd;
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
        
        $data['pages'] = $pages->data_result;
        load_module(
            $this->module . "list",
            $data,
            $this->template
        );
    }

    public function edit($id)
    {
        if ($this->input->post()) $this->save($id);

        $data['_page'] = $this->Page->get(['id' => $id])->data_result;       
        $data['_page']->content = replaceUrlImg($data['_page']->content);
        $data['menus'] = $this->Menus->get()->data_result;
        $data['galleries'] = $this->Gallery->get()->data_result;
        $menu_id = $this->Menus->get(['page_id' => $data['_page']->id])->data_result;
        $data['menu_id'] = (count($menu_id) > 0) ? $menu_id[0]->id : 0;

        if ($data['_page']->banners) {
            $data['_page']->banners = json_decode($data['_page']->banners);
        }

        $data['ckeditor'] = true;
        load_module(
            $this->module . "edit",
            $data,
            $this->template
        );
    }

    public function save($_id=null)
    {
        $this->load->library('form_validation');

        if ($this->input->post('categories')) {
            $_POST['category'] = true;
        }

        $this->form_validation->set_rules('title','Título','trim|required');
        //$this->form_validation->set_rules('page_category_id','Tipo','trim|required');
        $this->form_validation->set_rules('content','Conteúdo','trim|required');

        //dd($this->input->post());die;
        if ($this->form_validation->run()) {           
            $post = (object) $this->input->post();
            $banners = ['desktop' => '', 'mobile' => ''];
            $path = './assets/img/banners';

            if ($_id) {
                $old_data = $this->Page->get(['id' => $_id])->data_result;       
                $banners = (array) json_decode($old_data->banners);
            }         
           
            if ($_FILES['upload_desktop_banner']['error'] ==0) { 
                $name = 'upload_desktop_banner-' . date_timestamp_get(date_create());
                $file = $this->Media->uploadFile('upload_desktop_banner', $path, $name);  
                $banners['desktop'] = $file['upload_data']['file_name'];
            }

            if ($_FILES['upload_mobile_banner']['error'] ==0 ) {            
                $name = 'upload_mobile_banner-' . date_timestamp_get(date_create());
                $file = $this->Media->uploadFile('upload_mobile_banner', $path, $name);  
                $banners['mobile'] = $file['upload_data']['file_name'];
            }

            if (count($banners) > 0 ) {
                $post->banners = json_encode($banners);
            }

            if ($_id) {
                $id = $this->Page->update($_id, $post); 
            }else {
                $id = $this->Page->insert($post); 
            }  
            
            if($id){
                set_msg('msgOk', "Página {$this->input->post('name')} criada com sucesso!", 'sucess');
                redirect('admin/pages/edit/' . $id);
            }else{
                set_msg('msgOk', 'Não foi possível criar a Página.', 'error');
                redirect("{$this->pathUrl}/create", 'refresh');
            }
        }
    }

    public function update($id)
    {
        $this->load->library('form_validation');

        if ($this->input->post('categories')) {
            $_POST['category'] = true;
        }

        $this->form_validation->set_rules('title','Título','trim|required');
        //$this->form_validation->set_rules('type','Tipo','trim|required');
        $this->form_validation->set_rules('content','Conteúdo','trim|required');

        //dd($this->input->post());die;
        if ($this->form_validation->run()) {           

            $post = (object) $this->input->post();

            $id = $this->Page->update($id, $post);                   
            
            set_msg('msgOk', "Página salva com sucesso", $tipo='sucess');
            redirect('admin/pages/manage');
        }
    }


    public function delete($id)
    {
        if (1 == !user_logged('nivel'))
        {
            exit;
        }

        $this->Page->delete($id);

        set_msg('msgOk', "Página excluída com sucesso", $tipo='sucess');
        redirect('admin/pages/manage');

       
    }

    public function upload_file() {
        $file = [];
        foreach ($_FILES['files'] as $key => $value) {
            $file[$key] = $value[0];
        }        

        $_FILES['upload'] = $file;

        $datasave= [
            'key' => 'upld_',
            'title' => $_FILES['upload']['name'],
        ];
       
        $file = $this->Media->uploadFile('upload', './assets/img/uploads', null, $datasave);        

        $upload = $this->do_upload();

        if($upload['status']){
            $id = $this->Page->insertFile($upload['upload_data']['file_name']);
           
            echo json_encode([
                "status"=>true, 
                "id"=>$id, 
                "file_url" => base_url('assets/img/uploads') .'/'. $upload['upload_data']['file_name'] 
            ]);
        }else{
             echo json_encode(["status"=>false,"msg"=>$upload['error']]);
        }
    }

    public function do_upload()
    {

        $name = date_timestamp_get(date_create()) . '_' . rand ( 1 , 1000 ) ;
        
        $path = './assets/img/uploads';

        if(!is_dir($path)) mkdir($path, 0777, true);

        $retorno_upload = $this->image_handler->upload_file(
            'upload',
            $path,
            $name
        );
        
        return  $retorno_upload;
    }
    
    public function upload_images_carousel($id)
    {
        $fileList = [];

        $files = $this->Page->get(['id' => $id])->data_result[0]->files; 

        if ($files != '') {
            $fileList = json_decode($files);                   
        }

        $file = [];
        foreach ($_FILES['files'] as $key => $value) {
            $file[$key] = $value[0];
        }

        $_FILES['upload'] = $file;
        $upload = $this->do_upload();
        if($upload['status']){
            $file_name = $upload['upload_data']['file_name'];
            
            array_push($fileList, $file_name);
            
            $this->db->where('id', $id);            
            $this->db->update('pages', [
                'files' => json_encode($fileList)
            ]);
            
            echo json_encode([
                "status"=>true, 
                "id" => $id,
                'file'=> $file_name
            ]);

        }else{
             echo json_encode(["status"=>false,"msg"=>$upload['error']]);
        }
    }

    public function delete_file_corousel($id, $file)
    {
        $fileList = [];

        $files = $this->Page->get(['id' => $id])->data_result[0]->files; 

        if ($files != '') {
            $fileList = json_decode($files);       
            $key = array_search($file, $fileList);

            if ($key!==false) {
                delete_midia($fileList[$key], 'img/uploads');
                unset($fileList[$key]);
            }

            $newList = [];

            foreach ($fileList as $v) {
                array_push($newList, $v);
            }

            $this->db->where('id', $id);            
            $this->db->update('pages', [
                'files' => json_encode($newList)
            ]);
            
            redirect('admin/pages/edit/' . $id);
        }
    }

}