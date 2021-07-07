<div class="banners">
    <?php if (isset($banners['desktop'])):  ?>
        <?php if ($banners['desktop'] != ''):  ?>
            <div class="banner-desktop d-none d-lg-block">
                <img class="w-100" src="<?=base_url('assets/img/banners/' . $banners['desktop']->filename)?>" alt="<?=$banners['desktop']->alt?>" title="<?=$banners['desktop']->title?>">
            </div>
        <?php endif ?>
    <?php endif ?>

    <?php if (isset($banners['mobile'])):  ?>
        <?php if ($banners['mobile'] != ''):  ?>
            <div class="banner-mobile d-lg-none d-xl-none">
                <img class="w-100" src="<?=base_url('assets/img/banners/' . $banners['mobile']->filename)?>" alt="<?=$banners['mobile']->alt?>" title="<?=$banners['mobile']->title?>">
            </div>
        <?php endif ?>
    <?php endif ?>
</div>