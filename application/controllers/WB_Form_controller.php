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

class WB_Form_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('captcha');
        error_reporting(0);
    }

    /**
     * Método invocado depois do método construtor 
     */
    public function index() {    

        $this->load->library('form_validation');
        $this->load->model("Mail_model","Mailer");

        $this->form_validation->set_rules('name','Nome','trim|required|min_length[2]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('phone','Telefone','trim|required|min_length[8]');
        $this->form_validation->set_rules('input_message','Mensagem','trim|required');
        
        if(!validcaptha($this->input->post('captha_input'))) {
            echo '<p class="erro-validation alert-danger">O texto digitado esta incorreto!<br> Tente novamente.</p>';
            die;
        }

        if ($this->form_validation->run()) {

            $data = array(
                'name' => $this->input->post('name'),
                'mail' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'message' => $this->input->post('input_message'),                
                'message_dt' => date('Y-m-d H:i:s'),
                'origem' => $this->input->post('origem'),  
            );

            try{

                $this->load->model("Settings_model","Setting");
                $mail_contato = $this->Setting->get(['key' => 'send_mail_form_home'])->data_result[0]->value;
                $corpo = $this->Mailer->setEmailHomeBody($data);
                //$mail_contato = 'emailbernan@gmail.com';
                //echo '<pre>'; print_r($mail_contato); echo '</pre>'; die;
                $this->Mailer->sendMail($mail_contato, 'Contato Formulário', $corpo, 'Righi & Righi');
                

            }catch(Exception $e){
                echo '<script>console.log("exception")</script>';
            }
                
            //$response['status_envio'] = "Mensagem Enviada com sucesso, " . $this->input->post('name_home');

            echo '<p class="alert alert-success">Sua mensagem foi enviada  sucesso, em breve retornaremos o contato. <strong>Obrigado!</strong></p></p>';
            die;

        }else{
            echo get_erros_validation($first_only=true);
            exit();
        }

    }

    public function trabalhe_conosco(){
        // echo ('<script>alert("chegou aqui")</script>');
        $this->load->model("Mail_model","Mailer");
        $this->load->library('form_validation');
        $file = $_FILES['file_input'];
        
        if($file['size'] === 0){
            echo '<p class="erro-validation alert-danger">O Currículo é obrigatório!</p></p>';
            die;
        }
        
        if(!validcaptha($this->input->post('captha_input'))) {
            echo '<p class="erro-validation alert-danger">O texto digitado esta incorreto! Tente novamente.</p>';
            die;
        }

        if (!$this->input->post('Area')) {
            echo '<p class="erro-validation alert-danger">Selecione uma área de atuação.</p>';
            die;
        }

        $this->form_validation->set_rules('name','Nome','trim|required|min_length[2]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('phone','Telefone','trim|required|min_length[8]');


        if($this->form_validation->run()){

            if($file['size'] > 0){

                $upload = $this->upload();
                
                if($upload['status']){
                    $filename = $upload['data']['file_name'];
                }else{
                    echo '<p class="erro-validation alert-danger">'. $upload['msg'] .'</p>';
                    die; 
                }
                
                $data = array(
                    'name' => $this->input->post('name'),
                    'mail' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'message' => $this->input->post('input_message'), 
                    'area' => $this->input->post('Area'),
                    'file_name' => base_url() . 'assets/uploads/curriculos/' . $filename,
                    'message_dt' => date('Y-m-d H:i:s'),
                );

                try{                
                    $this->load->model("Settings_model","Setting");
                    $mail_contato = $this->Setting->get(['key' => 'send_mail_form_trabalhe_conosco'])->data_result[0]->value;
                    $corpo = $this->Mailer->setEmailHomeBody($data);
                    //$mail_contato = 'emailbernan@gmail.com';
                    //echo '<pre>'; print_r( $mail_contato); echo '</pre>'; die;
                    $this->Mailer->sendMail($mail_contato, 'Contato Formulário - Trabalhe Conosco Formulário ', $corpo, 'Righi & Righi');

                    echo '<p class="alert alert-success">Sua mensagem foi enviada  sucesso, em breve retornaremos o contato. <strong>Obrigado!</strong></p></p>';


                }catch(Exception $e){
                    echo $e;
                }
            

            }else {
                echo '<p class="erro-validation alert-danger">O Currículo é obrigatório!</p></p>';
                die;
            }
        }else{
            echo get_erros_validation($first_only = true);
            exit();
        }
        
    }

    public function upload(){
        $this->load->library('upload');

        $name = 'cur_'.date_timestamp_get(date_create());       
        
        $path = './assets/uploads/curriculos';

        if(!is_dir($path)) mkdir($path, 0777, true);

        $uploadConfigs = array(
            'upload_path'=> $path,
            'allowed_types'=> 'docx|pdf',
            'file_name'=> $name,
        );

        $this->upload->initialize($uploadConfigs);

        if($this->upload->do_upload('file_input')){
            $back = array(
                'data' => $this->upload->data(),
                'status'=>true
            );
        }else{
            $back = array('status' =>false, 'msg' => $this->upload->display_errors(false));
        }

        return $back;
    }


    public function valid($cap) {        

        return validcaptha($cap);
    }

    public function get_captha() {
        echo json_encode(createCaptcha());
        die;
    }

    public function remove_captha() {
        $file = $this->input->get('file');
        if(file_exists("./captcha/" . $file)){
            array_map('unlink', glob("./captcha/" . $file));
        }

    }

}