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

class WB_Search_controller extends CI_Controller
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
        $this->load->model('Search_model', 'Search');
        $this->load->library('Image_handler');

        get_config_site('site_title');
    }

    /**
     * Método invocado depois do método construtor 
     */
    public function index() {
        
        $searchItem = $this->input->get('q');
        if(!isset($searchItem)) redirect('home');


       
        // $products = $this->Search->get([
        //     'search' => $searchItem,
        // ])->data_result;

        $pages= $this->Search->get(['search' => $searchItem])->pages_result;
        
        //$data['products'] = $products;
        $data['pages'] = $pages;
        $data['title'] = $searchItem;
        $data['search'] = $searchItem;
        $result = [];
        
        foreach ($pages as $page) {
            $resumo = ($page->resume) ? $page->resume : $page->content;
            $result[] = [
                'resumo' => resumo($resumo, 20), 
                'title' => $page->title,
                'slug' => $page->slug
            ];
        }

        $data['result'] = $result;

        load_module(
            $this->module . 'search', 
            $data, 
            $this->template
        );
        
    }
}