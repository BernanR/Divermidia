<div class="row">
    <div class="col-12">
        <form data-remote="true" focus-response="#mensagem" id="form" method="post" action="AD_Usuarios_controller/atualizarDadosUsuario">
            <fieldset>
                <legend>Atualizar Dados Usuários</legend>

                 <div class="form-group">
                    <label for="inputName">Nome</label>
                    <input name="nome" value="<?=$dados->nome; ?>" required type="text" class="form-control" id="inputName" aria-describedby="inputName" placeholder="Seu nome">
                  </div>

                  <div class="form-group">
                    <label for="inputUsuario">Login</label>
                    <input disabled="true" value="<?=$dados->usuario; ?>" name="login" required type="text" class="form-control" id="inputUsuario" aria-describedby="inputName" placeholder="Nome do usuário para logar no sistema">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Endereço de email</label>
                    <input name="email" value="<?=$dados->email; ?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email">
                    <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
                  </div>

                   
                   <div class="form-group">
                    <label for="inputSenha">Senha</label>
                    <input   name="senha" type="password" class="form-control" id="inputSenha" placeholder="Senha">
                  </div>


                <!--<label>Email</label>-->
                <!--<input type="text" name="usuario1" value="<?php echo $dados->usuario; ?>" disabled>-->
                <input type="hidden" name="usuario" value="<?php echo $dados->usuario; ?>">
                 <div class="form-group">
                    <label for="inputRepetSenha">Repetir Senha</label>
                    <input   name="confirma_senha" type="password" class="form-control" id="inputRepetSenha" placeholder="Repetiar a Senha">
                  </div>

                <div class="form-group">
                  <label for="nivelAcesso">Nível de acesso</label>
                  <select id="nivelAcesso" name="nivel" class="form-control">
                            <option <?php if($dados->nivel == 1){echo "selected";} ?> value="1">Administrador</option>
                            <option  <?php if($dados->nivel == 2){echo "selected";} ?> value="2">Usuário</option>
                        </select>
                </div>
              
                <span class="help-block"></span>
                <input type="submit" class="btn btn-primary" value="Atualizar" >
                <input type="hidden" name="id" value="<?php echo $dados->id; ?>">
                <input type="hidden" name="origem" value="usuarios">
                <span class="help-block"></span>
                <div id="mensagem"></div>
            </fieldset>
        </form>
    </div>
</div>