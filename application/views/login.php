
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <base href="<?php echo base_url(); ?>" />
        <meta charset="utf-8">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link rel="stylesheet" href="<?=base_url('assets/css/')?>/bootstrap.min.css">

        <!-- <link href="assets/css/jquery-ui.css" rel="stylesheet"> -->
        <link href="assets/css/admin.css?v=1" rel="stylesheet">
        <style type="text/css">
            body {
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #f5f5f5;
            }

            .form-signin {
                max-width: 300px;
                padding: 19px 29px 29px;
                margin: 0 auto 20px;
                background-color: #fff;
                border: 1px solid #e5e5e5;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
                border-bottom: 4px solid #0069D9;
            }
            .form-signin .form-signin-heading,
            .form-signin .checkbox {
                margin-bottom: 10px;
            }
            .form-signin input[type="text"],
            .form-signin input[type="email"],
            .form-signin input[type="password"] {
                font-size: 16px;
                height: auto;
                margin-bottom: 15px;
                padding: 7px 9px;
            }
            p.logo{
                padding:0 35px;
                margin:0!important;
            }

            h3{
                text-align:center;
                margin:10px 0;
                color: #0069D9;
            }
        </style>

    </head>

    <body>
        <input type="hidden" id="base_url" value="<?=base_url()?>">
        <p class="lead text-center"><img style="width:100px;" src="<?=base_url('assets/img/')?>logo.png"><br /> Gerenciador de conteúdo.</p>

        <div class="container">
            <form data-remote="true" focus-response="#mensagem" id="form" method="post" class="form-signin" action="authentication">
                <p class="logo"><img src="<?=base_url('assets/img/manager_logo.png')?>"></p>
                <h3 class="form-signin-heading">Faça o Login</h3>
                <div>
                    <?php echo get_msg('msgOk') ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Usuário:</label>
                    <input name="usuario" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Usuário">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Senha:</label>
                    <input name="senha" type="password" class="form-control" id="Senha" placeholder="Senha">
                </div>

                <button type="submit" class="btn btn-primary">Entrar</button>
                <div class="form-row form-footer">
                    <div class="col">
                        <p id="mensagem" class="mensagensAlerta"></p>
                    </div>
                </div>
            </form>
        </div> 

        <!-- <p class="text-center">
            <small><a href="<?=base_url('esqueci-minha-senha')?>">Esqueci minha senha</a></small>
        </p>
        <p class="text-center">
            <small>Caso não possua um login, <a href="<?=base_url('cadastro-usuario')?>">faça seu cadastro</a></small>
        </p> -->
        <!-- /container -->

        <script src="<?=base_url('assets/js/')?>/jquery.min.js"></script>
        <script src="<?=base_url('assets/js/')?>/popper.min.js"></script>
        <script src="<?=base_url('assets/js/')?>/bootstrap.min.js"></script>


        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <!-- <script src="assets/js/jquery.js"></script>
        <script src="assets/js/jqform.js"></script>
        <script src="assets/js/bootstrap-transition.js"></script>
        <script src="assets/js/bootstrap-alert.js"></script>
        <script src="assets/js/bootstrap-modal.js"></script>
        <script src="assets/js/bootstrap-dropdown.js"></script>
        <script src="assets/js/bootstrap-scrollspy.js"></script>
        <script src="assets/js/bootstrap-tab.js"></script>
        <script src="assets/js/bootstrap-tooltip.js"></script>
        <script src="assets/js/bootstrap-popover.js"></script>
        <script src="assets/js/bootstrap-button.js"></script>
        <script src="assets/js/bootstrap-collapse.js"></script>
        <script src="assets/js/bootstrap-carousel.js"></script>
        <script src="assets/js/bootstrap-typeahead.js"></script> -->
        <script src="assets/js/main.js?v=1"></script>         
    </body>
</html>
