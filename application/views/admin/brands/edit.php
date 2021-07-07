<form data-remote="true" focus-response="#mensagem" enctype="multipart/form-data" id="form" method="post" action="AD_Brand_controller/update">
  <fieldset><legend>Editar marca</legend>

  <?php echo get_msg("msgErro"); ?>
    <div class="form-group">
        <label for="inputName">Nome:</label>
        <input value="<?=set_value('name', $brand->name)?>" name="name"  type="text" class="form-control" id="inputName" aria-describedby="inputName" placeholder="Nome da marca">
    </div>

    <div class="form-row">
      <div class="col-12"> 
        <label for="inputName">Categoria:</label>
      </div>
      <div class="col-10">          
            <?php $brand_post = ($this->input->post('brands')) ? $this->input->post('brands') : []; ?>
            <?php foreach ($categories as $v): ?>
            <label><input require <?=(in_array($v->id, $brand_post) || in_array($v->id, $brand->categories)) ? 'checked' : '' ?>  value="<?=$v->id?>" type="checkbox" name="categories[]"><?=$v->name?></label>            
          <?php endforeach ?>              
      </div>

      <div class="col-2">
        <a class="btn btn-success mb-2 f-right" href="<?=base_url('admin/categories/create')?>" title="Cadatrar nova categoria"><i class="fa fa-plus" style="font-size:19px"></i></a>
      </div>
    </div>

    <div class="form-row">
      <div class="col">
          <label for="inputName">Breve descrição:</label>
          <textarea rows="4" class="form-control" name="description"><?=set_value('description', $brand->description)?></textarea>
      </div>
    </div>

    <fieldset>Banners</fieldset>
    <select class="form-control w-50 mt-3 mb-4"" onchange="setBannerType(this)" name="banners_select_type" id="banners_select_type">
      <option value="desktop">Desktop</option>
      <option value="mobile">Mobile</option>
    </select>
    
    <div class="form-row" id="desktop_banners">
      <div class="col-6">
        
        <?php $banner = brand_banner($brand->banner) ?>
        <?php if (isImage($banner)):  ?>
          <div class="jFiler-items jFiler-row">
            <ul class="jFiler-items-list jFiler-items-grid">
              
              <li class="jFiler-item" data-jfiler-index="0" >                       
                <div class="jFiler-item-container">                            
                  <div class="jFiler-item-inner">                                
                    <div class="jFiler-item-thumb">                                    
                      <div class="jFiler-item-status"></div>                                    
                      <div class="jFiler-item-info">                                        
                        <span class="jFiler-item-title"><b  title="<?=$brand->name?>"></b></span>                      
                      </div>                                    
                      <div class="jFiler-item-thumb-image">
                        <img class="img_edit_banner" src="<?=$banner?>" id="banner_change" alt="<?= $brand->name?>">
                      </div>                                    
                      <input type="text" class="logo-gradiente-3.png">                                
                    </div>                                
                  </div>                        
                </div>                    
              </li>
            
            </ul>
          </div>
        <?php endif ?>

        <input onchange="setSource('banner_change', this)" id="banner_input_src" class="form-control" accept="image/*" type="file" name="upload_desktop" />
      </div>
    </div>

    <div class="form-row" hidden id="mobile_banners">
      <div class="col-6">
        <?php $banner_mobile = brand_banner($brand->banner_mobile, true) ?>

        <?php if (isImage($banner_mobile)):  ?>
          <div class="jFiler-items jFiler-row">
            <ul class="jFiler-items-list jFiler-items-grid">
              
              <li class="jFiler-item" data-jfiler-index="0">                       
                <div class="jFiler-item-container">                            
                  <div class="jFiler-item-inner">                                
                    <div class="jFiler-item-thumb">                                    
                      <div class="jFiler-item-status"></div>                                    
                      <div class="jFiler-item-info">                                        
                        <span class="jFiler-item-title"><b  title="<?=$brand->name?>"></b></span>                      
                      </div>                                    
                      <div class="jFiler-item-thumb-image">
                        <img class="img_edit_banner" src="<?=$banner_mobile?>" id="banner_change_mobile" alt="<?= $brand->name?>">
                      </div>                                    
                      <input type="text" class="logo-gradiente-3.png">                                
                    </div>                                
                  </div>                        
                </div>                    
              </li>
            
            </ul>
          </div>
        <?php endif ?>
        
        <input onchange="setSource('banner_change_mobile', this)" class="form-control" accept="image/*" type="file" name="upload_mobile" />
      </div>
    </div>

    <input type="hidden" value="<?=$brand->id?>" name="id">

    <span class="help-block"></span>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="<?=base_url('admin/brands/manage')?>" class="btn btn-light">Voltar</a>
    <span class="help-block"></span>
    <p id="mensagem"></p>

  </fieldset>
</form>