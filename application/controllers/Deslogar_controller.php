<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Classe principal.
 * Esta será chamada quando o sistema for carregada a primeira vez
 */

class Deslogar_controller extends CI_Controller
{
    public function index()
    {
    	// Gerar Logs
        // $this->load->library('my_log');
        // $logs = new MY_Log();
        // $logs->setLogPath(APPPATH . "logs/" . $this->session->userdata('nome') . "/");
        // $logs->write_log('info', "O usuario deslogou do sistema");

    	// Destroi a sessão vigente e enviao o usuário para a tela de login
        $this->session->sess_destroy();
        print "<script>self.location = '" . base_url() . "'</script>";
    }

}
