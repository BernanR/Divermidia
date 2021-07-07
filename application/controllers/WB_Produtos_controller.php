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

class WB_Produtos_controller extends CI_Controller
{
    // Aqui é feito a reescrita da classe construtora e a verificação
    // da autenticidade do usuário

    public $template = 'web_template';
    public $module = 'web/';
    public $qtd_by_pag = 10;
    public $page_init =0;

    public function __construct(){
        parent::__construct();
        
        $this->load->model("Product_model","Product");
        $this->load->model("Category_model","Category");
        $this->load->model("Brand_model","Brand");
        $this->load->library('cart');
        $this->load->library('Image_handler');

    }

    /**
     * Método invocado depois do método construtor 
     */
    public function index(){      
        $this->products_list();     
    }

    public function products_list($brand=null, $category=null){ 

        
        $data['title'] = 'Produtos';
        $data["brand_description"] = '';
        $data["qtd_by_pag"] = $this->qtd_by_pag;
        $data["page_init"] = 0;

        if($brand !== 'all') $data['banners'] = $this->Brand->getBrandBanners(['slug' => $brand]);      

        $records = $this->Product->get([
            'brand_slug' => $brand,
            'category_slug' => $category,
            'qtd_by_pag' => $this->qtd_by_pag,
            'page_init' => $this->page_init,
            'categories_list_slugs' => $this->input->get(),
            'brands_list_slugs' => $this->input->get(),
        ]);
        
        if ($brand != 'all') {
            $data["brand_description"] = $this->Brand->get(['slug' => $brand])
                ->data_result[0]
                ->description;
        }
        
        $data['products'] = $records->data_result;
        $data['products_total_qtd'] = $records->qtd;
        $data['page_init'] = $this->page_init;
        
        $data['categories'] = $this->Product->getCategoriesWithProduct();
        //echo '<pre>'; print_r($data['categories']); echo '</pre>';
        $data['brands'] = $this->Product->getBrandsWithProduct();

        load_module(
            $this->module . 'produtos', 
            $data, 
            $this->template
        );        
    }

    public function getProductAjax(){
        sleep(1);
        $params = (object) $this->input->get();
        $return = (object) [];

        $page_init = $params->page_init + $this->qtd_by_pag;
        $records = $this->Product->get([
            'brand_slug' => $params->brand,
            'category_slug' => ($params->category) ? $params->category : null,
            'qtd_by_pag' => $this->qtd_by_pag,
            'page_init' => $page_init,
            'categories_list_slugs' => $params,
            'brands_list_slugs' => $params,
        ]);
        
        $return->products_total_qtd = $records->qtd;
        $return->page_init = $page_init;
        $return->produtcs_qtd = count($records->data_result);
        $return->html = $this->load->view('web/_product_item',['products' => $records->data_result], true);
       
        echo json_encode($return);
        die;
    }

    public function details_product($product){
 
        $this->load->library('Image_handler');

        $data['title'] = 'Produtos';
        $data['pathCss'] = 'product-detail.css';

        $data['product'] = $this->Product->get([
            'product_slug' => $product,
        ])->data_result[0];        

        // dd($data['product']);
        $data['relatedProducts']= $this->Product->get([
            'brand_id' => $data['product']->brand_id,
            'qtd_by_pag' => 6,
        ])->data_result;


        $data['banners'] = $this->Brand->getBrandBanners(['id' =>$data['product']->brand_id]); 

        $data['brand_description'] = $this->Brand->get(['id' => $data['product']->brand_id])->data_result[0]->description;

        if(!$data['brand_description']) $data['brand_description'] = '';
        
        $data['product']->additional_files = json_decode($data['product']->additional_files);
        $data['meta_keywords'] = $data['product']->keywords;
        $data['meta_description'] = $data['product']->resume;
        $data['image_src'] = $this->image_handler->thumb('./assets/img/products/', $data['product']->file, 100, 100, false);

        load_module(
            $this->module . 'product-detail', 
            $data, 
            $this->template
        );      
    }
    

}