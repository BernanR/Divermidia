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

class WB_Empresa_controller extends CI_Controller{
    // Aqui é feito a reescrita da classe construtora e a verificação
    // da autenticidade do usuário

    public $template = 'web_template';
    public $module = 'web/';

    public function __construct()
    {
        parent::__construct();

        //is_logged();
    }

    /**
     * Método invocado depois do método construtor 
     */
    public function index(){      
        $data['title'] = 'Empresa';
        load_module(
            $this->module . 'empresa', 
            $data, 
            $this->template
        );
        
    }

}