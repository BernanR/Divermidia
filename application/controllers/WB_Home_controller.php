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

class WB_Home_controller extends CI_Controller
{
    // Aqui é feito a reescrita da classe construtora e a verificação
    // da autenticidade do usuário

    public $template = 'web_template';
    public $module = 'web/';

    public function __construct()
    {
        parent::__construct();
        //VERIFICA SE USER ESTÁ LOGADO
        //is_logged(); 

        get_config_site('site_title');
    }

    /**
     * Método invocado depois do método construtor 
     */
    public function index() {

        $this->load->model("Media_model","Media");    
        $this->load->model('Page_model', 'Page');

        $page['home'] = $this->Page->get(['id' => 4 ])->data_result;
        $page['agencia'] = $this->Page->get(['id' => 6 ])->data_result;
        $page['criative'] = $this->Page->get(['id' => 7 ])->data_result;
        $data['title'] =  'Home';
        $data['pageList'] = $page;
        $data['into_page'] = false;
        $data['meta_keywords'] = $page['home']->keywords;

        load_module(
            $this->module . 'home', 
            $data, 
            $this->template
        );
        
    }

    public function sendMail() {
        
        $this->load->library('form_validation');        
        $this->load->model("Mail_model","Mailer");

        $file = $_FILES['real_file_home'];

        $this->form_validation->set_rules('name_home','Nome','trim|required|min_length[2]');
        $this->form_validation->set_rules('email_home','Email','trim|required|valid_email');
        $this->form_validation->set_rules('phone_home','Telefone','trim|required|min_length[8]');
        $this->form_validation->set_rules('msg_home','Mensagem','trim|required');
        
        if(!validcaptha($this->input->post('captha_input'))) {
            echo '<p class="erro-validation alert-danger">O texto digitado esta incorreto!<br> Tente novamente.</p>';
            die;
        }

        if($this->form_validation->run()){

            if($file['size'] > 0) {

                if (in_array(get_ext_file($file), ['png','pdg','jpg','jpeg', 'JPEG'])) {
                    $return = $this->do_upload();

                    
                    if ($return['status']) {


                        $file_name = $return['upload_data']['file_name'];

                    } else {

                        echo '<p class="erro-validation alert-danger">Ocorreu algum erro ao enviar o arquivo, por favor, tente mais tarde.</p>';
                        die;
                    }

                } else {
                    echo '<p class="erro-validation alert-danger">Arquivo inválido!</p>';
                    die;

                }
            }

            $data = array(
                'name' => $this->input->post('name_home'),
                'mail' => $this->input->post('email_home'),
                'phone' => $this->input->post('phone_home'),
                'message' => $this->input->post('msg_home'),                
                'message_dt' => date('Y-m-d H:i:s'),
            );

            if (isset($file_name)) {
                $data['file_name'] = base_url() . 'assets/uploads/' . $file_name;
            }
            try{
                $this->load->model("Settings_model","Setting");
                $mail_contato = $this->Setting->get(['key' => 'send_mail_form_home'])->data_result[0]->value;

                $corpo = $this->Mailer->setEmailHomeBody($data);
                ///$mail_contato = 'alves.bernan@gmail.com';
                $this->Mailer->sendMail($mail_contato, 'Contato Formulário - Solicitação de produto', $corpo, 'Strutech');

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

    public function do_upload()
    {

        $this->load->library('Image_handler');

        $name = date_timestamp_get(date_create());       
        
        $path = './assets/uploads';

        if(!is_dir($path)) mkdir($path, 0777, true);

        $retorno_upload = $this->image_handler->upload_file(
            'real_file_home',
            $path,
            $name,
            'jpg|jpeg|png|pdf'
        );

        return  $retorno_upload;

    }

    public function error_404()
    {   
        $data['title'] =  '404 Page Not Found';
        load_module(
            'errors.html.error_404',
            $data,
            $this->template
        );
    }

    public function send_form() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','Nome','trim|required|min_length[2]');
        $this->form_validation->set_rules('phone','Telefone','trim|required|min_length[11]');
        $this->form_validation->set_rules('message','Mensagem','trim|required|min_length[5]');

        if($this->form_validation->run()) {
            echo json_encode([
                "status" => true,
                "message" =>  'Obrigado! sua mensagem foi enviada com sucesso, em breve retornaremos o contato.'
            ]);

        } else {
            echo json_encode([
                "status" => false,
                "error" =>  get_erros_validation($first_only = true, false)
            ]);
        }        
    }
}