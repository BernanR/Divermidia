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

class WB_Cart_controller extends CI_Controller
{
    // Aqui é feito a reescrita da classe construtora e a verificação
    // da autenticidade do usuário

    public $template = 'web_template';
    public $module = 'web/';


    public function __construct(){
        parent::__construct();
        
        $this->load->library('cart');
        $this->load->model("Product_model","Product");
        $this->load->model("Mail_model","Mailer");
        $this->load->model("Settings_model","Setting");
        $this->load->library('Image_handler');

    }

    /**
     * Método invocado depois do método construtor 
     */
    public function index(){    

        $data['cartItems'] =  $this->cart->contents();
        
        $data['title'] = 'Lista Orçamento';

        load_module(
            $this->module . 'cart', 
            $data, 
            $this->template
        );
        
    }

    public function delete($rowId){
        $this->cart->remove($rowId);

        redirect('lista-compra');

    }

    public function insert_cart($productId){

        $product = $this->Product->get([
            'id' => $productId,
        ])->data_result[0];

        //if(!isset($product)) redirect('home');

        $data = array(
            'id'      => $product->id,
            'qty'     => 1,
            'price'   => 0,
            'name'    => $product->slug,
            'options' => $product,
        );
       
        $inserted = $this->cart->insert($data);

        if($inserted){

            if($this->input->get('ajax')) {
                echo json_encode(['status' => true]);

            } else {

                redirect('lista-compra');
            }
            
        } 

        //redirect('home');//fazer ajax
        
    }

    public function add_qtd_product($id) {        
        $qty = $this->input->get('qty');

        if ($qty > 0) {
            $cart = $this->session->userdata('cart_contents');
            $cart[$id]['qty'] = $qty;

            $this->session->set_userdata('cart_contents', $cart);
            echo json_encode(['status' => true]);
        }
    }


    public function send(){
        // ENVIAR EMAIL LISTA CARRINHO!!
        

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name','Nome','trim|required|min_length[2]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('phone','Telefone','trim|required|min_length[8]');
        $this->form_validation->set_rules('input_message','Mensagem','trim|required');


       if($this->form_validation->run()){
            $items = $this->cart->contents();//pega todos itens do cart
            //echo '<pre>'; print_r(  $items); echo '</pre>'; die;
            $data = array();
            
            if( sizeof($items) === 0){
                echo '<p class="alert alert-danger">Você precisa selecionar um produto antes de Enviar a lista de Orçamento!</p>';
                die;
            }

            foreach($items as $product){
                //atualiza a quantidade de produtos selecionados, de acordo com o post do input!!!
                $this->cart->update([
                    'rowid' => $product['rowid'],
                    'qty' => $this->input->post("qtd_produto_".$product['rowid'])
                ]);

               
                $mail_data = array(
                    'link' => '<a href="' . base_url('produto/') . $product['options']->slug . '">Ver Produto</a>',
                    'name' => $product['name'],
                    'qtd' => $product['qty'],
                );

                array_push($data, $mail_data);
            }

            $cliente = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'message' => $this->input->post('input_message')
            );           
    
            $mail_produtos = $this->Setting->get(['key' => 'send_mail_form_produtos'])->data_result[0]->value;
    
            $body = $this->Mailer->setCartBody($data, $cliente);

            $this->Mailer->sendMail($mail_produtos, 'Contato Formulário - Lista de Orçamento', $body, 'Strutech');

            echo '<p class="alert alert-success">Sua mensagem foi enviada  sucesso, em breve retornaremos o contato. <strong>Obrigado!</strong></p></p>';
            $this->cart->destroy();
            echo ' <meta http-equiv="refresh" content="300">';
        }else{
            echo get_erros_validation($first_only = true);
            exit();
        }

    }

}