<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?php echo base_url(); ?>" />
        <meta charset="utf-8">
        <title>Painel de gerenciamento de conteúdo.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
<?php 

phpinfo();
?>
        <!-- Le styles -->        
        <!-- bootstrap 5 -->
        <link rel="stylesheet" href="<?=base_url('assets/lib/bootstrap/css/')?>bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url('assets/css/')?>dist/admin.min.css">
        <!-- <link rel="stylesheet" href="<?=base_url('assets/css/')?>/admin.css?v=1"> -->

       <!--  <link href="assets/css/bootstrap-responsive.css" rel="stylesheet"> -->
        <link href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- <link href="assets/css/bootstrap-wysihtml5.css" rel="stylesheet"> -->

        <!-- upload files -->
        <link href="assets/lib/upload/css/jquery.filer.css" rel="stylesheet">
        <link href="assets/lib/upload/css/jquery.filer-dragdropbox-theme.css" rel="stylesheet">
        <!-- upload files -->
        <script src="assets/js/jquery.min.js"></script>
        
       
        <script src="assets/lib/upload/js/jquery.filer.min.js"></script>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="assets/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="icon" href="<?=img_url('favicon_32x32.png')?>" sizes="32x32">
        <link rel="icon" href="<?=img_url('favicon_192x192.png')?>" sizes="192x192">
        <link rel="apple-touch-icon-precomposed" href="<?=img_url('favicon_180x180.png')?>">
        
    </head>

    <body style="padding:0;">
        <div class="wrap h-100 d-flex flex-column">
            <div class="wrap h-100 d-flex flex-column">
                <nav id="w3" class="navbar-expand-lg navbar-light bg-light shadow-sm navbar">
                    <div class="container">
                    <a class="navbar-brand" href="<?=base_url('dashboard')?>">
                        <img style="width:100px;" src="<?=base_url('assets/img/')?>logo.png">
                    </a>

                    <ul style="margin-left:50px;" class="navbar-nav mr-auto mt-2 mt-lg-0 col-md-3 col-xl-3">
                        <li><a class="nav-link" target="_blank" href="<?=base_url()?>">Site</a></li>
                        <li><a class="nav-link" href="admin/settings/manage">Configurações</a></li>
                        <li><a class="nav-link" href="admin/pages/manage">Páginas</a></li>
                        <li><a class="nav-link" href="admin/gallery/manage">Galerias</a></li>
                    </ul>

                    <div id="w3-collapse" class="collapse navbar-collapse">
                        <ul id="w4" class="navbar-nav ml-auto nav">
                            <li>Seja bem vindo(a) <a href="admin/users/edit/<?=user_logged('id')?>" class="navbar-link"><?=first_name(user_logged('nome')) ?>.</a></li>
                            <li class="nav-item">
                                <a class="nav-logout" href="logout"><i class="fa fa-sign-out" aria-hidden="true"></i>Sair</a>
                            </li>
                        </ul></div>
                    </div>

                </nav>
            </div>
        </div>

        <?php 
            $url = $this->uri->segment(2) .'/'. $this->uri->segment(3) ;
        ?>
        <main class="d-flex">  
            <aside class="shadow">
                <ul id="w1" class="d-flex flex-column nav-pills nav">
                    <?php if (user_logged("nivel") == 1): ?>
                        <li class="nav-item"><span class="nav-title-link">Usuários</span></li>
                        <li class="nav-item"><a class="nav-link <?=($url=='usuarios/create')?'active':''?>" href="admin/usuarios/create">Cadastrar</a></li>
                        <li class="nav-item"><a class="nav-link <?=($url=='usuarios/manage-my-account')?'active':''?>"" href="admin/usuarios/manage-my-account">Gerenciar</a></li>
                        
                        <li class="nav-item"><span class="nav-title-link">Configurações</span></li>
                        <li class="nav-item"><a class="nav-link <?=($url=='settings/manage')?'active':''?>"" href="admin/settings/manage">Gerenciar</a></li>                            
                        
                        <li class="nav-item"><span class="nav-title-link">Galerias</span></li>
                        <li class="nav-item"><a class="nav-link <?=($url=='gallery/create')?'active':''?>"" href="admin/gallery/create">Cadastrar</a></li>
                        <li class="nav-item"><a class="nav-link <?=($url=='gallery/manage')?'active':''?>"" href="admin/gallery/manage">Gerenciar</a></li>                            
                        
                        <li class="nav-item"><span class="nav-title-link">Menus</span></li>
                        <li class="nav-item"><a class="nav-link <?=($url=='menus/create')?'active':''?>"" href="admin/menus/create">Cadastrar</a></li>
                        <li class="nav-item"><a class="nav-link <?=($url=='menus/manage')?'active':''?>"" href="admin/menus/manage">Gerenciar</a></li>
                        
                        <li class="nav-item"><span class="nav-title-link">Páginas</span></li>
                        <li class="nav-item"><a class="nav-link <?=($url=='pages/create')?'active':''?>"" href="admin/pages/create">Cadastrar</a></li>
                        <li class="nav-item"><a class="nav-link <?=($url=='pages/manage')?'active':''?>"" href="admin/pages/manage">Gerenciar</a></li>
                    <?php endif; ?>            
                    <!-- <li class="nav-item"><span class="nav-title-link">Perfil</span></li>
                    <li class="nav-item"><a class="nav-link <?=($url=='perfil/atualizar')?'active':''?>"" href="admin/perfil/atualizar">Editar</a></li> -->
                    <li class="nav-item"><span class="nav-title-link">Deslogar</span></li>
                    <li class="nav-item"><a class="nav-link <?=($url=='usuarios/create')?'active':''?>"" href="logout"><i class="fa fa-sign-out" aria-hidden="true"></i>Sair</a></li>        
                </ul>
            </aside>
            <div class="content-wrapper p-3">
                <?php $this->load->view($module) ?>
            </div>
        </main>

        <input type="hidden" value="<?=base_url()?>" id="base_url">
    
        <script src="<?=base_url('assets/js/')?>/popper.min.js"></script>
        <script src="<?=base_url('assets/js/')?>/bootstrap.min.js"></script>     
        <script src="assets/lib/jquery.mask.min.js"></script>
        <script src="assets/js/main.js?v=2"></script>

        
        <!-- <script src="assets/lib/fileuploader-trial/dist/jquery.fileuploader.min.js" type="text/javascript"></script>
        <script src="assets/lib/fileuploader-trial/custom.js" type="text/javascript"></script> -->

        <?php 
            if($ckeditor) init_editorhtml();
        ?>

        <script>
            $("li.page-item").find("a").addClass("page-link");

        </script>
    </body>
</html>
