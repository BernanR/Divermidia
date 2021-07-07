<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class AD_Usuarios_controller extends CI_Controller {

    public $template = 'adm_template';
    public $module = 'admin.usuarios.';

    // Aqui é feito a reescrita da classe construtora e a verificação
    // da autenticidade do usuário
    public function __construct()
    {
        parent::__construct();
        
        is_logged();


        $this->load->model("usuarios_model","User");
    }

    /**
     * Método invocado depois do método construtor 
     */
    public function index()
    {
        $data = [];
        load_module(
            $this->module . "dashboard",
            $data,
            $this->template
        );
    }

    /*
      Metodo para chamar a pagina de cadastro
     */

    public function cadastrar()
    {
        // Gerar Logs
        // $this->load->library('my_log');
        // $logs = new MY_Log();
        // $logs->setLogPath(APPPATH . "logs/" . $this->session->userdata('nome') . "/");
        // $logs->write_log('info', "O usuario acessou a area de cadastro de usuarios");


        $data = [];
        load_module(
            $this->module . "cadastrar",
            $data,
            $this->template
        );
    }

    /*
      Método para chamar a pagina de atualização de dados
     */

    public function atualizar($id)
    {
        // Gerar Logs
        // $this->load->library('my_log');
        // $logs = new MY_Log();
        // $logs->setLogPath(APPPATH . "logs/" . $this->session->userdata('nome') . "/");
        // $logs->write_log('info', "O usuario acessou a area de atualizacao de usuarios");

        $dados = $this->User->getUsuariosById($id);
        
        load_module(
            $this->module . "atualizar",
            ['dados' => $dados],
            $this->template
        );
    }

    /*
      Metodo para listar os dados
     */

    public function gerenciar()
    {
        
        // Quantidade de registro a serem mostrados por páginma
        $filtro['qtd_por_pag'] = 10;

        /**
         * Bibliotecas e ajudantes carregados
         * @filesource system/libraries/pagination.php
         * @filesource application/model/usuariosModel.php
         */
        $this->load->library('pagination');

        $data['pagina'] = 'usuariosGerenciar';

        /**
         * Dados passados por Get, para busca
         * Se o segmento 3 existir, o mesmo será passado àos parãmetros
         */

        if ($this->input->get("busca")) $filtro['nome'] = $this->input->get("busca");
        

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
        $dados = $this->User->GetUsuarios($filtro, false);

        //dd($dados);

        // Parâmetros para a biblioteca de paginação
        $config['base_url'] = base_url() . "/" . $this->uri->segment(1) . "/" . $this->uri->segment(2) . "/" . $this->uri->segment(3) . "/";
        $config['total_rows'] = $dados->qtd;
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
        $data['dadosbusca'] = $dados->data_result;

        load_module(
            $this->module . "gerenciar",
            $data,
            $this->template
        );

    }

    public function cadastrarDadosUsuario()
    {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome','nome','required');
/*
        $this->form_validation->set_rules('email','email','required|trim|max_length[30]|valid_email|is_unique[usuarios.email]');
		$this->form_validation->set_rules('login','Login','required|trim|max_length[12]|min_length[4]|is_unique[usuarios.usuario]');
		$this->form_validation->set_rules('senha','Senha','required|min_length[6]');
		$this->form_validation->set_rules('confirma_senha','Confirmação de Senha','required|matches[senha]');
		$this->form_validation->set_rules('nivel', 'Tipo de Usuário', 'required');
*/
        if($this->form_validation->run()){

            $retorno = $this->User->inserirDados($this->input->post());

            if ($retorno)
            {
                // Gerar Logs
                // $this->load->library('my_log');
                // $logs = new MY_Log();
                // $logs->setLogPath(APPPATH . "logs/" . user_logged('nome') . "/");
                // $logs->write_log('info', "O usuario cadastrou um novo usuário com o ID: " . $retorno);

                echo '<br><div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Sucesso!</strong> Usuário cadastrado com sucesso.
                      </div>';
                echo '<script>document.getElementById("form").reset();</script>';
            }else{
                 echo '<br><div class="alert alert-danger" role="alert">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Erro!</strong> Ocorreu um erro ao realizar o cadastro do usuário, por favor tente mais tarde ou entre em contato com o administrador do sistema.
                      </div>';
                echo '<script>document.getElementById("form").reset();</script>';
            }


        }else{

           
            echo get_erros_validation();

            exit();
        }
        
    }

    public function atualizarDadosUsuario()
    {
        
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome','nome','required');
        $this->form_validation->set_rules('senha','Senha','min_length[6]');
        $this->form_validation->set_rules('confirma_senha','Confirmação de Senha','matches[senha]');
        //$this->form_validation->set_rules('nivel', 'Tipo de Usuário', 'required');

        $usuario = $this->User->getUsuariosById($this->input->post("id"));

        if($usuario->email != $this->input->post("email")){
            $this->form_validation->set_rules('email','email','required|trim|max_length[30]|valid_email|is_unique[usuarios.email]');
        }

        if($this->form_validation->run()){
           
            $return = $this->User->editarDados($this->input->post());
            
            if($return){
                // Gerar Logs
                // $this->load->library('my_log');
                // $logs = new MY_Log();
                // $logs->setLogPath(APPPATH . "logs/" . user_logged('nome') . "/");
                // $logs->write_log('info', "O usuario editou o perfil ID: " . $this->input->post("id"));


                if($this->input->post("origem") != "usuarios"){
                     echo '<br><div class="alert alert-success" role="alert">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Sucesso!</strong> Cadastro atualizado com sucesso.
                      </div>';
                }else{
                    set_msg('msgOk', "Dados do usuário \"<strong>". $this->input->post('nome') . "</strong>\" foram atualizado com sucesso!", $tipo='sucess');

                    print "<script>window.location = '" . base_url() . "admin/users/manage'</script>";
                }
            }else{

                echo '<br><div class="alert alert-danger" role="alert">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Erro!</strong> Ocorreu ao tentar atualizar o cadastro do usuário, por favor tente mais tarde ou entre em contato com o administrador do sistema.
                      </div>';

            }

        }else{

           
            echo get_erros_validation();

            exit();
        }
    }

    public function excluir($id)
    {
        if ($id == user_logged('id'))
        {
            $mensagem = array(
                'mensagem' => '<br><div class="alert">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                           <strong>Alerta!</strong> Você não pode excluir seu próprio usuário.
                           </div>'
            );
        }
        else
        {

            /**
             * Bibliotecas e ajudantes carregados
             * @filesource application/model/crud.php
             */
            $this->load->model("crud");

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
            $retorno = $this->db->delete("usuarios", ["id" => $id]);

            if ($retorno == true)
            {
                // Gerar Logs
                // $this->load->library('my_log');
                // $logs = new MY_Log();
                // $logs->setLogPath(APPPATH . "logs/" . $this->session->userdata('nome') . "/");
                // $logs->write_log('info', "O usuario excluiu um usuário com ID: " . $id);

                $mensagem = array(
                    'mensagem' => '<br><div class="alert alert-success">
                               <button type="button" class="close" data-dismiss="alert">&times;</button>
                               <strong>Sucesso!</strong> Usuário excluido com sucesso.
                               </div>'
                );
            }
        }

        // Sessão para mensagem
        set_msg('msgOk', "Usuário excluido com sucesso!", $tipo='sucess');
        redirect('admin/users/manage', 'refresh');
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
        redirect('admin/users/manage', 'refresh');
    }

}