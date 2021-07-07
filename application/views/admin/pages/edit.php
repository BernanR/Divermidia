<form focus-response="#mensagem" id="form" method="post" enctype="multipart/form-data">
    <fieldset> <legend>Editar página</legend>    

    <?php  echo get_erros_validation(); ?>

    <?php echo get_msg('msgErro') ?>
    <?php echo get_msg('msgOk') ?>
    <?php $files = json_decode($_page->files) ?>

    <div class="form-row">
        <div class="col-6">     
            <label for="inputName">* Título:</label>
            <input  id="title" name="title" type="text" class="form-control" value="<?=set_value('title', $_page->title)?>" >
        </div>
        <div class="col-6">     
            <label for="inputName">Slug:</label>
            <input  id="slug" name="slug" type="text" class="form-control" value="<?=set_value('slug', $_page->slug)?>" >
        </div>
    </div>
    
    <div class="form-row">
      <div class="col-6">
          <label for="page_category">* Menu:</label>
          <select name="menu_id" id="menu_id" class="form-control">
              <option value="">-- selecione --</option>
              <?php foreach ($menus as $menu) :  ?>
                <option <?=set_value('menu_id', $menu_id) == $menu->id ? "selected" : "" ?> value="<?=$menu->id?>"><?=$menu->name?></option>
              <?php endforeach ?>
          </select>
          </div>
    </div>

    <div class="form-row">
        <div class="col">
        <label for="inputName">Breve descrição*</label>
        <textarea  class="form-control" name="resume"><?=set_value('resume', $_page->resume)?></textarea>
        </div>
    </div>

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
  
  <div class="form-row">
    <div class="col">
      <label for="inputName">Conteúdo</label>
      <textarea rows="80" cols="90" id="ckeditor" class="form-control" name="content"><?=set_value('content', $_page->content)?></textarea>
    <div class="col">
  </div>

  <div class="form-row">
    <div class="col-6">
    <label for="inputName">Banner Desktop: <strong>(1800x360)</strong></label>
      <input class="form-control" type="file" name="upload_desktop_banner" />
    </div>

    <?php if ($_page->banners->desktop):  ?>
      <div class="col-6" style="padding-top: 17px;text-align: center;">
        <img style="height:50px;" src="<?=base_url('assets/img/banners/' . $_page->banners->desktop)?>" alt="Banner">
      </div>
    <?php endif ?>
  </div>


  <div class="form-row">
    <div class="col-6">
    <label for="inputName">Banner Mobile: <strong>(1200x500)</strong></label>
      <input class="form-control" type="file" name="upload_mobile_banner" />
    </div>

    <?php if ($_page->banners->mobile):  ?>
      <div class="col-6" style="padding-top: 17px;text-align: center;">
        <img style="height:50px;" src="<?=base_url('assets/img/banners/' . $_page->banners->mobile)?>" alt="Banner">
      </div>
    <?php endif ?>
  </div>

  <div class="form-row mt-5 mb-5">
    <div class="col-5"> 
      <label for="gallery_id">Galeria</label>
        <select name="gallery_id" id="gallery_id" class="form-control">
          <option value="">-- selecione --</option>
          <?php foreach ($galleries as $gallery) :  ?>
            <option <?=set_value('menu_id', $_page->gallery_id) == $gallery->id ? "selected" : "" ?> value="<?=$gallery->id?>"><?=$gallery->title?></option>
          <?php endforeach ?>
      </select>
    </div>  

    <div class="col-5"> 
      <label for="display_brands">Exibir Marcas</label>
      <input type="checkbox" name="display_brands" id="display_brands" value="1" <?=set_value('display_brands', $_page->display_brands) ? 'checked': '' ?>>
    </div>  
  </div> 

  
  <fieldset class="destaque-seo">
      <label>SEO</label>
      <div class="form-row">
          <div class="col-6">     
              <label for="inputName">Palavras Chaves:</label>
              <input  id="keywords" name="keywords" type="text" class="form-control" value="<?=set_value('keywords', $_page->keywords)?>" >
              <span>Separe-as por vírgulas</span>
          </div>
      </div>
    </fieldset>

  <div class="form-row form-footer">
    <div class="col">
      <span class="help-block"></span>
      <button type="submit" class="btn btn-success">Salvar</button>
      <a href="<?=base_url('admin/pages/manage')?>" class="btn btn-light">Voltar</a>
      <span class="help-block"></span>
      <div id="mensagem"></div>
      </div>


</form>


<script src="assets/lib/upload/js/custom_upload_image_pages.js?v=1"></script>