<?php

/**
 *  PrincipalController é o controlador principal do sistema.
 * 
 * @author Bernan Ribeiro <dev.bernan@gmail.com>
 * @version 0.1
 * 
 */

// Verifica se o BASEPATH está definido, caso contrário não carrega o controlador
if (!defined('BASEPATH')) exit('No direct script access allowed');

class WB_Contato_controller extends CI_Controller
{
    // Aqui é feito a reescrita da classe construtora e a verificação
    // da autenticidade do usuário

    public $template = 'web_template';
    public $module = 'web/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Media_model","Media");
        $this->load->model("Mail_model","Mailer");
        $this->load->model("Settings_model","Setting");

        
        //VERIFICA SE USER ESTÁ LOGADO
        //is_logged(); 
    }

    /**
     * Método invocado depois do método construtor 
     */
    public function index(){      
        $data['title'] = 'Contato';
        $data['carrousel'] = true;
        load_module(
            $this->module . 'contato', 
            $data, 
            $this->template
        );
        
    }

    public function sendMail(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name','Nome','trim|required|min_length[2]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('phone','Telefone','trim|required|min_length[8]');
        $this->form_validation->set_rules('input_message','Mensagem','trim|required');

        if(!validcaptha($this->input->post('captha_input'))) {
            echo '<p class="erro-validation alert-danger">O texto digitado esta incorreto! Tente novamente.</p>';
            die;
        }
        
        if($this->form_validation->run()){


            $data = array(
                'name' => $this->input->post('name'),
                'mail' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'message' => $this->input->post('input_message'),
                'message_dt' => date('Y-m-d H:i:s'),
            );

            $mail_contato = $this->Setting->get(['key' => 'send_mail_form_contato'])->data_result[0]->value;
            $corpo = $this->Mailer->setEmailHomeBody($data);  
            $this->Mailer->sendMail($mail_contato, 'Contato Formulário - Fale Conosco', $corpo, 'Righi&Righi');

            //$response['status_envio'] = "Mensagem Enviada com sucesso, " . $this->input->post('name_home');

            echo '<p class="alert alert-success">Sua mensagem foi enviada  sucesso, em breve retornaremos o contato. <strong>Obrigado!</strong></p></p>';
            die;

        }else{
            echo get_erros_validation($first_only = true);
            exit();

        }
        

    }

}