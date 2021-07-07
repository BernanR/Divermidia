<?php
/*
    //$_page->type === 1 ? $banner = get_banners_site('servicos_fix_banner') : $banner = get_banners_site('produtos_fix_banner');

<div class="mt-4 hero-unit row ">
    <div class="col-sm-12">
        <img src="<?= img_url('banners/'. $banner[0])?>" alt="<?=$banner[1]?>" id="banner" title="<?=$banner[1]?>">
    </div>
</div>
*/

?>
<div class="container">
    <div class="list-group">
        <?php foreach($_pages as $page):?>
            <?php $url = $page->type == 1 ? 's/' : 'p/'; ?>
            <a href="<?=base_url($url . $page->slug)?>" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="card flex-row flex-wrap product-list">                            
                    <div class="card-block px-2">
                        <h4 class="card-title"><?=$page->title?></h4>
                        <p class="card-text"> <?= $page->type == 1 ? 'Serviço' : 'Projeto' ?> </p>
                        <small><?=resumo($page->content, 20)?></small>
                    </div>
                    <div class="w-100"></div>
                </div>
            </a>
        <?php endforeach ?>
    </div>
</div>
   