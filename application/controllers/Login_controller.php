<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();    
        
        $this->load->model("Autenticar_usuario_model",'Aut');
    }    

    public function index()
    {
        if(is_logged(false)) redirect("dashboard");
        $this->load->view('login');
    }

    public function authentication(){
        
        $this->Aut->setUsuario($this->input->post("usuario"));
        $this->Aut->setSenha($this->input->post("senha"));
        $dados = $this->Aut->getDadosAutenticados();

        // dd($dados);
        // exit();
        if ($dados)
        {
            $array = array(
                'id' => $dados->id,
                'nome' => $dados->nome,
                'nivel' => $dados->nivel,
                'logado' => true,
                'path_logs' => $dados->id . "_" . $dados->nome
            );

            $this->session->set_userdata(["usuario_logado" => $array]);
                                   
            print "<script>window.location = '" . base_url() . "dashboard'</script>";
        }
        else
        {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . '<strong>Alerta!</strong> Usuário ou senha não cadastrados.' .
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        }
    }

}