<?php
    $banner = get_banners_site('produtos_fix_banner');
    $product->itsInCart = hasProductCart($product->id);

    $brand = $this->uri->segment(2);

    $banner_desktop = '';
    $banner_mobile = '';
    $banner_alt = $banner[1];
    $data_bn = 'true';

    if($banners->desktop) {
        $banner_desktop = $banners->desktop;
        $banner_alt = $brand;
        
    }else{
        $banner_desktop =  $banner[0];
        $data_bn = 'false';
    }

    if($banners->mobile) {
        $banner_mobile = $banners->mobile;
        $banner_alt = $brand;
    }else{
        $banner_mobile = $banner[3];
        $data_bn = 'false';
    }    
    
?>


<?php if ($data_bn == 'false'):  ?>

    <?php if ( $banner_desktop ):  ?>
        <input disabled value="<?=$banner_desktop?>" id="banner_desktop" hidden="hidden" type="text">
    <?php endif ?>

    <?php if ( $banner_mobile ):  ?>
        <input disabled value="<?=$banner_mobile?>" id="mobile_banner" hidden="hidden" type="text">
    <?php endif ?>

    
<?php else: ?>

    <?php if ( $banner_desktop ):  ?>
        <input type="text" disabled hidden id="banner_brand_desktop" value="<?=$banner_desktop?>">
    <?php endif ?>

    <?php if ( $banner_mobile ):  ?>
        <input type="text" disabled hidden id="banner_brand_mobile" value="<?=$banner_mobile?>">
    <?php endif ?>

<?php endif; ?>


<script src="<?= base_url('assets/js/web/')?>changeMobileBanner.js?v=2"></script>

<div class="mt-4 hero-unit row ">
    <div class="col-sm-12">
        <img src="<?= img_url('banners/'. $banner_desktop)?>" data-bn="<?=$data_bn?>" alt="<?=$banner_alt?>" id="banner" title="<?=$banner_alt?>">     
    </div>
</div>


<div class="mt-4 container">
    <p id="product-text mb-3">
        <?=$brand_description?>
    </p>
    <br><br>
    <div class="container">
        <div class="row product-row bottom-line pb-5">
            <div class="col-sm-12 col-md-5 image-col">
                <a href="<?=base_url('assets/img/products/'.$product->file.''); ?>" 
                    data-title="<?=$product->title?>" 
                    data-lightbox="<?=$product->id?>" 
                    data-title="<?=$product->name?>" 
                    class="link-preview">                
                    <img class="product-img" src="<?=base_url('assets/img/products/'.$product->file.''); ?>" alt="produto" title="<?=$product->title?>">
                </a>
            </div>
            <div class="col-sm-12 col-md-7 desc-col">
                <h3 class="title-desc"> <?=$product->name?> </h3>
                <h6 class="subtitle-desc mb-3"><?=$product->title?> </h6>
                <p><?=$product->description?></p>          
                <a href="<?=base_url('cart/add/'. $product->id)?>"   id="carrinho_btn" 
                class="<?= ($product->itsInCart ) ? 'btn-success' : 'orange' ?>  btn btn-primary">
                    <?php if($product->itsInCart): ?>
                            JÁ ESTÁ NO ORÇAMENTO
                        <?php else: ?>    
                            ADICIONAR AO ORÇAMENTO
                        <?php endif; ?>
                </a>
            </div>
        </div>
    </div>
  
    <!-- CAROUSEL -->
    <div class=" row row-products bottom-line pb-5">
    <h3 class="text-center mt-4 title-desc hd"> PRODUTOS RELACIONADOS</h3>
        <div style="display: block;" class="owl-carousel carousel owl-theme">
            <?php foreach($relatedProducts as $key => $relatedProduct):?> 
                <?php $relatedProduct->itsInCart = hasProductCart($relatedProduct->id) ?>
                <div class="item col-sm-12">
                    <div class="row product-row pt-5">
                        <div class="product-col-image col-sm-6">
                        <img class="product-img" src="<?=base_url('assets/img/products/'.$relatedProduct->file.''); ?>" alt="produto" title="<?=$relatedProduct->title?>">
                        </div>
                        <div class="product-col-desc col-sm-6">
                            <h3 class="title-desc"> <?=$relatedProduct->title?> </h3>
                            <h6 class="subtitle-desc mb-3"><?=$relatedProduct->name?> </h6>

                            <p class="text-desc mb-3"><?=$relatedProduct->resume?></p>

                            <div class="flex">
                                <a href="<?= base_url('produto/'.$relatedProduct->slug)?>" class="blue btn btn-primary mr-2">LEIA MAIS</a>
                                <a href=" <?= base_url('cart/add/'.$relatedProduct->id) ?> " class="<?= ($relatedProduct->itsInCart ) ? 'btn-success' : 'orange' ?>  btn btn-primary">
                                <?php if($relatedProduct->itsInCart): ?>
                                        JÁ ESTÁ NO ORÇAMENTO
                                    <?php else: ?>    
                                        ADICIONAR AO ORÇAMENTO
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
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
        loop:false,
        margin:10,
        nav:false,
        
        responsive:{
            0:{
                items:1,
            },
            1000:{
                items:2
            },
        }
    });
});
</script>