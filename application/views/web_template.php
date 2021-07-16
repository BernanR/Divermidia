
<?php
    $config = get_config_site();    
    $menus = get_menus();
    
    $description = (isset($meta_description)) ?  $meta_description : $config->site_title;    
    $image_src = (isset($image_src)) ? $image_src : img_url('favicon_192x192.png');  
    //createCaptcha();
    $css_v = '1.3';
    $js_v = '1.5';   

    //$footer_customers = getCustomersLogo();
   
    // $media = (Object) array(//se precisar de + mídias, setar aqui!!
    //     'footer_customers' => $footer_customers
    // );

    if (!isset($into_page)) $into_page = true;
    $head_into_class = ($into_page) ? 'hd-into' : '';
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <base href="<?= base_url(); ?>" />
        <meta charset="utf-8">
        <title><?=($title) ?> | <?=$config->site_title?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php if (isset($meta_keywords)): ?>
        <meta name="keywords" content="<?=$meta_keywords?>">
        <?php endif?>
        <meta property="og:site_name" content="<?=$config->site_title?>">
        <meta name="description" content="<?=$description?>">
        <meta name="author" content="Bernan Ribeiro">

        <link rel="image_src" href="<?=$image_src?>">  

        <script src="assets/js/jquery.min.js"></script>        
        <!-- bootstrap 5 -->
        <link rel="stylesheet" href="<?=base_url('assets/lib/bootstrap/css/')?>/bootstrap.min.css">

        <!-- fontes -->
        <link href="<?=base_url('assets/fonts/noir/stylesheet.css')?>" rel="stylesheet">

        <!-- carousel -->   
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/lib/owl-carousel/docs/assets/owlcarousel/assets/') ?>owl.carousel.min.css">
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/lib/owl-carousel/docs/assets/owlcarousel/assets/') ?>owl.theme.default.min.css">
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/lib/animate/css/') ?>animate.min.css">
        <!-- lightbox -->
        <link rel="stylesheet" href="<?=base_url('assets/lib/lightbox/css/lightbox.min.css')?>">

        <!-- scroll -->
        <?php if (isset($mCustomScrollbar)):  ?>
            <link rel="stylesheet" href="<?=base_url('assets/lib/mCustomScrollbar/jquery.mCustomScrollbar.css')?>">
        <?php endif ?>

        <!-- My Styles -->
        <link rel="stylesheet" href="<?=base_url("assets/css/custom.css?v=$css_v")?>">
        <!-- Fav and touch icons -->
        <link rel="icon" href="<?=img_url('favicon_32x32.png')?>?v=1" sizes="32x32">
        <link rel="icon" href="<?=img_url('favicon_192x192.png')?>?v=1" sizes="192x192">
        <link rel="apple-touch-icon-precomposed" href="<?=img_url('favicon_180x180.png')?>?v=1">

        <link rel="stylesheet" href="<?=base_url('assets/lib/sweet/sweetalert2.min.css')?>">

    </head>

    <body>

        <header class="<?=$head_into_class?>">
            <?php $this->load->view('web/_navbar', [ 'menus'=> $menus, 'config'=> $config, 'into_page' => $into_page]) ?> 
        </header>
        
        <?php if (isset($banners['desktop']) || isset($banners['mobile'])):  ?>
            <?php $this->load->view('web/_main_banner', ['banners' => $banners]) ?>   
        <?php endif ?>
        
        <main>
            <?php $this->load->view($page) ?>
        </main><!--/.fluid-container-->
        
        <footer <?= ($page === 'web/home') ? 'style="margin-top:0 !important;"' : '' ?> class="footer">
            <?php $this->load->view('web/_footer', [ 'config'=> $config ]) ?>
        </footer>

        <input type="hidden" id="base_url" value="<?=base_url()?>" />    

        <script src="<?=base_url('assets/lib/bootstrap/js/')?>bootstrap.min.js"></script>   
        <script src="<?=base_url('assets/lib')?>/jquery.mask.min.js"></script>

        <script type="text/javascript" src="<?=base_url('assets/lib/sweet/sweetalert2@11.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/lib/owl-carousel/docs/assets/owlcarousel/owl.carousel.min.js')?>"></script>
        <script src="<?=base_url('assets/lib/lightbox/js/lightbox.min.js')?>"></script>
        <script src="<?=base_url('assets/js')?>/main.js"></script>      
        <input type="hidden" id="base_url" value="<?=base_url()?>"> 
    </body>
</html>
