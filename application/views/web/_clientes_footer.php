<div class="container carousel-cls">
    <h2 class="title">CLIENTES</h2>
    <div id="owl-carousel" class="owl-carousel text-center">
        <?php foreach ($media->footer_customers as $logo) :  ?> 
            <img src="<?= base_url('assets/img/gallery/' . $logo->file ) ?>" alt="<?=$logo->title?>">                 
        <?php endforeach ?>
    </div>
</div>

<script>
$(document).ready(()=>{
    $('#owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        dots:false,
        autoplayTimeout: 5000,
        autoplay: true,
        responsive:{
            0:{
                items:2,
            },
            1000:{
                items:7
            },
        }
    });
});
</script>