<?php

/**
 *  PerfilController é o controlador para o gerenciamento dos dados dos usuarios.
 * Aqui o usuário pode trocar sua senha e outras informações relevantes
 * 
 */
// Verifica se o BASEPATH está definido, caso contrário não carrega o controlador
if (!defined('BASEPATH'))    exit('No direct script access allowed');

class Perfil_controller extends CI_Controller {

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
        // Gerar Logs
        // $this->load->library('my_log');
        // $logs = new MY_Log();
        // $logs->setLogPath(APPPATH . "logs/" . $this->session->userdata('nome') . "/");
        // $logs->write_log('info', "O usuario acessou a area de atualizacao de dados de seu perfil");

        $this->load->view('principal');
    }

    /*
      Método para chamar a pagina de atualização
      Aqui são recebidos os dados e atulizados
     */

    public function atualizar()
    {

        $data = $this->User->getUsuariosById(user_logged("id"));
        // Gerar Logs
        // $this->load->library('my_log');
        // $logs = new MY_Log();
        // $logs->setLogPath(APPPATH . "logs/" . user_logged('nome') . "/");
        // $logs->write_log('info', "O usuario acessou a area de atualizacao de dados de seu perfil");

        load_module("usuarios.perfil_atualizar",["user"=>$data]);
    }

}