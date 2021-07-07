<form focus-response="#mensagem" id="form" method="post" enctype="multipart/form-data">
    <fieldset> <legend>Editar Produto</legend>

    <?php  echo get_erros_validation(); ?>

    <?php echo get_msg('msgErro') ?>
    <?php echo get_msg('msgOk') ?>
    <?php $additional_files = json_decode($product->additional_files) ?>
  
<?php echo set_value('quantity', null); ?>
    <div class="form-row">
        <div class="col-6">     
            <label for="inputName">* Nome:</label>
            <input  id="name" name="name" type="text" class="form-control" value="<?=set_value('name', $product->name)?>" >
        </div>
        <div class="col-6">     
            <label for="inputName">Slug:</label>
            <input  id="slug" name="slug" type="text" class="form-control" value="<?=set_value('slug', $product->slug)?>" >
        </div>     
    </div>

    <div class="form-row">
        <div class="col-12">     
          <label for="inputName">* Título:</label>
          <input  id="title" name="title" type="text" class="form-control" value="<?=set_value('title', $product->title)?>" >
          </div>
      </div>

    <div class="form-row">
      <div class="col-6">
            <label for="brands">* Marcas:</label>       
            <select name="brand" id="brand" class="form-control">
              <option value="">-- selecione --</option>
              <?php foreach ($brands as $v): ?>
                <option 
                  <?=($v->id == set_value('brand', $product->brand_id)) ? 'selected' : '' ?>
                  value="<?=$v->id?>"
                >
                  <?=$v->name?>
                </option>
              <?php endforeach ?> 
          </select>
        </div>
    </div>

    <div class="form-row">       
        <?php foreach ($brands as $brand): ?>
          <div class="hidden" id="category_list_<?=$brand->id?>">
            <div class="col-12">
              <label>* Categorias:</label>     
            </div>
            <div class="col-12">           
                <?php $categories_post = ($this->input->post('categories')) ? $this->input->post('categories') : []; ?>
                <?php foreach ($brand->categories as $category): ?>
                  <label><input require <?=(in_array($category->id, $categories_post) || in_array($category->id, $product->categories) ) ? 'checked' : '' ?>  value="<?=$category->id?>" type="checkbox" name="categories[]"><?=$category->name?></label>            
                <?php endforeach ?>            
            </div>
          </div>
        <?php endforeach ?>   
    </div>    
    
    <input name="file" type="hidden" value="<?=$product->file?>">

    <div class="form-row">
        <div class="col-6">
          <label for="inputName">Imagem:</label>
          <input class="form-control" type="file" name="upload" />
        </div>
        <?php if ($product->file != '') : ?>
        <div class="col-6 text-right">
          <?php $img = $this->image_handler->thumb('./assets/img/products/', $product->file, 150, 100, FALSE) ?> 
          <div class="product-tumb"> 
            <img class="rounded float-right" src="<?=$img?>" alt="<?=$product->name?>"title="<?=$product->name?>"> 
          </div>
        </div>
        <?php endif ?>
    </div>

  <div class="form-row">
    <div class="col">
      <label for="inputName">Descrição do produto</label>
      <textarea rows="80" cols="90" id="ckeditor" class="form-control" name="description"><?=set_value('description', $product->description)?></textarea>
    <div class="col">
  </div>
  
  <?php /*
  <div class="form-row mt-5 mb-5">   
    <div class="col-12">      
      <label for="images">Imagens adicionais:</label><br>
      <input  type="file" name="files" data-jfiler-uploadUrl="<?=site_url().'admin/products/upload-files-adicionais/' . $product->id ?>" id="files_input_carouse" >
    </div>
    <div class="col-12"><small class=""><strong>*Recomendação de tamanho da imagem: 500x500</strong></small></div>
  </div>

  <?php if (  count($additional_files)> 0): ?>
    <fieldset> <legend>Imagens</legend>
      <div class="jFiler-items jFiler-row">
        <ul class="jFiler-items-list jFiler-items-grid">
          <?php foreach ($additional_files as $v): ?>
            <li class="jFiler-item" data-jfiler-index="0" style="">                       
              <div class="jFiler-item-container">                            
                <div class="jFiler-item-inner">                                
                  <div class="jFiler-item-thumb">                                    
                    <div class="jFiler-item-status"></div>                                    
                    <div class="jFiler-item-info">                                        
                      <span class="jFiler-item-title"><b id="titulo_<?=$v?>" title="<?=$v?>"></b></span>                      
                    </div>                                    
                    <div class="jFiler-item-thumb-image">
                      <img src="<?=base_url('assets/img/products/' . $v)?>" alt="<?= $v?>">
                    </div>                                    
                    <input type="text" class="logo-gradiente-3.png">                                
                  </div>                                
                  <div class="jFiler-item-assets jFiler-row"> 
                    <ul class="list-inline pull-right">                                        
                      <li>
                        <a style="padding-left: 16px;" title="Excluir" class="btn btn-mini btn-danger icon-jfi-trash jFiler-item-trash-action" href="amdin/products/delete-file-adicionais/<?=$product->id; ?>/<?=$v; ?>" onclick="javascript:if(!confirm('Deseja realmente excluir esse arquivo? Ao excluir não será mais exibido no site.')){return false;}"></a>
                      </li>                                    
                    </ul>                                
                  </div>                            
                </div>                        
              </div>                    
            </li>
        <?php endforeach ?>
        </ul>
      </div>
    </fieldset>
  <?php endif ?>

  */ ?>

  <fieldset class="destaque-seo">
      <label>SEO</label>
      <div class="form-row">
          <div class="col">
          <label for="inputName">Breve descrição.</label>
          <textarea  class="form-control" name="resume"><?=set_value('resume', $product->resume)?></textarea>
          <span>Será utilizada na meta tag description da página</span>
          </div>
      </div>

      <div class="form-row">
          <div class="col-6">     
              <label for="inputName">Palavras Chaves:</label>
              <input  id="keywords" name="keywords" type="text" class="form-control" value="<?=set_value('keywords', $product->keywords)?>" >
              <span>Separe-as por vírgulas</span>
          </div>
      </div>
    </fieldset>

  <input name="id" type="hidden" value="<?=$product->id?>">

  <div class="form-row form-footer">
    <div class="col">
      <span class="help-block"></span>
      <button type="submit" class="btn btn-success">Salvar</button>
      <a href="<?=base_url('admin/products/manage')?>" class="btn btn-light">Voltar</a>
      <span class="help-block"></span>
      <div id="mensagem"></div>
      
    <div class="col">
  </div>

  </fieldset>
</form>

<script>
  $('.hidden').hide()
  let id = $( "#brand" ).val()
  if (id != '') {
    $('#category_list_' + id).show();
  }

  $( "#brand" ).change(function() {
    /* LIMPA CHECKBOX */
    var checkboxs = $('#category_list_1').parent().find('input[type=checkbox]');    
    checkboxs.each(function () { $(this).attr('checked', false)})
    /* LIMPA CHECKBOX */
    
    $('.hidden').hide()
    let id = $(this).val();
    $('#category_list_' + id).show();
  });
</script>

<script src="assets/lib/upload/js/custom_upload_carousel_pages.js"></script>
<script src="assets/lib/upload/js/custom_upload_image_pages.js"></script>