<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class AD_Menus_controller extends CI_Controller {

    public $template = 'adm_template';
    public $module = 'admin.menus.';
    private $pathUrl = 'admin/menus';

    // Aqui é feito a reescrita da classe construtora e a verificação
    // da autenticidade do usuário
    public function __construct()
    {
        parent::__construct();
        
        is_logged();

        $this->load->model("Menus_model","Menus");
        $this->load->model("Page_model","Page");
    }

    /**
     * Método invocado depois do método construtor 
     */
    public function index()
    {
        $this->load->view('principal');
    }

    // public function listByMenus($id=null){
    //     if(!$id) return false;
    //     //continuar
    // }

    

    /*
      Metodo para chamar a pagina de cadastro
     */

    public function create(){
        $data = [];
        $data['menus'] = $this->Menus->get()->data_result;
        $data['pages'] = $this->Page->get()->data_result;

        load_module(
            $this->module . "create",
            $data,
            $this->template
        );

    }

    /*
      Método para chamar a pagina de atualização de dados
    */

    public function edit($id){
        $data = [];
        $menus = $this->Menus->get([ 'id' => $id ], false);       
        
        if (1 == $menus->qtd) {           
            
            $data = [];
            $data['menu'] = $menus->data_result[0];
            $data['pages'] = $this->Page->get()->data_result;
            $data['menus'] = $this->Menus->get(['menu_id_is_null' => 'is null'])->data_result;

            load_module(
                $this->module . "edit",
                $data,
                $this->template
            );

        } else {
            echo "errro";
            set_msg('msgOk', "id inválido!", $tipo='error');
            redirect("{$this->pathUrl}/manage");
        }       
    }
    // public function list(){

    //     $data['page_categories'] = $this->Menus->get()->data_result;
    //     load_module(
    //         $this->module . "list",
    //         $data,
    //         $this->template
    //     );
    // }

    /*
      Metodo para listar os dados
     */

    public function manage(){
       
        if($this->input->get()) $filtro = $this->input->get();

        // Quantidade de registro a serem mostrados por páginma
        $filtro['qtd_by_pag'] = 50;        
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
        if ($this->uri->segment(4) == ""){
            $filtro['page_init'] = 0;
        }else{
            $filtro['page_init'] = $this->uri->segment(4);
        }

        // Metodo para selecionar e retornar os dados 
        // mediante os parametros passados
        $dados = !$filtro ? $this->Menus->get() : $this->Menus->get($filtro);

        // Parâmetros para a biblioteca de paginação
        $config['base_url'] = base_url() . "/" . $this->uri->segment(1) . "/" . $this->uri->segment(2) . "/" . $this->uri->segment(3) . "/";
        $config['total_rows'] = $dados->qtd;
        $config['uri_segment'] = 4;
        $config['per_page'] = $filtro['qtd_by_pag'];
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
        
        $data['menus'] = $dados->data_result;

        load_module(
            $this->module . "list",
            $data,
            $this->template
        );
    }

    public function insert(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','Nome','required');

        if ($this->form_validation->run()) {

            $post = (object) $this->input->post();

            if ($this->Menus->get([
                "name"=> $post->name
            ])->qtd > 0) {
                  echo '<br><div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Erro!</strong> Não foi possível realizar o cadastro, já existe um menu cadastrado com esse nome!
                      </div>';
                die;
            }   
        
            $id = $this->Menus->insert($post);

            if($id){
                set_msg('msgOk', "Menu cadastrado com sucesso!", 'sucess');

                print "<script>window.location = '" . base_url() . "{$this->pathUrl}/manage'</script>";
            }
        }else{
            echo get_erros_validation();
            exit();
        }
    }

    public function update()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id','ID','required');
        $this->form_validation->set_rules('name','Nome','required');
        

        if ($this->form_validation->run()) {

            $post = (object) $this->input->post();           
            $id = $this->input->post('id');
            $upate = $this->Menus->update($post, $id);

            if($upate){
                set_msg('msgOk', "Menu atualizado com sucesso!", 'sucess');
                print "<script>window.location = '" . base_url() . "{$this->pathUrl}/manage'</script>";
            }
        }else{
        
           
            echo get_erros_validation();

            exit();
        }
    }

    public function delete($id){        
        if (1 == !user_logged('nivel')) exit;
        
        $pages = $this->Menus->amoutPagesByMenus($id);

        if ($pages->amout > 0) {
            // Sessão para mensagem
            set_msg('msgOk', "Não foi possível excluir esse menu. Há {$pages->amout} páginas(s) vinculado a mesma.",'error');
            redirect("{$this->pathUrl}/manage");

        } else {
            $this->Menus->delete($id);
            set_msg('msgOk', "Menu excluído com sucesso.", $tipo='sucess');
            redirect("{$this->pathUrl}/manage");
        }
    }

    public function status($id, $tipo)
    {
        if ($id == user_logged('id')){
            $mensagem = array(
                'mensagem' => '<br><div class="alert">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                           <strong>Alerta!</strong> Você não pode desativar seu próprio usuário.
                           </div>'
            );
        }
        else{

            if ($tipo == 1) $status = 2;
            else $status = 1;
            

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


    public function get()
    {
       $id = $this->input->get('id');
       $data = $this->Menus->get($id)->data_result;
       print json_encode($data);
    }

}