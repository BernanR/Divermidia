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

class Captha_controller extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('captcha');
    }


    public function valid($cap) {        

        return validcaptha($cap);
    }

    public function get() {
        echo json_encode(createCaptcha());
    }
}