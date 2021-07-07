<?php
    $banner = get_banners_site('empresa_fix_banner');


    dd($banner);

    die;
   

?>
<?php if(isset($banner[2])): //banners responsive?>
    <input disabled value="<?=$banner[0]?>" id="banner_desktop" hidden="hidden" type="text">
    <input disabled value="<?=$banner[3]?>" id="mobile_banner" hidden="hidden" type="text">
    <script src="<?= base_url('assets/js/web/')?>changeMobileBanner.js?v=1"></script>
<?php endif;?>
<div class="mt-4 hero-unit row ">
    <div class="col-sm-12">
            <img src="<?= img_url('banners/'. $banner[0]) ?>" alt="<?=$banner[1]?>" id="banner" title="<?=$banner[1]?>">
    </div>
</div>

<div class="mt-4 container">
    <div class="mb-5 pb-5 bottom-line">
        <h1 class="title-desc">quem somos</h1>
        <p class="text-about mb-3">Localizada em Mauá-SP, no condomínio ACIBAM, a Strutech é uma empresa de automação e engenharia industrial, que atua no mercado desde 2010 oferecendo soluções para ou aumento de produtividade, aumento dos níveis de segurança das máquinas e redução de custos.</p>

        <p class="text-about mb-3">Fornecemos materiais e mão de obra especializada e de qualidade em conformidade com as normas da ABNT. Ao longo desses anos a Strutech se consolidou no mercado de automação através do desenvolvimento de projetos especiais, atendendo os mais diversos tipos de indústria.</p>

        <p class="text-about mb-3">Nossa equipe de Engenharia visa identificar as necessidades de nossos clientes para que o resultado de nosso trabalho seja surpreendente. Nossas soluções são eficazes e motivadas pelo trabalho em equipe, valorização pessoal e conhecimento técnico.</p>

        <p class="distribuidor-text mb-3">Somos distribuidores oficiais de marcas importantes e reconhecidas mundialmente como:</p>

        <div class="client-group">
            <img class="partner-image right-border" src="<?= base_url('assets/img/partners/')?>TEMP_omron.png" alt="Omron" title="Omron">
            <img class="partner-image right-border" src="<?= base_url('assets/img/partners/')?>TEMP_univer.png" alt="Phoenix Contact" title="Phoenix Contact">
            <img class="partner-image" src="<?= base_url('assets/img/partners/')?>TEMP_phoenix.png" alt="Univer" title="Univer">
        </div>        
    </div>

    <div class="group-missions mb-4">
        <div class="flex-image mb-4 ">
            <img class="mission-img" src="<?= base_url('assets/img/icons') ?>/missao.png" title="Missão" alt="missao-icon">
            <h3 class="ml-3 title-desc">Missão</h3>
        </div>
        <p class="text-about mb-2">Fornecer soluções em automação industrial que superem as expectativas dos clientes, contribuindo assim para o aumento de produtividade, redução de custos e a modernização do setor industrial.</p>
        <div class="flex-image mb-4">
            <img class="mission-img" src="<?= base_url('assets/img/icons') ?>/visao.png" title="Missão" alt="missao-icon">
            <h3 class="ml-3 title-desc">Visão</h3>
        </div>
        <p class="text-about mb-2">Ser referência em soluções de automação que agreguem valor ao processo produtivo, melhorem produtividade, qualidade e seurança. E como consequência valorizando as relações humanas.</p>
        <div class="flex-image mb-4">
            <img class="mission-img" src="<?= base_url('assets/img/icons') ?>/TEMP_valores.jpg" title="Missão" alt="missao-icon">
            <h3 class="ml-3 title-desc">valores</h3>
        </div>
        <p class="text-about mb-2">Honestidade com nossos clientes, parceiros e colaboradores. Pontualidade, comunicação assertiva, resiliência, transferência de conhecimento e inovação.</p>
    </div>
    <img class="mb-5 hist-img" src="<?= base_url('assets/img/')?>historia.png" title="Nossa Trajetória" alt="historia-banner">
    
    <div class="top-line bottom-line">
        <div style="display: block;" class="pb-4 pt-4 owl-carousel carousel owl-theme">
            <a href="<?=base_url('assets/img/empresa/empresa1.jpg'); ?>" 
                    data-title="Empresa" 
                    data-lightbox="Empresa" 
                    class="link-preview">
                <img src="<?=base_url('assets/img/empresa/empresa1.jpg')?>" title="Empresa" alt="Imagem Empresa">
            </a> 
            <a href="<?=base_url('assets/img/empresa/empresa2.jpg'); ?>"  
                data-title="Empresa" 
                    data-lightbox="Empresa" 
                    class="link-preview">           
                <img src="<?=base_url('assets/img/empresa/empresa2.jpg')?>" title="Empresa" alt="Imagem Empresa">
            </a>  
            <a href="<?=base_url('assets/img/empresa/empresa3.jpg'); ?>"  
                data-title="Empresa" 
                    data-lightbox="Empresa" 
                    class="link-preview"> 
                <img src="<?=base_url('assets/img/empresa/')?>empresa3.jpg" title="Empresa" alt="Imagem Empresa">
            </a>  
            <a href="<?=base_url('assets/img/empresa/empresa4.jpg.'); ?>"  
                data-title="Empresa" 
                    data-lightbox="Empresa" 
                    class="link-preview"> 
                <img src="<?=base_url('assets/img/empresa/')?>empresa4.jpg" title="Empresa" alt="Imagem Empresa">
            </a>  
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-sm-12">
            <div class="flex-center mt-4">
                <p class="l-blue more ">
                    deseja mais informações
                </p>
            </div>
        </div>
    </div>

    <div class="mt-3 row ">
        <?php
            $this->load->view('web/_form_footer')
        ?>        
    </div>




</div>   
<script>
$(document).ready(()=>{
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        responsive:{
            0:{
                items:1,
            },
            500:{
                items:2,
            },
            1000:{
                items:4
            },
        }
    });
});
</script>