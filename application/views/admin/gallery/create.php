<form focus-response="#mensagem" id="form" action="" method="post" enctype="multipart/form-data">
  <fieldset><legend>Nova Galeria</legend>

    <div class="row msgOk">     
      <?php echo get_msg("msgOk"); ?>
    </div>
    <div class="row"> 
      <div class="col">
        <?php echo get_msg("msgErro"); ?>
      </div>
    </div>

    <div class="form-row">
      <div class="col">
        <label for="inputName">Título:</label>
        <input name="title" type="text" class="form-control" id="inputTitle" aria-describedby="inputTitle" placeholder="Título">
      </div>
      <div class="col">
        <label for="type">Tipo: <small>Não será possível alterá-lo</small> </label>
        <select class="form-control" name="type" id="type">
          <option value="1">Imagens</option>
          <option value="2">Vídeos</option>
        </select>
      </div>
    </div>

    <div class="form-row" >
			<div class="col">
				<label >
					<input type="checkbox" value="1" name="carousel" <?= (set_value('carousel')) ? 'checked' : '' ?>> carrousel
				</label>
			</div>

			<div class="col">
			<label >
				<input type="checkbox" value="1" name="lightbox" <?= (set_value('lightbox')) ? 'checked' : '' ?>> Lightbox 
				</label>
			</div>
		</div>


    <div class="form-row">
      <div class="col">
          <label for="inputName">Breve descrição:</label>
          <textarea class="form-control" name="description"></textarea>
      </div>
    </div>

    <span class="help-block"></span>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
    <a href="<?=base_url('admin/media/manage')?>" class="btn btn-light">Voltar</a>
    <span class="help-block"></span>
    <p id="mensagem"></p>

  </fieldset>
</form>

