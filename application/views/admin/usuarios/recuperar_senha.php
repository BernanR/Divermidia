
<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?php echo base_url(); ?>" />
        <meta charset="utf-8">
        <title>Cadastro - Novo usuário</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link rel="stylesheet" href="<?=base_url('assets/css/')?>/bootstrap.min.css">

        <!-- <link href="assets/css/jquery-ui.css" rel="stylesheet"> -->
        <link href="assets/css/main.css?v=1" rel="stylesheet">
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

        </style>
        <!-- <link href="assets/css/bootstrap-responsive.css" rel="stylesheet"> -->

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="assets/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="icon" href="https://www.educaportinari.com.br/wp-content/uploads/2017/03/cropped-cropped-logo-portinari-273-32x32.jpg" sizes="32x32">
        <link rel="icon" href="https://www.educaportinari.com.br/wp-content/uploads/2017/03/cropped-cropped-logo-portinari-273-192x192.jpg" sizes="192x192">
        <link rel="apple-touch-icon-precomposed" href="https://www.educaportinari.com.br/wp-content/uploads/2017/03/cropped-cropped-logo-portinari-273-180x180.jpg">

    </head>

    <body>
        <p class="lead text-center">PORTINARI <br /> recuperar senha</p>
        <div class="container">

            <div class="row">
                <div class="col-12 form-cadastro-user">

                     

                    <form class="form-signin"  method="post" action="<?=current_url()?>">
                    
                         <?php  echo get_erros_validation(); ?>

                      <?php echo get_msg('msgErro') ?>
                      <?php echo get_msg('msgOk') ?>
                    <div class="form-row">
                        <div class="col">
                            <label for="exampleInputEmail1">Endereço de email*</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email" value="<?=$this->input->post('email')?>">
                        </div>
                    </div>

                        
                      <div class="form-row">
                        <div class="col">
                            <span class="help-block"></span>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                            <span class="help-block"></span>
                            <div id="mensagem"></div>
                        </div>
                    </div>
                        
                    </form>
                </div>
            </div>


        </div> 
        <p class="text-center">
            <small>Voltar para o <a href="<?=base_url('login')?>">login</a></small>
        </p>
        <!-- /container -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


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
        <script src="assets/lib/jquery.mask.min.js"></script>
        <script src="assets/js/main.js?v=1"></script> 

    </body>
</html>
