<?php
    $banner = get_banners_site('produtos_fix_banner');
    $brand = $this->uri->segment(2);


    $banner_desktop = '';
    $banner_mobile = '';
    $banner_alt = $banner[1];
    $data_bn = 'true';

    if ($brand === 'all') {
        $banner_desktop = $banner[0];
        $banner_mobile = $banner[3];
        $data_bn = 'false';
    }else{

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
    }
?>


<?php if ($brand === 'all'):  ?>

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

<?php endif ?>


<script src="<?= base_url('assets/js/web/')?>changeMobileBanner.js?v=2"></script>

<div class="mt-4 hero-unit row ">
    <div class="col-sm-12">
        <img src="<?= img_url('banners/'. $banner_desktop)?>" data-bn="<?=$data_bn?>" alt="<?=$banner_alt?>" id="banner" title="<?=$banner_alt?>">     
    </div>
</div>

<div class="mt-4 container">

    <?php if ($brand_description) : ?>
        <p id="product-text">
            <?=$brand_description?>
        </p>
    <?php endif ?>  

    <?php if($this->uri->segment(2) == 'all') :  ?>
        <div class="row filter-product mt-4 ">        
            <div class="col-sm-12 col-md-12 ">            
                <form action="<?=current_url()?>" method="GET" class="form-product">
                    
                    <?php if(count($brands) > 0) :  ?>
                        <div class="prod-list-brands pb-4">
                            <p>Marca</p>
                            <?php foreach ($brands as $k => $v) : ?>
                                <label>
                                    <input <?=(in_array($v->slug, $this->input->get())) ? 'checked' : '' ?> name="m_<?=$k?>" type="checkbox" value="<?=$v->slug?>"  > <?=$v->name?>                    
                                </label>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>
                    <?php if(count($categories) > 0) :  ?>
                        <div class="prod-list-categories pt-4 pb-4">
                            <p>Categoria</p>
                            <?php foreach ($categories as $k => $v) : ?>
                                <label>
                                    <input <?=(in_array($v->slug, $this->input->get())) ? 'checked' : '' ?> name="c_<?=$k?>" type="checkbox" value="<?=$v->slug?>"  > <?=$v->name?>                    
                                </label>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>
                </form>
                <?php if($this->input->get()) :  ?>
                    <a class="mt-4" href="<?=base_url('produtos/all')?>">Todos</a>
                <?php endif ?>
            </div>
        </div>
    <?php endif ?>
    <!-- PRODUTOS -->
    <div class="bottom-line mt-5 pb-5 mb-4 product-containt">
        <div class="row row-products ">                    
            <?php $this->load->view('web/_product_item', [
                'products' => $products
            ]); ?>          
        </div>
                
        <?php if ($products_total_qtd > $qtd_by_pag): ?>
            <!-- fim linha produto  -->
            <div class="row mt-5 div-more-p">
                <div class="col-sm-12">
                    <div class="flex-center mt-4 box">
                        <img class="loading-prod" src="<?=img_url('ajax-loader.gif')?>" alt="">
                        <button id="more-products" class="blue more btn btn-primary">
                            mais produtos
                        </button>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
    <!-- fim container bottom-line! -->

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
        <?php $this->load->view('web/_form_footer') ?>       
    </div>
</div>

<?php $get = $this->input->get(); ?>

<form action="<?=base_url('WB_Produtos_controller/getProductAjax')?>" id="product_filter" type="POST" >
            
    <?php if ( $get): ?>
        
        <?php foreach ( $get as $k => $v) : ?>
            <input type="hidden" name="<?=$k?>" id="<?=$k?>" value="<?=$v?>"> 
        <?php endforeach ?>
    <?php endif ?>

    <input type="hidden" name="segment" id="brand" value="<?=$this->uri->segment(2)?>"> 
    <input type="hidden" name="brand" id="brand" value="<?=$this->uri->segment(2)?>"> 
    <input type="hidden" name="category" id="category" value="<?=$this->uri->segment(3)?>">
    <input type="hidden" name="page_init" id="page_init" value="<?=$page_init?>">    
</form>