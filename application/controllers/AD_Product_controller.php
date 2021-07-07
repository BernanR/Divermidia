<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class AD_Product_controller extends CI_Controller {

    public $template = 'adm_template';
    public $module = 'admin.products.';

    // Aqui é feito a reescrita da classe construtora e a verificação
    // da autenticidade do usuário
    public function __construct()
    {
        parent::__construct();
        
        is_logged();

        $this->load->model("Brand_model","Brand");
        $this->load->model("Category_model","Category");
        $this->load->model("Product_model","Product");
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
        if ($this->input->post()) $this->insert();

        $data['categories'] = $this->Category->get()->data_result;
        $data['brands'] = $this->Brand->getBrandCategories();
        $data['ckeditor'] = true;

        load_module(
            $this->module . "create",
            $data,
            $this->template
        );
    }

    public function manage()
    {
        // Gerar Logs
        // $this->load->library('my_log');
        // $logs = new MY_Log();
        // $logs->setLogPath(APPPATH . "logs/" . $this->session->userdata('nome') . "/");
        // $logs->write_log('info', "O usuario acessou a area de atualizacao de dados de seu perfil");

        $data = [];

        if($this->input->get()) $filter = $this->input->get();

        // Quantidade de registro a serem mostrados por páginma
        $filter['qtd_by_pag'] = 50;

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
        $product = $this->Product->get($filter);

        //dd($dados);

        // Parâmetros para a biblioteca de paginação
        $config['base_url'] = base_url() . "/" . $this->uri->segment(1) . "/" . $this->uri->segment(2) . "/" . $this->uri->segment(3) . "/";
        $config['total_rows'] = $product->qtd;
        $config['uri_segment'] = 4;
        $config['per_page'] = $filter['qtd_by_pag'];
        $config['first_tag_open'] = '<li class="page-item page-link">';
        $config['first_link'] = 'Início';
        $config['first_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='page-item active'><a class=\"page-link\"  href='javascript:void(0)'>";
        $config['cur_tag_close'] = '</a></li>';
        $config['last_tag_open'] = '<li class="page-item page-link">';
        $config['last_link'] = 'Fim';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item page-link">';
        $config['next_link'] = '>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li class="page-item page-link">';
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item page-link">';
        $config['prev_link'] = '<';
        $config['prev_tag_close'] = '</li>';
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>  ';
        $this->pagination->initialize($config);
        $data['paginacao'] = $this->pagination->create_links();

        $data['products'] = $product->data_result;
        $data['categories'] = $this->Category->get()->data_result;
        load_module(
            $this->module . "list",
            $data,
            $this->template
        );
    }

    public function edit($id)
    {
        if ($this->input->post()) $this->update();
       
        $product = $this->Product->get([ "id" => $id ]);

        if (1 == $product->qtd) {           
            
            $data = [];
            $data['product'] = $product->data_result[0];
            $data['product']->categories = $this->Product->getCategories($id, $list=true);
            $data['categories'] = $this->Category->get()->data_result;
            $data['brands'] = $this->Brand->getBrandCategories();
            $data['ckeditor'] = true;

            load_module(
                $this->module . "edit",
                $data,
                $this->template
            );


        } else {
            echo "errro";
            set_msg('msgOk', "id inválido!", $tipo='error');
            redirect('product/gerenciar');
        }

    }

    public function insert()
    {
        $this->load->library('form_validation');

        if ($this->input->post('categories')) {
            $_POST['category'] = true;
        }

        $this->form_validation->set_rules('name','Nome','trim|required');
        $this->form_validation->set_rules('resume','Breve descrição','trim');
        $this->form_validation->set_rules('brand','Marca','trim|required');
        $this->form_validation->set_rules('description','Descrição','trim|required');
        $this->form_validation->set_rules('category','Categoria','trim|required');
        $this->form_validation->set_rules('title','Título','trim|required');
        $this->form_validation->set_rules('keywords','Palavras Chaves','trim');

        //dd($this->input->post());die;
        if ($this->form_validation->run()) {           

            $post = (object) $this->input->post(); 
            $name_file = $this->Product->getLastId()->id;
            $name_file = $post->name . '_' . ($name_file + 1);

            if($_FILES["upload"]["size"] > 0 ){

                $upload = $this->do_upload($name_file);
               
                if($upload["status"]){

                    $post->file = $upload["upload_data"]["file_name"];
                    $id = $this->Product->insert($post);                 
                    
                    set_msg('msgOk', "Produto cadastrado com sucesso", $tipo='sucess');
                    redirect('admin/products/create');

                }else{                
                    set_msg('msgErro', $upload['error'], $tipo='error');
                }
            }else{
                set_msg('msgErro', "Imagem é obrigatória!", $tipo='error');
            }
        }
    }

    public function update()
    {
        $this->load->library('form_validation');

        if ($this->input->post('categories')) {
            $_POST['category'] = true;
        }

        $this->form_validation->set_rules('id','ID','trim|required');
        $this->form_validation->set_rules('name','Nome','trim|required');
        $this->form_validation->set_rules('brand','Marca','trim|required');
        $this->form_validation->set_rules('resume','Breve descrição','trim');
        $this->form_validation->set_rules('description','Descrição','trim|required');
        $this->form_validation->set_rules('category','Categoria','trim|required');
        $this->form_validation->set_rules('title','Título','trim|required');

        if($this->form_validation->run()){
            $post = (object)  $this->input->post();
            $id = $post->id;            

            if($_FILES["upload"]["size"] > 0 ){

                $name_file = $this->Product->getLastId()->id;
                $name_file = $post->name . '_' . ($name_file + 1);
                $upload = $this->do_upload($name_file);
               
                if($upload["status"]){

                    $post->file = $upload["upload_data"]["file_name"];
                    $this->Product->update($post, $id);
                    
                    set_msg('msgOk', "Produto alterado com sucesso", $tipo='sucess');
                    redirect(current_url());

                }else{                
                    set_msg('msgErro', $upload['error'], $tipo='error');
                }
            }else{

                $this->Product->update($post, $id);
                
                set_msg('msgOk', "Produto alterado com sucesso", $tipo='sucess');
                redirect(current_url());
            }
        }
    }


    public function do_upload($name)
    {

        $name = slug($name);       
        
        $path = './assets/img/products';

        if(!is_dir($path)) mkdir($path, 0777, true);

        $retorno_upload = $this->image_handler->upload_file(
            'upload',
            $path,
            $name
        );

        return  $retorno_upload;

    }


    public function delete($id)
    {
            
        /**
         * Somente administradores podem excluir os dados dos alunos
         */
        if (!user_logged('nivel') == 1)
        {
            exit;
        }

        /*
         * Descriptografa o id
         */

        $this->Product->delete($id);
    
        // Sessão para mensagem
        set_msg('msgOk', "Produto excluído com sucesso!", $tipo='sucess');
        redirect('admin/products/manage', 'refresh');
    }

    public function upload_images_adicionais($id)
    {
        $fileList = [];

        $product = $this->Product->get(['id' => $id])->data_result[0]; 
        $files = $product->additional_files;

        if ($files != '') {
            $fileList = json_decode($files);                   
        }

        $file = [];
        foreach ($_FILES['files'] as $key => $value) {
            $file[$key] = $value[0];
        }

        $_FILES['upload'] = $file;

        $name =  $product->name . '__' . date_timestamp_get(date_create()) . '_' . rand ( 1 , 1000 ) ;
        $upload = $this->do_upload($name);

        if($upload['status']){
            $file_name = $upload['upload_data']['file_name'];
            
            array_push($fileList, $file_name);
            
            $this->db->where('id', $id);            
            $this->db->update('products', [
                'additional_files' => json_encode($fileList)
            ]);
            
            echo json_encode([
                "status"=>true, 
                "id" => $id,
                'file'=> $file_name
            ]);

        }else{
             echo json_encode(["status"=>false, "msg"=>$upload['error']]);
        }
    }

    public function delete_file_adicionais($id, $file)
    {
        $fileList = [];

        $product = $this->Product->get(['id' => $id])->data_result[0]; 
        $files = $product->additional_files;

        if ($files != '') {
            $fileList = json_decode($files);       
            $key = array_search($file, $fileList);
           
            if ($key!==false) {
                delete_midia($fileList[$key], 'img/products');
                unset($fileList[$key]);                
            }

            $newList = [];

            foreach ($fileList as $v) {
                array_push($newList, $v);
            }

            $this->db->where('id', $id);            
            $this->db->update('products', [
                'additional_files' => json_encode($newList)
            ]);

            //
            
           redirect('admin/products/edit/' . $id);
        }
    }
}