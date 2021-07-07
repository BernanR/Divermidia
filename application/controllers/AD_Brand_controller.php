<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class AD_Brand_controller extends CI_Controller {

    public $template = 'adm_template';
    public $module = 'admin.brands.';

    // Aqui é feito a reescrita da classe construtora e a verificação
    // da autenticidade do usuário
    public function __construct()
    {
        parent::__construct();
        
        is_logged();

        $this->load->model("Brand_model","Brand");
        $this->load->model("Category_model","Category");
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

        // Gerar Logs
        // $this->load->library('my_log');
        // $logs = new MY_Log();
        // $logs->setLogPath(APPPATH . "logs/" . $this->session->userdata('nome') . "/");
        // $logs->write_log('info', "O usuario acessou a area de cadastro de turmas");
        $data = [];
        $data['categories'] = $this->Category->get()->data_result;
        load_module(
            $this->module . "create",
            $data,
            $this->template
        );

    }

    /*
      Método para chamar a pagina de atualização de dados
     */

    public function edit($id)
    {
        // Gerar Logs
        // $this->load->library('my_log');
        // $logs = new MY_Log();
        // $logs->setLogPath(APPPATH . "logs/" . $this->session->userdata('nome') . "/");
        // $logs->write_log('info', "O usuario acessou a area de cadastro de turmas");
        $data = [];

        $brand = $this->Brand->get([ 'id' => $id ], false);
        if (1 == $brand->qtd) {           
            
            $data = [];
            $data['brand'] = $brand->data_result[0];
            $data['brand']->categories = $this->Brand->getCategories($id, $list=true);
            $data['categories'] = $this->Category->get()->data_result;
            load_module(
                $this->module . "edit",
                $data,
                $this->template
            );


        } else {
            echo "errro";
            set_msg('msgOk', "id inválido!", $tipo='error');
            redirect('admin/brands/manage');
        }       
    }

    /*
      Metodo para listar os dados
     */

    public function manage()
    {
        
        // Gerar Logs
        // $this->load->library('my_log');
        // $logs = new MY_Log();
        // $logs->setLogPath(APPPATH . "logs/" . user_logged('nome') . "/");
        // $logs->write_log('info', "O usuario acessou a area de listagem de usuarios");

        /**
         * Dados passados por Get, para busca
         * Se existir dados get, inicia a variável com eles
         */
        
        if($this->input->get()) $filtro = $this->input->get();


        // Quantidade de registro a serem mostrados por páginma
        $filtro['qtd_por_pag'] = 10;

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
            $filtro['page_init'] = 0;
        }
        else
        {
            $filtro['page_init'] = $this->uri->segment(4);
        }

        // Metodo para selecionar e retornar os dados 
        // mediante os parametros passados
        $brands = $this->Brand->get($filtro, false);

        //dd($dados);

        // Parâmetros para a biblioteca de paginação
        $config['base_url'] = base_url() . "/" . $this->uri->segment(1) . "/" . $this->uri->segment(2) . "/" . $this->uri->segment(3) . "/";
        $config['total_rows'] = $brands->qtd;
        $config['uri_segment'] = 4;
        $config['per_page'] = $filtro['qtd_por_pag'];
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
        $data['brands'] = $brands->data_result;

        load_module(
            $this->module . "list",
            $data,
            $this->template
        );
    }

    public function insert(){

        $this->load->library('form_validation');

        if ($this->input->post('categories')) {
            $_POST['category'] = true;
        }

        $this->form_validation->set_rules('name','Nome','required');
        $this->form_validation->set_rules('category','Categoria','trim|required');

        if ($this->form_validation->run()) {
            
            $post = (object) $this->input->post();

            if ($this->Brand->get([
                "name"=> $post->name
            ])->qtd > 0) {

                  echo '<br><div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Erro!</strong> Não foi possível realizar o cadastro, já existe uma categoria cadastrada com esse nome!
                      </div>';

                die;
            }

            $status = true;

            if(isset($_FILES['upload_desktop']) and $_FILES['upload_desktop']['size'] > 0){
                $upDesktop = $this->upload_banner($post->name, false);
                
                if(isset($upDesktop['error'])) {
                    set_msg('mensagem', $upDesktop['error'], 'error');
                    $status = false;
                }else{
                    $post->banner = $upDesktop['upload_data']['file_name'];
                }
            }

            if(isset($_FILES['upload_mobile']) and $_FILES['upload_mobile']['size'] > 0 and $status){
                $upMobile = $this->upload_banner($post->name, true);
                
                if(isset($upMobile['error'])) {
                    set_msg('mensagem', $upMobile['error'], 'error');
                    $status = false;
                }
                else{
                    $post->banner_mobile = $upMobile['upload_data']['file_name'];
                }

            }




            $id = $this->Brand->insert($post);

            if($id){
                // Gerar Logs
                // $this->load->library('my_log');
                // $logs = new MY_Log();
                // $logs->setLogPath(APPPATH . "logs/" . user_logged('nome') . "/");
                // $logs->write_log('info', "O usuario cadastrou uma nova turma com o id: " . $id);


                set_msg('msgOk', "Marca {$post->name} cadastrada com sucesso!", $tipo='sucess');
                print "<script>window.location = '" . base_url() . "admin/brands/manage'</script>";                
                die;
                // echo '<br><div class="alert alert-success">
                //       <button type="button" class="close" data-dismiss="alert">&times;</button>
                //       <strong>Sucesso!</strong> Tuma cadastrado com sucesso.
                //       </div>';
                //echo '<script>$("#form").resetForm();</script>';
            }
        }else{
            echo get_erros_validation();
            die;
        }
    }

    public function update()
    {

        $this->load->library('form_validation');

        if ($this->input->post('categories')) {
            $_POST['category'] = true;
        }

        $this->form_validation->set_rules('name','Nome','required');
        $this->form_validation->set_rules('category','Categoria','trim|required');

        if ($this->form_validation->run()) {
            $status = true;
            $post = (object) $this->input->post();

            if(isset($_FILES['upload_desktop']) and $_FILES['upload_desktop']['size'] > 0){
                $upDesktop = $this->upload_banner($post->name, false);
                
                if(isset($upDesktop['error'])) {
                    set_msg('msgOk', $upDesktop['error'], 'error');
                    $status = false;
                }
                else{
                    $post->banner = $upDesktop['upload_data']['file_name'];
                }
            }

            if(isset($_FILES['upload_mobile']) and $_FILES['upload_mobile']['size'] > 0 and $status){
                $upMobile = $this->upload_banner($post->name, true);
                
                if(isset($upMobile['error'])) { 
                    set_msg('msgOk', $upMobile['error'], 'error');
                    $status = false;
                }
                else{
                    $post->banner_mobile = $upMobile['upload_data']['file_name'];
                }
            }

            if($status) $id = $this->Brand->update($post->id, $post);

            if(!$id) $status = false;

            if($status){
                
                set_msg('msgOk', "Marca {$post->name} atualizada com sucesso!", $tipo='sucess');
                print "<script>window.location = '" . base_url() . "admin/brands/manage'</script>";                
                die;
            }else{
                set_msg('msgOk', "Marca atualizada com sucesso!", $tipo='sucess');
            }
        }else{
            echo get_erros_validation();
            die;
        }
    }

    public function delete($id)
    {
            
        /**
         * Somente administradores podem excluir os dados dos alunos
         */
        if (1 == !user_logged('nivel'))
        {
            exit;
        }


        $products = $this->Brand->amoutProductByBrand($id);

        if ($products->amout > 0) {
            // Sessão para mensagem
            set_msg('msgs', "Não foi possível excluir essa marca, há {$products->amout} produto(s) vinculado a mesma.", $tipo='error');
            redirect('admin/brands/manage');

        } else {

            $retorno = $this->Brand->delete($id);
            set_msg('msgs', "Marca excluída com sucesso.", $tipo='sucess');
            redirect('admin/brands/manage');
        }
    }

    public function status($id, $tipo)
    {
        if ($id == user_logged('id'))
        {
            $mensagem = array(
                'mensagem' => '<br><div class="alert">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                           <strong>Alerta!</strong> Você não pode desativar seu próprio usuário.
                           </div>'
            );
        }
        else
        {

            if ($tipo == 1)
            {
                $status = 2;
            }
            else
            {
                $status = 1;
            }

            /*
             * Descriptografa o id
             */
            $this->User->Editar(["status" => $status],$id);

            // Gerar Logs
            // $this->load->library('my_log');
            // $logs = new MY_Log();
            // $logs->setLogPath(APPPATH . "logs/" . user_logged('nome') . "/");
            // $logs->write_log('info', "O usuario mudou o status do usuário com ID: " . $id);

            $mensagem = array(
                'mensagem' => '<br><div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                           <strong>Sucesso!</strong> Status atualizado.
                           </div>'
            );
        }

        // Sessão para mensagem
         // Sessão para mensagem
        set_msg('msgOk', "<strong>Sucesso!</strong> Status atualizado.", $tipo='sucess');
        redirect('usuarios/gerenciar', 'refresh');
    }

    public function upload_banner($name, $isResponsive){

        $name = slug($name);       
            
        if($isResponsive) {
            $path = './assets/img/banners/brands/mobile';
            if(!is_dir($path)) mkdir($path, 0777, true);
            $name .= '_mobile';

            
            return $this->image_handler->upload_file(
                'upload_mobile',
                $path,
                $name
            );
        }else{
            $path = './assets/img/banners/brands';
            
            if(!is_dir($path)) mkdir($path, 0777, true);
            
            return $this->image_handler->upload_file(
                'upload_desktop',
                $path,  
                $name
            );
        }
        
        
    }
}