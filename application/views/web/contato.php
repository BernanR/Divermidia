<?php

//SETAR O BANNER NA VARIÁVEL VINDA DO WEB_TEMPLATE $media
//$media->banner = get....

$banner = get_banners_site('banner_contato');
$config = get_config_site();

?>

<!-- <div class="row w-100 m-0">
    <div class="col w-100 m-0">
        <img class="w-100" src="<?= img_url('banners/banner-contato.jpg') ?>" alt="<?=$banner[1]?>" id="banner" title="<?=$banner[1]?>">
    </div>
</div> -->


<div class="banner-desktop d-none d-lg-block">
    <img class="w-100" src="<?= img_url('banners/banner-contato.jpg') ?>" alt="Contato" title="Contato">
</div>

<div class="banner-mobile d-lg-none d-xl-none">
    <img class="w-100" src="<?= img_url('banners/banner-contato-mobile.jpg') ?>" alt="Contato" title="Contato">
</div>

<div class="container">
    <div class="row mt-5 text-center d-block d-lg-none">
        <div class="col-sm-12 d-flex align-items-center justify-content-center">
            <img class="contato-icon" src="<?=base_url('assets/img')?>/icons/circle_blue_phone.png" > 
            <p class="color-blue"><?= $config->contact_phone_top ?></p>
        </div>
        <div class="col-sm-12 d-flex align-items-center justify-content-center">
            <img class="contato-icon" src="<?=base_url('assets/img')?>/icons/circle_blue_mail.png">
            <p class="color-blue"> <?= $config->contact_email_top ?> </p>
        </div>
    </div>
    <div class="contato mt-5 d-none d-lg-flex flex-row justify-content-center">
        <div class="contato-col"> 
            <img class="contato-icon" src="<?=base_url('assets/img')?>/icons/circle_blue_phone.png" > 
            <p><?= $config->contact_phone_top ?></p>
        </div>
        <div class="contato-col">
            <img class="contato-icon" src="<?=base_url('assets/img')?>/icons/circle_blue_mail.png">
            <p> <?= $config->contact_email_top ?> </p>
        </div>
    </div>  

    <div class="m-0 mt-5 row form-contato">
        <?php
            $this->load->view('web/_form_footer')
        ?>        
    </div>

    
    <p class="color-blue d-flex align-items-center"><img class="contato-icon" src="<?=img_url('icons/blue_marker.png')?>"> <?=$config->andress_company?> / Horário de Atendimento: <?=$config->company_schedule?> </p>
    <div class="row mb-5 mt-4">
        <div class="col-sm-12 text-center">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.551990009492!2d-46.635147284978366!3d-23.54861076700678!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce59aabf4102db%3A0x220a1ed2395dbfcb!2sRighi%20%26%20Righi%20Medicina%20e%20Seguran%C3%A7a%20do%20Trabalho!5e0!3m2!1spt-BR!2sbr!4v1611014653125!5m2!1spt-BR!2sbr"
                width="100%" 
                height="500" 
                frameborder="0" 
                allowfullscreen="" 
                aria-hidden="false" 
                tabindex="0"
            >
            </iframe>
        </div>
    </div>

    <?php $this->load->view('web/_clientes_footer', ['media' => $media]); ?>
    
</div>