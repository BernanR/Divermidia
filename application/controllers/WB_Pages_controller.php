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

class WB_Pages_controller extends CI_Controller
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

        $this->load->model('Page_model', 'Page');
        $this->load->model('Media_model', 'Media');

        get_config_site('site_title');
    }

    private function setBanner($page, $tipo) {

        $banners = json_decode($page->banners);

        if ($banners->$tipo) {
            return (object) [
                'alt' => $page->title,
                'title' => $page->title,
                'filename' => $banners->$tipo
            ];
        }

        return "";
        
    }

    /**
     * Método invocado depois do método construtor 
     */
    public function index() {

        $url = $this->uri->segment(1);

        $page = $this->Page->get(['slug' => $url ]);
        
        if($page) {
            $page = $page->data_result[0];
            $page->content = replaceUrlImg($page->content);
            $data['title'] = $page->title;
            $data['display_brands'] = $page->display_brands;
            $data['_page'] = $page; 

            $data['banners'] = [];
            $data['banners']['desktop'] = $this->setBanner($page, 'desktop');
            $data['banners']['mobile'] = $this->setBanner($page, 'mobile' );         

           
        } else {
            redirect('404_override');
        }

        $data['carrousel'] = true;

        load_module(
            $this->module . 'paginas', 
            $data, 
            $this->template
        );
        
    }
}