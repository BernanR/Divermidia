<style>
  .gallery-form label{
    font-size:12px;
  }
</style>
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

    <div class="form-row">
      <div class="col-12">      
        <label for="images">Imagens:</label><br>
        <span><strong>* Importante</strong> faça upload apenas das imagens que for utilizar no conteúdo da página.</span>
        <input  type="file" name="files" data-jfiler-uploadUrl="<?=site_url().'admin/pages/upload-files'?>" id="files_input" >
    </div>
  </div>

    <?php media_load() ?>

    <div class="form-row">
        <div class="col-6">
            <span id="media_btn" class="btn btn-primary">Mídias</span>
        </div>
    </div>

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
      <?php if ( $medias && count($medias) > 0 ):  ?>
        <?php foreach ($medias as $key => $media) :  ?>

        <input type="hidden" name="medias[<?=$key?>][key]" value="<?=$media->key?>">
          <input type="hidden" name="medias[<?=$key?>][type]" value="<?=$media->type?>">

          <li class="list-group-item d-flex justify-content-between align-items-center" id="li_<?=$key?>">
            <div class="row">
            <?php if ( $media->type == "video" ):  ?>
                <div class="col-1">
                    <iframe style="width: 109%;height: 90px;" id="main_iframe" src="https://www.youtube.com/embed/<?=$media->url?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>   
            <?php else: ?>
                <div class="col-2 image">
                    <img src="<?=$media->url?>" style="width:100%;">
                </div>   
                <div class="col-2">
                  <label> Link (Saiba mais)</label>
                  <input placeholder="Título" name="medias[<?=$key?>][link_url]" type="text" class="form-control" value="<?= $media->link_url ?>">
                </div> 
            <?php endif ?>

              <div class="col-2">
                <label> URL IMAGE </label>
                <input required placeholder="ID" name="medias[<?=$key?>][url]" type="text" class="form-control input-file-gallry" value="<?= $media->url ?>">
              </div>

              <div class="col-2">
                <label> YOUTUBE ID </label>
                <input placeholder="ID" name="medias[<?=$key?>][youtube_id]" type="text" class="form-control input-file-gallry" value="<?= $media->youtube_id ?>">
              </div>
                       
              <div class="col-3">
                <label> Título</label>
                <input required placeholder="Título" name="medias[<?=$key?>][title]" type="text" class="form-control" value="<?= $media->title ?>">
              </div>

              

              <div class="col-1">
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
      <div class="row gallery-form">
        <div style=\"\" class="col-2 image img-block-only"></div>
        
        <div class="col-2 img-block-only">
          <label> Link (Saiba mais) </label>
          <input placeholder="Link Saiba Mais" name="medias[${counter.value}][link_url]" type="text" class="form-control">
        </div>

        <div class="col-3">
          <label>URL da imagem </label>
          <input required placeholder="ID" name="medias[${counter.value}][url]" type="text" class="form-control input-file-gallry">
        </div>

        <div class="col-2">
          <label>YOUTUBE ID </label>
          <input required placeholder="YOUTUBE ID" name="medias[${counter.value}][youtube_id]" type="text" class="form-control">
        </div>

        <div class="col-3">
          <label> Título </label>
          <input required placeholder="Título" name="medias[${counter.value}][title]" type="text" class="form-control">
        </div>
        <input class=\"type-midia\" type=\"hidden\" value="video" name="medias[${counter.value}][type]" />
       
      </div>
      <a title="Excluir" required class="btn btn-mini btn-danger" onclick="removeSource('li_${counter.value}')"><i style="color:#fff" class="fa fa-trash" aria-hidden="true"></i></a> 
      `, 'ul-append', counter.value)
  }
</script>


<script src="assets/lib/upload/js/custom_upload_image_pages.js?v=1"></script>