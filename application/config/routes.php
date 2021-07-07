<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

$route = array(
    'painel' => 'Login_controller', 
    'login' => 'Login_controller',
    'authentication' => 'Login_controller/authentication',
    'logout' => 'Deslogar_controller',
    'dashboard' => 'AD_Dashboard_controller',
    'cadastro-usuario' => 'Cadastro_usuario_controller',
    'esqueci-minha-senha' => 'Cadastro_usuario_controller/recuperar_senha',
    
    // Rotas para usuários
    'usuarios' => 'AD_Usuarios_controller',
    'admin/usuarios/create' => 'AD_Usuarios_controller/cadastrar',
    'admin/usuarios/manage-my-account' => 'AD_Usuarios_controller/gerenciar',
    'admin/users/manage' => 'AD_Usuarios_controller/gerenciar',
    'admin/users/delete/(:num)' => 'AD_Usuarios_controller/excluir/$1',
    'admin/users/edit/(:num)' => 'AD_Usuarios_controller/atualizar/$1',
    'usuarios/status/(:num)/(:num)' => 'AD_Usuarios_controller/status/$1/$2',
    
    // Rotas para categorias
    'admin/categories' => 'AD_Category_controller',
    'admin/categories/create' => 'AD_Category_controller/create',
    'admin/categories/edit/(:num)' => 'AD_Category_controller/edit/$1',
    'admin/categories/manage' => 'AD_Category_controller/manage',
    'admin/categories/manage/(:any)' => 'AD_Category_controller/manage/$1',
    'admin/categories/delete/(:num)' => 'AD_Category_controller/delete/$1',
    'admin/categories/get' => 'AD_Category_controller/get',

     // Settings routes
    //'admin/settings' => 'AD_Setting_controller',
    'admin/settings/(:num)' => 'AD_Setting_controller/$1',
    'admin/settings/manage' => 'AD_Setting_controller/manage',
    'admin/settings/manage/(:num)' => 'AD_Setting_controller/manage/$1',
    'admin/settings/create' => 'AD_Setting_controller/create',
    'admin/settings/edit/(:num)' => 'AD_Setting_controller/edit/$1',
    'admin/settings/delete/(:num)' => 'AD_Setting_controller/delete/$1',

    // Media routes
    'admin/media' => 'AD_Media_controller',
    'admin/media/manage' => 'AD_Media_controller/manage',
    'admin/media/manage/(:num)' => 'AD_Media_controller/manage/$1',
    'admin/media/create' => 'AD_Media_controller/create',
    'admin/media/edit/(:num)' => 'AD_Media_controller/edit/$1',
    'admin/media/update' => 'AD_Media_controller/update',
    'admin/media/remove-files/(:num)' => 'AD_Media_controller/remove_files/$1',

    //APIS
    'api/get-media/(:any)' => 'AD_Media_controller/get_files_upload/$1',
    'api/delete-media/(:any)' => 'AD_Media_controller/delete_file_upload/$1',
  

    // Pages routes
    'admin/pages' => 'AD_Page_controller/list',
    'admin/pages/create' => 'AD_Page_controller/create',
    'admin/pages/manage' => 'AD_Page_controller/manage',
    'admin/pages/manage/(:num)' => 'AD_Page_controller/manage/$1',
    'admin/pages/edit/(:num)' => 'AD_Page_controller/edit/$1',
    'admin/pages/delete/(:num)' => 'AD_Page_controller/delete/$1',
    'admin/pages/upload-files' => 'AD_Page_controller/upload_file',
    'admin/pages/upload-files-carousel/(:num)' => 'AD_Page_controller/upload_images_carousel/$1',
    'amdin/pages/delete-file-carousel/(:num)/(:any)' => 'AD_Page_controller/delete_file_corousel/$1/$2',
    'admin/pages/list/(:num)' => 'AD_Page_controller/listByCategory/$1',

    // Menus routes
    'admin/menus/manage' => 'AD_Menus_controller/manage',
    'admin/menus/manage/(:num)' => 'AD_Menus_controller/manage/$1',
    'admin/menus/create' => 'AD_Menus_controller/create',
    'admin/menus/delete/(:num)' => 'AD_Menus_controller/delete/$1',
    'admin/menus/edit/(:num)' => 'AD_Menus_controller/edit/$1',

    //Gallery routes
    'admin/gallery/create' => 'AD_Gallery_controller/create',
    'admin/gallery/manage' => 'AD_Gallery_controller/manage',
    'admin/gallery/manage/(:num)' => 'AD_Gallery_controller/manage/$1',
    'admin/gallery/edit/(:num)' => 'AD_Gallery_controller/edit/$1',
    'admin/gallery/delete/(:num)' => 'AD_Gallery_controller/delete/$1',
    'admin/gallery/delete-video/(:num)/(:any)' => 'AD_Gallery_controller/delete_video/$1/$2',
    'admin/gallery/upload-image/(:num)' => 'AD_Gallery_controller/upload_image/$1',
    'admin/gallery/delete-file-carousel/(:num)/(:any)' => 'AD_Gallery_controller/delete_file/$1/$2',
    
    // Perfil
    'perfil' => 'Perfil_controller',
    'admin/perfil/atualizar' => 'Perfil_controller/atualizar',
    

    //rotas para Website ------------------------------------------------------------------------
    'home' => 'WB_Home_controller',
    'contato'=> 'WB_Contato_controller',
    'lista-compra' =>'WB_Cart_controller',
    'empresa'=>'WB_QuemSomos_controller',
    'trabalhe-conosco'=>'WB_TrabalheConosco_controller',
    'produtos/(:any)' => 'WB_Produtos_controller/products_list/$1',
    's/(:any)' => 'WB_Pages_controller/index/$1',
    'p/(:any)' => 'WB_Pages_controller/index/$1',

    'busca' => 'WB_Search_controller',

    'p/(:any)/(:any)' => 'WB_Pages_controller/index/$1/$2',// page/(page_category_slug)/(page_slug)

    //forms site
    'sendhome' => 'WB_Home_controller/sendMail',
    'contactmail' => 'WB_Contato_controller/sendMail',
    'workmail' => 'WB_TrabalheConosco_controller/sendMail',
    'sendlist' => 'WB_Cart_controller/send',
    'banco' => 'databasecreate/index',

    'produtos/(:any)' => 'WB_Produtos_controller/products_list/$1',
    'produtos/(:any)/(:any)' => 'WB_Produtos_controller/products_list/$1/$2',
    'produto/(:any)' => 'WB_Produtos_controller/details_product/$1',
    'cart/add/(:num)' => 'WB_Cart_controller/insert_cart/$1',
    'cart/add_qtd_product/(:any)' => 'WB_Cart_controller/add_qtd_product/$1',
    'cart/delete/(:any)' => 'WB_Cart_controller/delete/$1',

    'captha-valid' => 'WB_Form_controller/valid',
    'captha-get' => 'WB_Form_controller/get_captha',
    'captha-remove' => 'WB_Form_controller/remove_captha',
);

$route['(:any)'] = 'WB_Pages_controller'; 
$route['default_controller'] = "WB_Home_controller";
$route['404_override'] = 'WB_Home_controller/error_404';


/* End of file routes.php */
/* Location: ./application/config/routes.php */