
<?php 
    $galeria = getGallery(5, false);
    $video = getGallery(6, false);
    $fixBanner = getGallery(7, false);
    $fixBanner = $fixBanner[count($fixBanner) - 1];
?>
       

<section id="home">
    <div class="main-banner owl-carousel">
       
        <?php foreach ($galeria as $item) :  ?>
            <div class="item">
                <?php if ( $item->link ):  ?>
                    <a href="<?=$item->link?>">
                <?php endif ?>
                <img src="<?=base_url('assets/img/gallery/')?><?=$item->file?>">
                <?php if ( $item->link ):  ?>
                    </a>
                <?php endif ?>
            </div>
        <?php endforeach ?>

    </div>
    <div class="container">
        <div class="row">
            <div class="col-6">

                <div class="main-chamada">
                    <p><strong>Sua loja tem potencial e você não sabia</strong></p>

                    <h2>USE AS REDES SOCIAIS DO SEU SUPERMERCADO DE FORMA ESTRATÉGICA E ALCANCE 1000 PESSOAS COM
                        *R$ 4,99/CAMPANHA.</h2>

                    <p>Conheça os 3 pilares de sucesso da Divermidia para sua loja ampliar o potencial de vendas
                        pelo menor custo-beneficio</p>
                </div>

                <p class="text-center">
                    <a href="" class="btn btn-primary btn-saiba">Saiba Mais</a>
                </p>

                <?php $this->load->view('web/_form_main') ?>

            </div>
            <div class="col-6 banner-fixo">
                <img alt="<?=$fixBanner->title?>" title="<?=$fixBanner->title?>" class="animate__animated animate__backInDown" src="<?=base_url('assets/img/gallery/')?><?=$fixBanner->file?>">
            </div>
        </div>
    </div>
</section>

<section id="agencia">
    <div class="container">
        <div class="row justify-content-lg-center">
            <div class="col col-8 text-center">
                <?=$texto?>
                <p class="text-center">
                <a href="<?=base_url($pageList['agencia']->slug)?>" class="btn btn-primary btn-saiba justify-content-lg-center">
                Saiba Mais
                </a>
                </p>
            </div>
            <div class="col col-8 text-center">
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


<?php $this->load->view('web/jobs_recentes') ?>


<section id="contato">
    <div class="container">
        <div class="row justify-content-lg-center">
            <div class="col col-5 text-justify">
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
            <div class="col col-5 text-center">
                <img src="<?=base_url('assets/img/')?>/ideias.png">
            </div>

            <div class="container">
                <div class="footer-img">
                    <ul>
                        <li>
                            <a href="<?=base_url($pageList['criative']->slug)?>">
                                <img style="padding-bottom: 30px;" src="<?=base_url('assets/img/')?>/ico-criativo.png">                       
                            </a>
                        </li>
                        
                        <li><img src="<?=base_url('assets/img/')?>/ico-producao-video.png"></li>
                        <li><img style="padding-bottom: 10px;" src="<?=base_url('assets/img/')?>/ico-mk-digital.png"></li>
                        <li><img style="padding-bottom: 7px;" src="<?=base_url('assets/img/')?>/ico-sites.png"></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<section>

    <div class="container col-6">
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
