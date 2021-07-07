

<form data-remote="true" focus-response="#mensagem" id="form" method="post" action="AD_Usuarios_controller/cadastrarDadosUsuario">
  <fieldset> <legend>Cadastrar Usuários</legend>
  <div class="form-group">
    <label for="inputName">Nome</label>
    <input name="nome" required type="text" class="form-control" id="inputName" aria-describedby="inputName" placeholder="Seu nome">
  </div>

  <div class="form-group">
    <label for="inputUsuario">Login</label>
    <input name="login" required type="text" class="form-control" id="inputUsuario" aria-describedby="inputName" placeholder="Nome do usuário para logar no sistema">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Endereço de email</label>
    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email">
    <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
  </div>

  <div class="form-group">
    <label for="inputSenha">Senha</label>
    <input   name="senha" required type="password" class="form-control" id="inputSenha" placeholder="Senha">
  </div>

  <div class="form-group">
    <label for="inputRepetSenha">Repetir Senha</label>
    <input   name="confirma_senha" required type="password" class="form-control" id="inputRepetSenha" placeholder="Repetiar a Senha">
  </div>

    <div class="form-group">
      <label for="nivelAcesso">Nível de acesso</label>
      <select id="nivelAcesso" name="nivel" class="form-control">
                <option value="1">Administrador</option>
                <option value="2">Usuário</option>
            </select>
    </div>

    <span class="help-block"></span>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
    <span class="help-block"></span>
    <div id="mensagem"></div>

    </fieldset>
</form>