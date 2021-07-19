<?php $gallery = getGallery(10, false); ?>

<div class="jobs-recentes">
    <div class="row justify-content-lg-center mg-0 info-job-center">                
        <div class="row justify-content-lg-center justify-content-md-center">
            <div class="col col-lg-3 col-sm-6 col-md-6 b-r">
                <h5 class="animate__animated animate__backInRight wow animate__delay-0.2s" >JOBS RECENTES</h5>
            </div>
            <div class="col col-lg-6 col-sm-6 col-md-6 right-text jobs-text">
                <p class="animate__animated animate__backInLeft wow animate__delay-1s">
                    CRIATIVIDADE E TÉCNICA NA CRIAÇÃO DA SUA IDENTIDADE VISUAL ATRAIRÁ AINDA<br> MAIS SEUS
                    CLIENTES
                    EM
                    POTENCIAL, POIS A SUA MARCA SE COMUNICARÁ COM O SEU PÚBLICO
                </p>
            </div>
        </div>
    </div>
 
    <div class="row jobs-carousel">
        <div class="columns">
            <div class="pl-carousel owl-carousel carousel owl-theme"  id="owl-carousel-jobs">
                <?php foreach ($gallery as $key => $file) :  ?>
                    <a class="item-carousel" data-video="<?=$file->youtube_id?>" data-img="<?=$file->url?>" data-saibamais="<?=$file->link_url?>">
                        <img class="img-fluid z-depth-1"
                            src="<?=$file->url?>" alt="<?=$file->title?>"
                            data-toggle="modal" data-target="#modal1">
                    </a>   
                <?php endforeach ?>                                
            </div>
        </div>
    </div>
</div>

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

<script>
$(function() {
    $('#owl-carousel-jobs').owlCarousel({
        loop:true,
        margin:0,
        nav:false,
        dots:false,
        autoplayTimeout: 5000,
        autoplay: true,
        responsive:{
            0:{
                items:1,
            },
            580:{
                items:1,
            },
            1000:{
                items:3
            },
        }
    });
})
</script>