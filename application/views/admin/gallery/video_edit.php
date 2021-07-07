<form  focus-response="#mensagem" id="form" method="post" enctype="multipart/form-data">
  <fieldset><legend>Editar Galeria de Vídeo</legend>
    <div class="row msgOk">     
      <?php echo get_msg("msgOk"); ?>
    </div>
    <div class="row"> 
      <div class="col">
        <?php echo get_msg("msgErro"); ?>
      </div>
    </div>
    
    <div class="form-group">
        <label for="inputName">Tipo de Galeria:</label>
        <input disabled value="<?=set_value('title', $gallery->type)?>" type="text" class="form-control" id="inputTitle" aria-describedby="inputTitle" placeholder="Tipo">
    </div>
    <div class="form-group">
        <label for="inputName">Título:</label>
        <input value="<?=set_value('title', $gallery->title)?>" name="title"  type="text" class="form-control" id="inputTitle" aria-describedby="inputTitle" placeholder="Título">
    </div>

    <div class="form-row">
        <div class="col">
        <label for="inputName">Descrição:</label>
        <textarea name="note" id="note" class="form-control"><?=set_value('note', $gallery->description)?></textarea>
        </div>
    </div>    
    
    <input type="hidden" name="id" value="<?=$gallery->id?>">
    <input type="hidden" type="text" name="json" value="<?=$gallery->json?>">
    <input type="hidden" type="text" name="type" value="<?= $gallery->type ?>">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <label>Mídias</label>      
        <a 
          title="Adicionar Vídeo" 
          onclick="setMedia()" 
          class="btn btn-mini btn-success" 
        > 
          <i style="color: #fff;" class="fa fa-plus" aria-hidden="true"></i>
        </a>
    </div>
    <ul id="ul-append" class="list-group">
      <?php if ( $medias and count($medias) > 0 ):  ?>
        <?php foreach ($medias as $key => $media) :  ?>
          <input type="hidden" name="medias[<?=$key?>][key]" value="<?=$media->key?>">
          
          <li class="list-group-item d-flex justify-content-between align-items-center" id="li_<?=$key?>">
            <div class="row">
              <div class="col">
                <iframe id="main_iframe" src="https://www.youtube.com/embed/<?=$media->url?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>            
              <div class="col">
                <label> Título </label>
                <input required placeholder="Título" name="medias[<?=$key?>][title]" type="text" class="form-control" value="<?= $media->title ?>">
              </div>
              <div class="col">
                <label> URL </label>
                <input required placeholder="ID" name="medias[<?=$key?>][url]" type="text" class="form-control" value="<?= $media->url ?>">
              </div>
              <div class="col">
                <label> Ordem </label>
                <input name="medias[<?=$key?>][ordem]" type="text" class="form-control" value="<?= $media->ordem ?>">
              </div>
            </div>
            <a title="Excluir" class="btn btn-mini btn-danger" href="admin/gallery/delete-video/<?= $gallery->id . '/' . $media->key?>" onclick="javascript:if(!confirm('Deseja realmente excluir esta Mídia? Ao excluir não será mais exibida no sistema.')){return false;}"><i class="fa fa-trash" aria-hidden="true"></i></a>
          </li>
        <?php endforeach ?>
      <?php endif ?>
      <input id="counter" value="<?= $counter /*TÁ VINDO DO CONTROLLER!!*/ ?>" type="hidden">
    </ul>

    <div class="mt-3">
      <span class="help-block"></span>
      <button type="submit" class="btn btn-success">Salvar</button>
      <a href="<?=base_url('admin/gallery/manage')?>" class="btn btn-light">Voltar</a>
      <span class="help-block"></span>
      <p id="mensagem"></p>
    </div>

  </fieldset>
</form>
<script>
  function setMedia(){
    let counter = document.getElementById('counter')
    
    counter.setAttribute('value', Number.parseInt(counter.value) + 1)
    addMedia( `
      <div class="row">
        <div class="col">
          <label> Título </label>
          <input required placeholder="Título" name="medias[${counter.value}][title]" type="text" class="form-control">
        </div>
        <div class="col">
          <label> ID </label>
          <input required placeholder="ID" name="medias[${counter.value}][url]" type="text" class="form-control">
        </div>
      </div>
      <a title="Excluir" required class="btn btn-mini btn-danger" onclick="removeSource('li_${counter.value}')"><i style="color:#fff" class="fa fa-trash" aria-hidden="true"></i></a> 
      `, 'ul-append', counter.value)
  }
</script>