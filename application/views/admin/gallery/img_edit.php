<form focus-response="#mensagem" id="form" method="post" enctype="multipart/form-data">
	<fieldset>
		<legend>Editar Galeria de imagens</legend>
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
			<input disabled value="<?= set_value('title', $gallery->type) ?>" type="text" class="form-control" id="inputTitle" aria-describedby="inputTitle" placeholder="Tipo">
		</div>
		<div class="form-group">
			<label for="inputName">Título:</label>
			<input value="<?= set_value('title', $gallery->title) ?>" name="title" type="text" class="form-control" id="inputTitle" aria-describedby="inputTitle" placeholder="Título">
		</div>

		<div class="form-row">
			<div class="col">
				<label for="inputName">Descrição:</label>
				<textarea name="note" id="note" class="form-control"><?= set_value('note', $gallery->description) ?></textarea>
			</div>
		</div>
		<div class="form-row" >
			<div class="col">
				<label >
					<input type="checkbox" value="1" name="carousel" <?= (set_value('carousel', $gallery->carousel)) ? 'checked' : '' ?>> carrousel
				</label>
			</div>

			<div class="col">
			<label >
				<input type="checkbox" value="1" name="lightbox" <?= (set_value('lightbox', $gallery->lightbox)) ? 'checked' : '' ?>> Lightbox 
				</label>
			</div>
		</div>

		<?php if (count($medias)> 0): ?>
			<fieldset>Mídias:</fieldset>
			<ul class="list-group">
				<?php foreach ($medias as $v): ?>
					<li class="list-group-item d-flex justify-content-between align-items-center">
						<div class="row align-items-center">
							<div class="col">
								<?=$this->image_handler->thumb('./assets/img/gallery/', $v->file)?>
							</div>
							<div class="col">
								<label>Título</label>
								<input class="form-control" type="text" name="medias[<?=explode(".", $v->file)[0]?>][title]" value="<?=$v->title?>">
							</div>
							<div class="col">
								<label>Ordem</label>
								<input class="form-control" style="width:50%;" type="number" name="medias[<?=explode(".", $v->file)[0]?>][ordem]" value="<?=(isset($v->ordem)) ? $v->ordem : ''?>">
							</div>
							<div class="col">
								<a title="Excluir" class="btn btn-mini btn-danger" href="admin/gallery/delete-file-carousel/<?= $gallery->id . '/' . $v->file?>" onclick="javascript:if(!confirm('Deseja realmente excluir esta Mídia? Ao excluir não será mais exibida no sistema.')){return false;}"><i class="fa fa-trash" aria-hidden="true"></i></a>
							</div>
						</div>
					</li>
				<?php endforeach ?>
			</ul>
			<!-- <fieldset> <legend>Imagens</legend>
			<div class="jFiler-items jFiler-row">
				<ul class="jFiler-items-list jFiler-items-grid">
				<?php foreach ($medias as $v): ?>
					<li class="jFiler-item" data-jfiler-index="0">                       
					<div class="jFiler-item-container">                            
						<div class="jFiler-item-inner">                                
							<div class="jFiler-item-thumb">                                    
								<div class="jFiler-item-status"></div>                                    
								<div class="jFiler-item-info">
								<span class="jFiler-item-title"><b id="titulo_<?=$v->file?>" title="<?=$v->file?>"></b></span>                      
								</div>                                    
								<div class="jFiler-item-thumb-image">
								<img src="<?=base_url('assets/img/gallery/' . $v->file)?>" alt="<?= $v->file?>">
								</div>                                    
								<input type="text" class="logo-gradiente-3.png">                                
							</div>                                
							<div class="jFiler-item-assets jFiler-row"> 
								<ul class="list-inline pull-right">                                        
								<li>
									<input class="form-control" type="text" name="medias[<?=explode(".", $v->file)[0]?>][title]" value="<?=$v->title?>">

									<input class="form-control" style="width:50%;" type="number" name="medias[<?=explode(".", $v->file)[0]?>][ordem]" value="<?=(isset($v->ordem)) ? $v->ordem : ''?>">

									<a style="padding-left: 16px;" title="Excluir" class="btn btn-mini btn-danger icon-jfi-trash jFiler-item-trash-action" href="admin/gallery/delete-file-carousel/<?=$gallery->id; ?>/<?=$v->file; ?>" onclick="javascript:if(!confirm('Deseja realmente excluir esse arquivo? Ao excluir não será mais exibido no site.')){return false;}"></a>
								</li>                                    
								</ul>                                
							</div>
						</div>
					</li>
				<?php endforeach ?>
				</ul>
			</div> -->
		<?php endif ?>
		
		<input type="hidden" name="id" value="<?= $gallery->id ?>">
		<input type="hidden" type="text" name="json" value="<?= $gallery->json ?>">
		<input type="hidden" type="text" name="type" value="<?= $gallery->type ?>">

		<div class="form-row">
			<div class="col-12">      
				<label for="images">Upload:</label><br>
				<?php if ( $gallery->id == 1 ):  ?>
					<span><strong>* Importante</strong> A recomendação da dimensão de imagens das logomarcas é de <strong>200x200</strong>.</span>
				<?php endif ?>
				
				<input  type="file" name="files" data-jfiler-uploadUrl="<?=site_url().'admin/gallery/upload-image/' . $gallery->id ?>" id="files_input" >
			</div>
		</div>

		<div class="mt-3">
			<span class="help-block"></span>
			<button type="submit" class="btn btn-success">Salvar</button>
			<a href="<?= base_url('admin/gallery/manage') ?>" class="btn btn-light">Voltar</a>
			<span class="help-block"></span>
			<p id="mensagem"></p>
		</div>

	</fieldset>
</form>


<script src="assets/lib/upload/js/custom_upload_image_pages.js"></script>
