
<?php 
    $galeria = getGallery(5, false);
    $video = getGallery(6, false);
    $fixBanner = getGallery(7, false);
    $fixBanner = $fixBanner[count($fixBanner) - 1];

    $banners = json_decode($pageList['home']->banners);
?>


<section id="home">
    <div class="main-banner">
       
        <?php if ($banners):  ?>
        <div class="banner"><img src="<?=base_url('assets/img/banners/' . $banners->desktop )?>" alt=""></div>
        <?php endif ?>

    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12">

                <div class="main-chamada">
                    <?=$pageList['home']->content?>
                </div>

                <?php $this->load->view('web/_form_main') ?>

            </div>
            <div class="col-lg-6 order-first banner-fixo">
                <img alt="<?=$fixBanner->title?>" title="<?=$fixBanner->title?>" class="animate__animated animate__backInDown" src="<?=base_url('assets/img/gallery/')?><?=$fixBanner->file?>">
            </div>
        </div>
    </div>
</section>

<section id="agencia">
    <div class="container">
        <div class="row justify-content-lg-center">
            <div class="col-sm-12 col-8 text-center resume">
                <p><?=$pageList['agencia']->title?></p>
                <p><?=$pageList['agencia']->resume?></p>
                <p class="text-center">
                <a href="<?=base_url($pageList['agencia']->slug)?>" class="btn btn-primary btn-saiba justify-content-lg-center">
                Saiba Mais
                </a>
                </p>
            </div>
            <div class="col-lg-8 col-sm-11 text-center">
                <div class="video-agencia">
                    <iframe src="https://www.youtube.com/embed/<?=$video[0]->url?>" title="<?=$video[0]->title?>"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                    <p class="demo text-center">DEMO REEL 2021</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="portifolio">
    <div class="white-bg">
        <h2 class="text-center title">PORTIFÓLIO</h2>
    </div>
    <?php $this->load->view('web/jobs_recentes') ?>
</section>

<section id="contato">
    <div class="container">
        <div class="row justify-content-lg-center">
            <div class="col-sm-12 col-lg-5 text-justify">
                <p>a divermidia participa da construção de autoridade e reputação das marcas. oferecemos
                    soluções
                    inovadoras, sempre com agilidade na execução e estratégias balizadas pela união de anos de
                    experiência no mercado publicitário à alta capacidade de abraçar o melhor das novas
                    tecnologias
                    . atendemos os nosso clientes de forma personalizafa, trabalhando em conjunto para aumentar
                    a
                    performance e atender todas as necessidades. conheça um pouco dos serviços da ego
                    comunicação.
                </p>
            </div>
            <div class="col-sm-12 col-lg-5 text-center">
                <img src="<?=base_url('assets/img/')?>/ideias.png">
            </div>

            <div class="container">
                <div class="footer-img col-sm-11 col-lg-12">
                    <ul>
                        <li>
                            <a href="<?=base_url($pageList['criative']->slug)?>">
                                <img data-wow-offset="5"   class="animate__animated animate__backInLeft wow animate__delay-1s" style="padding-bottom: 30px;" src="<?=base_url('assets/img/')?>/ico-criativo.png">                       
                            </a>
                        </li>
                        
                        <li ><img data-wow-offset="5"  class="animate__animated animate__backInLeft wow animate__delay-0.5s" src="<?=base_url('assets/img/')?>/ico-producao-video.png"></li>
                        <li ><img data-wow-offset="5"  class="animate__animated animate__backInRight wow animate__delay-0.5s" style="padding-bottom: 10px;" src="<?=base_url('assets/img/')?>/ico-mk-digital.png"></li>
                        <li ><img data-wow-offset="5"  class="animate__animated animate__backInRight wow animate__delay-1s" style="padding-bottom: 7px;" src="<?=base_url('assets/img/')?>/ico-sites.png"></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<section>
    <div class="container col-lg-6">
        <?php $this->load->view('web/_form_main') ?>
    </div>
</section>

<div class="modal fade modal-lightbox" id="modal-lightbox-galery" aria-hidden="true" aria-labelledby="modal-lightbox-galery" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">     
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <a href="#" class="btn-link saiba-mais">SAIBA MAIS</a>
        <button type="button" class="btn btn-link close" data-bs-dismiss="modal">FECHAR X</button>
      </div>
    </div>
  </div>
</div>

<script src="<?=base_url('assets/lib/wow/wow.min.js')?>"></script>   
<script>
new WOW({
    boxClass:     'wow',      // default
    animateClass: 'animate__animated', // default
    offset:       0,          // default
    mobile:       true,       // default
    live:         true        // default
}).init();
</script>