<form data-remote="true" focus-response="#mensagem" id="form" method="post" action="AD_Setting_controller/update">
  <fieldset><legend>Editar Setting</legend>

    <div class="form-group">
        <label for="inputName">Nome:</label>
        <input value="<?=$setting[0]->key?>" disabled="true" name="name"  type="text" class="form-control" id="inputName" aria-describedby="inputName" placeholder="Nome">
    </div>

    <div class="form-row">
        <div class="col">
        <label for="inputName">Valor:</label>
        <textarea name="value" id="value" class="form-control"><?=$setting[0]->value?></textarea>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
        <label for="inputName">Observação:</label>
        <textarea name="note" id="note" class="form-control"><?=$setting[0]->note?></textarea>
        </div>
    </div>

    <input type="hidden" value="<?=$setting[0]->id?>" name="id">

    <span class="help-block"></span>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="<?=base_url('admin/settings/manage')?>" class="btn btn-light">voltar</a>
    <span class="help-block"></span>
    <p id="mensagem"></p>

  </fieldset>
</form>