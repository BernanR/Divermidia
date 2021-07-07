<form focus-response="#mensagem" id="form" method="post" enctype="multipart/form-data">
    <fieldset> <legend>Cadastrar Produto</legend>

    <?php  echo get_erros_validation(); ?>

    <?php echo get_msg('msgErro') ?>
    <?php echo get_msg('msgOk') ?>
  

    <div class="form-row">
        <div class="col-6">     
            <label for="inputName">* Nome:</label>
            <input  id="name" name="name" type="text" class="form-control" value="<?=$this->input->post('name')?>" >
        </div>
        <div class="col-6">     
            <label for="inputName">Slug:</label>
            <input  id="slug" name="slug" type="text" class="form-control" value="<?=$this->input->post('slug')?>" >
        </div>
    </div>

    <div class="form-row">
        <div class="col-12">     
            <label for="inputName">* Título:</label>
            <input  id="title" name="title" type="text" class="form-control" value="<?=$this->input->post('title')?>" >
        </div>
    </div>


    <div class="form-row">
      <div class="col-6">
            <label for="brands">* Marcas:</label>       
            <select name="brand" id="brand" class="form-control">
              <option value="">-- selecione --</option>
              <?php foreach ($brands as $v): ?>
                <option 
                  <?=($v->id == $this->input->post('brand')) ? 'selected' : '' ?>
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
                  <label><input require <?=(in_array($category->id, $categories_post)) ? 'checked' : '' ?>  value="<?=$category->id?>" type="checkbox" name="categories[]"><?=$category->name?></label>            
                <?php endforeach ?>            
            </div>
          </div>
        <?php endforeach ?>   
    </div>

    <div class="form-row">
        <div class="col-6">
        <label for="inputName">Imagem:</label>
        <input class="form-control" type="file" name="upload" />
        </div>
    </div>

  <div class="form-row">
    <div class="col">
      <label for="inputName">Descrição do produto</label>
      <textarea rows="80" cols="90" id="ckeditor" class="form-control" name="description"><?=$this->input->post('description')?></textarea>
    <div class="col">
  </div>

  <fieldset class="destaque-seo">
      <label>SEO</label>
      <div class="form-row">
          <div class="col">
          <label for="inputName">Breve descrição.</label>
          <textarea  class="form-control" name="resume"><?=$this->input->post('resume')?></textarea>
          <span>Será utilizada na meta tag description da página</span>
          </div>
      </div>

      <div class="form-row">
          <div class="col-12">     
              <label for="inputName">Palavras Chaves:</label>
              <input  id="keywords" name="keywords" type="text" class="form-control" value="<?=$this->input->post('keywords')?>" >
              <span>Separe-as por vírgulas</span>
          </div>
      </div>
    </fieldset>

  <div class="form-row form-footer">
    <div class="col">
      <span class="help-block"></span>
      <button type="submit" class="btn btn-primary">Cadastrar</button>
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