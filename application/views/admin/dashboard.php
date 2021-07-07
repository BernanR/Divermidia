<div class="row">
	<div class="col-12">
	    <h1>Strutech</h1>    
	    <h3>Painel de Gerenciamento de conteúdo.</h3>
	    <br>
	    <h4>Seja bem vindo(a): <?= user_logged('nome') ?></h4>
	    <p>Área exclusiva para o gerenciamento e cadastros de páginas para o site <b> Righi & Righi. </b> </p>
	   <br/>
	    <ul class="list-group">    	
	    	<li class="list-group-item">
	    		Cadastrar um novo<a href="<?=base_url('admin/menus/create')?>" > Menu</a>
	    	</li>
	    	<li class="list-group-item">
	    		Cadastrar uma nova <a href="<?=base_url('admin/pages/create')?>" > Página</a>
	    	</li>
	    	<li class="list-group-item">
	    		Alterar <a href="<?=base_url('admin/settings/manage')?>" >Dados e configurações gerais</a>
	    	</li>
	    </ul>
    <!-- <p><a href="" class="btn btn-primary btn-large">Saiba mais &raquo;</a></p> -->
	</div>
</div>