<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cadastro_usuario_controller extends CI_Controller {

    private $template = "principal";
    // Aqui é feito a reescrita da classe construtora e a verificação
    // da autenticidade do usuário
    public function __construct()
    {
        parent::__construct();

        $this->load->model("Usuarios_model","User");
    }

    /**
     * Método invocado depois do método construtor 
     */
    public function index()
    {
        if(is_logged(false)) redirect("home");
        $this->load->view('usuarios/cadastro_usuario');
    }

    public function recuperar_senha()
    {

        if($this->input->post()){

            $this->load->model("Mail_model","Mail");

            $this->form_validation->set_rules('email','email','required|trim|max_length[30]|valid_email');
            
            if($this->form_validation->run()){
               
                $usuario = $this->db->get_where('usuarios',['email'=>$this->input->post("email")])->row();
                
                if($usuario){

                    $nova_senha = $this->gerar_senha(8, true, true, true, false);
                    $assunto = "Recuperação de Senha - Portinari";
                    $from = "Portal Portinari";
                    $corpo = "Segue sua nova senha para acesso ao portal portinari: <strong>" . $nova_senha . "</strong>";
                    $return = $this->Mail->sendMail($usuario->email, $assunto, $corpo, $from);

                    if($return){
                        
                        $this->db->where("email",$usuario->email);
                        $this->db->update("usuarios",["senha"=>md5($nova_senha)]);

                        set_msg("msgOk","Foi enviado uma nova senha para sua conta de e-mail.",$tipo='sucess');
                    }else{
                        set_msg("msgErro","Ocorreu um erro ao tentar enviar uma nova senha, por favor tente mais tarde.",$tipo='error');
                    }
                }else{
                    set_msg("msgErro","Não existe cadastro com esse endereço de e-mail",$tipo='error');
                }

                redirect(current_url());
            }
        }

        $this->load->view('usuarios/recuperar_senha');
    }

 
    public function cadastrarDadosUsuario()
    {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome','nome','required');
        $this->form_validation->set_rules('email','email','required|trim|max_length[30]|valid_email|is_unique[usuarios.email]');
        $this->form_validation->set_rules('celular','Celular','required|trim');
        $this->form_validation->set_rules('cep','Cep','required|trim');
        $this->form_validation->set_rules('rua','Rua','required|trim');
        $this->form_validation->set_rules('numero','Número','required|trim');
        $this->form_validation->set_rules('cidade','Cidade','required|trim');
        $this->form_validation->set_rules('uf','Estado','required|trim');
		$this->form_validation->set_rules('login','Login','required|trim|max_length[12]|min_length[4]|is_unique[usuarios.usuario]');
		$this->form_validation->set_rules('senha','Senha','required|min_length[6]');
		$this->form_validation->set_rules('confirma_senha','Confirmação de Senha','required|matches[senha]');

        if($this->form_validation->run()){

            $post = $this->input->post();
            $post['nivel'] = 2;
            $retorno = $this->User->inserirDados($post,true);


            if ($retorno->status)
            {
                set_msg('msgOk', "Seu cadastro foi realizado com sucesso!<br>Por favor, faça o login no portal.", $tipo='sucess');
                print "<script>window.location = '" . base_url() . "login'</script>";                                

            }else{
                 echo '<br><div class="alert alert-danger" role="alert">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Erro!</strong> Ocorreu um erro ao realizar o cadastro do usuário, por favor tente mais tarde ou entre em contato com o administrador do sistema.
                      </div>';
                //echo '<script>document.getElementById("form").reset();</script>';
            }


        }else{

           
            echo get_erros_validation();

            exit();
        }
        
    }


    private function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
        $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
        $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
        $nu = "0123456789"; // $nu contem os números
        $si = "!@#$%¨&*()_+="; // $si contem os símbolos
        $senha = "";

        if ($maiusculas){
            // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($ma);
        }
     
        if ($minusculas){
            // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($mi);
        }
     
        if ($numeros){
            // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($nu);
        }
     
        if ($simbolos){
            // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($si);
        }
     
        // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
        return substr(str_shuffle($senha),0,$tamanho);
    }

}