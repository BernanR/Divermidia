<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="">
            <img src="<?=base_url('assets/img/')?>logo.png">
        </a>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav nav-bar">
                <a class="nav-link" href="#"><strong>Home</strong></a>
                <a class="nav-link" href="#" onClick="$('#agencia').animatescroll({scrollSpeed:3000,easing:'easeOutElastic',padding:80});"><strong>Agência</strong></a>
                <a class="nav-link" href="#" onClick="$('#portifolio').animatescroll({scrollSpeed:3000,easing:'easeOutElastic',padding:80});"><strong>Portifólio</strong></a>
                <a class="nav-link" href="contato.html"><strong>Contato</strong></a>
                <a class="nav-link" href="#"><strong>Blog</strong></a>
                <?php foreach ($menus as $menu) :  ?>
                    <li class="nav-item dropdown">
                        <?php if (count($menu->dropdown) > 0): /*se possui dropdowns...*/ ?>
                            <a title="<?=$menu->name?>" style="text-transform: uppercase;" class="nav-link dropdown rm-dropdown-mobile" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?=$menu->name?>
                            </a>
                            <ul class="dropdown-menu hide-dropdown-mobile" aria-labelledby="navbarDropdownMenuLink">
                                <?php foreach ($menu->dropdown as $dropMenu) : ?>
                                    <?php if ( $dropMenu->menu_id === $menu->id ):  ?>
                                        <li class="dropdown-item">
                                            <a title="<?=$dropMenu->name?>" href="<?=base_url($dropMenu->slug)?>"><?=$dropMenu->name?></a>
                                        </li>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </ul>
                        <?php else: ?>
                            <a class="nav-link" title="<?=$menu->name?>" href="<?=base_url($menu->slug)?>"><?=$menu->name?></a>
                        <?php endif ?>
                    </li>
                <?php endforeach ?>
            </div>
        </div>

        <div>
            <button type="submit" class="btn btn-primary btn-orcamento"><strong>ORÇAMENTO</strong></button>
        </div>

    </div>
</nav>
<div class="container">
    <div class="redes-sociais">
        <ul>
            <li><a class="header-nav-icon" href="<?= $config->link_youtube ?>" target="_blank" title="YouTube"><img src="<?=base_url('assets/img/icons/')?>ico-youtube.png"></a></li>
            <li><a class="header-nav-icon" href="<?= $config->link_instagram ?>" target="_blank" title="Instagram"><img src="<?=base_url('assets/img/icons/')?>ico-instagran.png"></a></li>
            <li><a class="header-nav-icon" href="<?= $config->link_facebook ?>" target="_blank" title="Pinteterest"><img src="<?=base_url('assets/img/icons/')?>ico-pinteterest.png"></a></li>
            <li><a class="header-nav-icon" href="<?= $config->link_facebook ?>" target="_blank" title="Facebook"><img src="<?=base_url('assets/img/icons/')?>ico-facebook.png"></a></li>
            <li><a class="header-nav-icon" href="<?= $config->link_facebook ?>" target="_blank" title="Linkedin"><img src="<?=base_url('assets/img/icons/')?>ico-linkedin.png"></a></li>
        </ul>
    </div>
</div>