<?php

//SETAR O BANNER NA VARIÁVEL VINDA DO WEB_TEMPLATE $media
//$media->banner = get....

$banner = get_banners_site('banner_contato');
$config = get_config_site();
?>

<!-- <div class="row w-100 m-0">
    <div class="col w-100 m-0">
        <img class="w-100" src="<?= img_url('banners/banner-desck-trabalhe-conosco.jpg') ?>" alt="<?=$banner[1]?>" id="banner" title="<?=$banner[1]?>">
    </div>
</div> -->

<div class="banner-desktop d-none d-lg-block">
    <img class="w-100" src="<?= img_url('banners/banner-desck-trabalhe-conosco.jpg') ?>" alt="Trabalhe Conosco" title="Trabalhe Conosco">
</div>

<div class="banner-mobile d-lg-none d-xl-none">
    <img class="w-100" src="<?= img_url('banners/trabalhe_conosco-mobile.jpg') ?>" alt="Trabalhe Conosco" title="Trabalhe Conosco">
</div>



<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <header>
                <h1 id="page-title" >Escolha uma área de atuação</h1>
            </header>
        </div>
    </div>  

    <form class="form" id="form" method="POST" data-remote="true" focus-response="#message" action="<?=base_url() ?>WB_Form_controller/trabalhe_conosco">
    
        <div class="row">
            <ul class="area_atuacao col-sm-12">
                <li><label><input type="radio" name="Area" value="Comercial" >Comercial</label></li>
                <li><label><input type="radio" name="Area" value="Administrativo" >Administrativo</label></li>
                <li><label><input type="radio" name="Area" value="Área" >Área Medica</label></li>
                <li><label><input type="radio" name="Area" value="Técnica" >Técnica</label></li>
                <li><label><input type="radio" name="Area" value="Operacional" >Operacional</label></li>
                <li><label><input type="radio" name="Area" value="Atendimento" >Atendimento</label></li>
            </ul>
            <div class="col-sm-12 file_curriculo">
                <strong>Currículo (Apenas .pdf ou .docx)</strong>
                <input type="file" name="file_input">
            </div>  
        </div>
        <input type="hidden" name="origem" value="<?=$title?>">
        <div class="m-0 mt-5 row">
            <?php
                $this->load->view('web/_form_trabalhe_conosco')
            ?>
        </div>
    </form>

    <?php $this->load->view('web/_clientes_footer', ['media' => $media]); ?>
    
</div>