<legend>Gerenciar Galerias do site</legend>
<!-- Form Busca -->

<div class="row"> 
    <div class="col-10">
        <form class="form-search form-inline" method="get" action="admin/gallery/manage">
            <div class="form-group mr-3 mb-2">
                <input type="text" name="title" class="form-control" placeholder="Buscar" value="<?=$this->input->get('key')?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary mb-2">Buscar</button>            
                <?php if ($this->input->get('title')) : ?>
                    <a class="btn link mb-2 f-right" href="<?=current_url()?>">Limpar</i></a> 
                <?php endif ?>
            </div>
        </form>
    </div>
    <div class="col-2">
        <a class="btn btn-success mb-2 f-right" href="<?=base_url('admin/gallery/create')?>" title="Novo"><i class="fa fa-plus" style="font-size:19px"></i></a>
    </div>
</div>
<div class="row msgOk"> 
    <?php echo get_msg("msgOk"); ?>
</div>

<div class="row"> 
    <div class="col-12">
        <?php if (count($galleries) > 0) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Descrição</th>
                        <th>Data de Alteração</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <?php foreach ($galleries as $gallery): ?>
                    <tr title="<?=$gallery->title;?>" >
                        <th><?= $gallery->id; ?></th>
                        <td><?= $gallery->title; ?></td>
                        <td><?= $gallery->type == 1 ? 'Imagens' : 'Vídeos' ?></td>
                        <td><?= $gallery->description ?></td>
                        <td><?= formata_data($gallery->updated_dt,2) ?></td>
                        <td>
                            <?php 
                                $disabled = false;
                                if($gallery->id == 5) {
                                    $disabled = true;
                                }
                            ?>
                            <!-- <a class="btn btn-mini btn-light" title="Ver" target="_blank" href="<?= base_url("/assets/img/banners/"); ?>"><i class="fa fa-eye"></i></a> -->
                            <a class="btn btn-mini btn-primary" title="Editar" href="admin/gallery/edit/<?= $gallery->id; ?>"><i class="fa fa-pencil"></i></a>  
                            <?php if ($disabled):  ?>
                                <button disabled class="btn btn-mini btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            <?php else : ?>
                                <a title="Excluir" class="btn btn-mini btn-danger" href="admin/gallery/delete/<?= $gallery->id; ?>" onclick="javascript:if(!confirm('Deseja realmente excluir esta Galeria? Ao excluir não será mais exibido no sistema.')){return false;}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>Nenhuma Galeria cadastrada</p>
        <?php endif ?>
    </div>
</div>
<?= $paginacao; ?>