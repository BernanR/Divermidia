<legend>Gerenciar Banners do site</legend>
<!-- Form Busca -->

<div class="row"> 
    <div class="col-10">
        <form class="form-search form-inline" method="get" action="admin/media/manage">
            <div class="form-group mr-3 mb-2">
                <input type="text" name="key" class="form-control" placeholder="Buscar" value="<?=$this->input->get('key')?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary mb-2">Buscar</button>            
                <?php if ($this->input->get('key')) : ?>
                    <a class="btn link mb-2 f-right" href="<?=current_url()?>">Limpar</i></a> 
                <?php endif ?>                      
            </div>
        </form>
    </div>
    <!-- <div class="col-2">
        <a class="btn btn-success mb-2 f-right" href="<?=base_url('admin/media/create')?>" title="Novo"><i class="fa fa-plus" style="font-size:19px"></i></a>
    </div> -->
</div>
<div class="row msgOk"> 
    <?php echo get_msg("msgOk"); ?>
</div>

<div class="row"> 
    <div class="col-12">
        <?php if (count($media) > 0) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Título</th>
                        <th>Imagem</th>
                        <th>Data de Alteração</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <?php foreach ($media as $item): ?>
                    <tr title="<?=$item->title;?>" >
                        <th><?= $item->id; ?></th>
                        <td><?= $item->key; ?></td>
                        <td><?= $item->title; ?></td>
                        <td> <img class="img-media" width="100%" src="<?= base_url($item->path . $item->file) ?>" alt="<?=$item->title?>" title="<?=$item->title?>"> </td>
                        <td><?= formata_data($item->updated_dt,2) ?></td>
                        <td>              
                            <a class="btn btn-mini btn-light" title="Ver" target="_blank" href="<?= base_url("/assets/img/banners/" .  $item->file); ?>"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-mini btn-primary" title="Editar" href="admin/media/edit/<?= $item->id; ?>"><i class="fa fa-pencil"></i></a>
                            <!-- <a title="Excluir" class="btn btn-mini btn-danger" href="categorias/excluir/<?= $item->id; ?>" onclick="javascript:if(!confirm('Deseja realmente excluir os dados desta configuração? Ao excluir não será mais exibido no sistema.')){return false;}"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>Nenhuma mídia cadastrada</p>
        <?php endif ?>
    </div>
</div>
<?= $paginacao; ?>