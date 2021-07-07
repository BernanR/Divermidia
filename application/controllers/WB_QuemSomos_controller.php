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

class WB_QuemSomos_controller extends CI_Controller
{
    // Aqui é feito a reescrita da classe construtora e a verificação
    // da autenticidade do usuário

    public $template = 'web_template';
    public $module = 'web/';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Método invocado depois do método construtor 
     */
    public function index(){

        $this->load->model("Page_model", "Page");
        $page = $this->Page->get(['slug' => 'quem-somos'])->data_result[0]; 

        $replacedUrlContent = replaceUrlImg($page->content);
        $page->content = $replacedUrlContent;

        $data['_page'] =  $page;

        $data['title'] = 'Quem Somos';
        
        if($data['_page']->resume)   $data['meta_description'] = $data['_page']->resume;

        load_module(
            $this->module . 'paginas', 
            $data, 
            $this->template
        );
        
    }

}