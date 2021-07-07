
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
        <p class="lead text-center">PORTINARI <br /> Cadastro para acesso ao Portal.</p>
        <div class="container">
            <!-- <form data-remote="true" focus-response="#mensagem" id="form" method="post" class="form-signin" action="logincontroller/autenticacao">
                <h2 class="form-signin-heading">Faça o Login</h2>
                <div class="form-group">
                    <label for="exampleInputEmail1">Usuário</label>
                    <input name="usuario" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Usuário">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input name="senha" type="password" class="form-control" id="Senha" placeholder="Senha">
                </div>

                <button type="submit" class="btn btn-primary">Entrar</button>
                <p id="mensagem" class="mensagensAlerta"></p>
            </form> -->

            <div class="row">
                <div class="col-12 form-cadastro-user">
                    <form class="form-signin"  data-remote="true" focus-response="#mensagem" id="form" method="post" action="Cadastro_usuario_controller/cadastrarDadosUsuario">
                    <fieldset> <legend>Dados do Cadastro</legend>
                    <div class="form-row">
                        <div class="col">
                            <label for="inputName">Nome*</label>
                            <input name="nome"  type="text" class="form-control" id="inputName" aria-describedby="inputName" placeholder="Seu nome">
                         </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="exampleInputEmail1">Endereço de email*</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email">
                          </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="celular">Celular*</label>
                            <input name="celular" type="text" class="form-control phone_with_ddd" id="celular" aria-describedby="celular" placeholder="(xx) xxxx-xxxx">
                          </div>

                        <div class="col">

                            <label for="telefone">Telefone</label>
                            <input name="telefone" type="text" class="form-control phone_with_ddd" id="telefone" aria-describedby="telefone" placeholder="(xx) xxxx-xxxx">
                          </div>
                        
                    </div>

                    <div class="form-row">
                        <div class="col-3">
                            <label for="cep">Cep*</label>
                            <input name="cep" type="text" class="form-control cep" id="cep" aria-describedby="cep" placeholder="xxxxx-xxx">
                        </div>
                        <div class="col-7">
                            <label for="rua">Rua*</label>
                            <input name="rua" type="text" class="form-control" id="rua" aria-describedby="rua" placeholder="Nome da rua">
                        </div>
                        <div class="col-2">
                            <label for="numero">Número</label>
                            <input name="numero" type="text" class="form-control" id="numero" aria-describedby="numero" placeholder="Nº">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-5">
                            <label for="cidade">Cidade*</label>
                            <input name="cidade" type="text" class="form-control" id="cidade" aria-describedby="cidade" placeholder="Cidade">
                        </div>
                         <div class="col-4">
                            <label for="bairro">Bairro*</label>
                            <input name="bairro" type="text" class="form-control" id="bairro" aria-describedby="estado" placeholder="Bairro">
                        </div>

                        <div class="col-3">
                            <label for="estado">Estado*</label>
                            <input name="uf" type="text" class="form-control" id="uf" aria-describedby="estado" placeholder="Estado">
                        </div>
                    </div>


                      </fieldset>

                    <fieldset> <legend>Dados de acesso</legend>
                      <div class="form-row">
                        <div class="col">
                            <label for="inputUsuario">Login</label>
                            <input name="login"  type="text" class="form-control" id="inputUsuario" aria-describedby="inputName" placeholder="Nome do usuário para logar no sistema">
                          </div>
                      </div>

                     <div class="form-row">
                        <div class="col">
                            <label for="inputSenha">Senha</label>
                            <input   name="senha"  type="password" class="form-control" id="inputSenha" placeholder="Senha">
                          </div>
                      </div>

                      <div class="form-row">
                        <div class="col">
                            <label for="inputRepetSenha">Repetir Senha</label>
                            <input   name="confirma_senha"  type="password" class="form-control" id="inputRepetSenha" placeholder="Repetiar a Senha">
                        </div>
                    </div>

                     </fieldset>
                        
                      <div class="form-row">
                        <div class="col">
                            <span class="help-block"></span>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
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
