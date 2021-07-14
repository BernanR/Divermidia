<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="">
            <img src="<?=base_url('assets/img/')?>logo.png">
        </a>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav nav-bar">
                <ul>
                    <li><a class="nav-link" href="#home"><strong>Home</strong></a></li>
                    <li><a class="nav-link" href="#agencia"><strong>Agência</strong></a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <strong>Portifólio</strong>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><strong><a class="dropdown-item" href="/criativo">Criativo</a></strong></li>
                            <li><strong><a class="dropdown-item" href="/producao-videos">Producao de Vídeos</a></strong></li>
                            <li><strong><a class="dropdown-item" href="/marketing-digital">Marketing Digital</a></strong></li>
                            <li><strong><a class="dropdown-item" href="/sites">Sites</a></strong></li>
                        </ul>
                    </li>

                    <li><a class="nav-link" href="<?=base_url('contato')?>"><strong>Contato</strong></a></li>
                    <?php foreach ($menus as $menu) :  ?>
                        <li class="nav-item dropdown">
                            <?php if (count($menu->dropdown) > 0): /*se possui dropdowns...*/ ?>
                                <strong>
                                    <a title="<?=$menu->name?>" style="text-transform: uppercase;" class="nav-link dropdown rm-dropdown-mobile" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?=$menu->name?>
                                    </a>
                                </strong>
                                <ul class="dropdown-menu hide-dropdown-mobile" aria-labelledby="navbarDropdownMenuLink">
                                    <?php foreach ($menu->dropdown as $dropMenu) : ?>
                                        <?php if ( $dropMenu->menu_id === $menu->id ):  ?>
                                            <li class="dropdown-item">
                                            <strong><a title="<?=$dropMenu->name?>" href="<?=base_url($dropMenu->slug)?>"><?=$dropMenu->name?></a></strong>                                            
                                            </li>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </ul>
                            <?php else: ?>
                                <?php 
                                    $url = ($menu->url) ? $menu->url : base_url($menu->slug);
                                ?>
                                <strong>
                                    <a class="nav-link" title="<?=$menu->name?>" href="<?=$url?>"><?=$menu->name?></a>
                                </strong>
                            <?php endif ?>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>

        <div>
            <a href="<?=base_url('contato')?>" class="btn btn-primary btn-orcamento bg-red pulse-animate"><strong>ORÇAMENTO</strong></a>
        </div>

    </div>
</nav>

<div class="container">
    <div class="redes-sociais">
        <ul>
            <li><a class="header-nav-icon" href="<?= $config->link_yt ?>" target="_blank" title="YouTube"><img src="<?=base_url('assets/img/icons/')?>ico-youtube.png"></a></li>
            <li><a class="header-nav-icon" href="<?= $config->link_instagram ?>" target="_blank" title="Instagram"><img src="<?=base_url('assets/img/icons/')?>ico-instagran.png"></a></li>
            <li><a class="header-nav-icon" href="<?= $config->link_facebook ?>" target="_blank" title="Pinteterest"><img src="<?=base_url('assets/img/icons/')?>ico-pinteterest.png"></a></li>
            <li><a class="header-nav-icon" href="<?= $config->link_facebook ?>" target="_blank" title="Facebook"><img src="<?=base_url('assets/img/icons/')?>ico-facebook.png"></a></li>
            <li><a class="header-nav-icon" href="<?= $config->link_facebook ?>" target="_blank" title="Linkedin"><img src="<?=base_url('assets/img/icons/')?>ico-linkedin.png"></a></li>
        </ul>
    </div>
</div>