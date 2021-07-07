
<form action="admin/media/update" focus-response="#mensagem" id="form" method="post" enctype="multipart/form-data">
  <fieldset><legend>Editar Banner</legend>
    <div class="row"> 
        <?php echo get_msg("msgErro"); ?>
    </div>

    <div class="row" style="margin:50px 0;"> 
      <?= $this->image_handler->thumb('./assets/img/banners/', $media->file) ?>
    </div>

    <div class="form-group">
        <label for="inputName">Nome:</label>
        <input disabled="true" value="<?=set_value('key', $media->key)?>" name="key"  type="text" class="form-control" id="inputTitle" aria-describedby="inputTitle" placeholder="Nome">
    </div>

    <div class="form-group">
        <label for="inputName">Título:</label>
        <input value="<?=set_value('title', $media->title)?>" name="title"  type="text" class="form-control" id="inputTitle" aria-describedby="inputTitle" placeholder="Título">
    </div>

    <input type="hidden" name="id" value="<?=$media->id?>">
    <input type="hidden" name="path" value="<?=$media->path?>">
    <input type="hidden" name="file" value="<?=$media->file?>">

    <div class="form-row">
      <div class="col-6">
        <label for="inputName">Imagem de apresentação</label>
        <input class="form-control" type="file" name="upload" />
      </div>
    </div>
    
    <div class="form-row">
        <div class="col">
        <label for="inputName">Observação:</label>
        <textarea name="note" id="note" class="form-control"><?=set_value('note', $media->note)?></textarea>
        </div>
    </div>

    <span class="help-block"></span>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="<?=base_url('admin/media/manage')?>" class="btn btn-light">Voltar</a>
    <span class="help-block"></span>
    <p id="mensagem"></p>

  </fieldset>
</form>