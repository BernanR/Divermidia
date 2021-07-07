<form data-remote="true" focus-response="#mensagem" id="form" method="post" action="AD_Brand_controller/insert">
  <fieldset><legend>Cadastrar uma nova marca</legend>

    <div class="form-group">
        <label for="inputName">Nome:</label>
        <input name="name"  type="text" class="form-control" id="inputName" aria-describedby="inputName" placeholder="Nome da Marca">
    </div>

    <div class="form-row">
      <div class="col-12"> 
        <label for="inputName">Categoria:</label>
      </div>
      <div class="col-10">          
            <?php $categories_post = ($this->input->post('categories')) ? $this->input->post('categories') : []; ?>
            <?php foreach ($categories as $v): ?>
              <label><input require <?=(in_array($v->id, $categories_post)) ? 'checked' : '' ?>  value="<?=$v->id?>" type="checkbox" name="categories[]"><?=$v->name?></label>            
            <?php endforeach ?>           
      </div>
      <div class="col-2">
        <a class="btn btn-success mb-2 f-right" href="<?=base_url('admin/categories/create')?>" title="Cadatrar nova categoria"><i class="fa fa-plus" style="font-size:19px"></i></a>
      </div>
    </div>

    <div class="form-row">
      <div class="col">
          <label for="inputName">Breve descrição:</label>
          <textarea class="form-control" name="description"><?=$this->input->post('description')?></textarea>
      </div>
    </div>

    <fieldset>Banners</fieldset>
    <select disabled class="form-control w-50 mt-3 mb-4" onchange="setBannerType(this)" name="banners_select_type" id="banners_select_type">
      <option value="desktop" selected >Desktop</option>
      <option value="mobile">Mobile</option>
    </select>
    
    <div class="form-row" id="desktop_banners">
      <div class="col-6">
        <input class="form-control" accept="image/*" type="file" name="upload_desktop" />
      </div>
    </div>

    <div class="form-row" hidden id="mobile_banners">
      <div class="col-6">
        <input class="form-control" accept="image/*" type="file" name="upload_mobile" />
      </div>
    </div>

    <span class="help-block"></span>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
    <span class="help-block"></span>
    <p id="mensagem"></p>

  </fieldset>
</form>