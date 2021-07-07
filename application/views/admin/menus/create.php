<form data-remote="true" focus-response="#mensagem" id="form" method="post" action="AD_Menus_controller/insert">
  <fieldset><legend>Cadastrar novo Menu</legend>

    <div class="form-row">
      <div class="col-6">
        <label for="inputName">Nome:</label>
        <input name="name"  type="text" class="form-control" id="inputName" aria-describedby="inputName" placeholder="Nome do Menu">
      </div>
      <div class="col-6">
        <label for="inputName">Slug:</label>
        <input  id="slug" name="slug" type="text" class="form-control" value="<?=$this->input->post('slug')?>" >
      </div>
    </div>    

    <div class="form-row">
      <div class="col-6 ">
        <label for="menu_type">Tipo de Menu</label>
        <select class="form-control" name="menu_type" id="menu_type">
          <option value="page">Página interna</option>
          <option value="url">URL externa</option>
        </select>
      </div>

      <div class="col-6 page_id">
          <label for="page_id">Página:</label>
          <select name="page_id" id="page_id" class="form-control">
              <option value="">-- selecione --</option>
              <?php foreach ($pages as $page) :  ?>
                <option <?=set_value('page_id') == $page->id ? "selected" : "" ?> value="<?=$page->id?>"><?=$page->title?></option>
              <?php endforeach ?>
          </select>          
      </div>      

      <div class="col-6  d-none url_ext">
        <label for="url">Url:</label>
        <input  id="url" name="url" type="text" class="form-control" value="<?=$this->input->post('url')?>" >
      </div>      
    </div>

    <div class="form-row">
      <div class="col-6">
          <label for="menu_pai">Menu Pai:</label>
          <select name="menu_id" id="menu_id" class="form-control">
              <option value="">-- selecione --</option>
              <?php foreach ($menus as $menu) :  ?>
                <option <?=set_value('menu_id') == $menu->id ? "selected" : "" ?> value="<?=$menu->id?>"><?=$menu->name?></option>
              <?php endforeach ?>
          </select>
      </div>

      <div class="col-2">
            <label for="inputName">Ordem:</label>
            <input  id="ordem" name="ordem" type="number" class="form-control" value="<?=$this->input->post('ordem')?>" >
          </div>
    </div>



    <span class="help-block"></span>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
    <span class="help-block"></span>
    <p id="mensagem"></p>

  </fieldset>
</form>

<script>
$("#menu_type").on("change", function(){
  var menu_type = $(this).val();

  var types = {
    'page' : function(){ 
      $('.page_id').removeClass('d-none');
      $('.url_ext').addClass('d-none');
    },
    'url' : function(){ 
      $('.url_ext').removeClass('d-none');
      $('.page_id').addClass('d-none');
    }
  }

  types[menu_type]();

})
</script>