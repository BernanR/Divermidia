<legend>Gerenciar Páginas</legend>
<!-- Form Busca -->

<div class="row"> 
    <div class="col-10">
        <form class="form-search form-inline" method="get" action="admin/pages/manage">
            <div class="form-group mr-3 mb-2">
                <input type="text" name="title" class="form-control" placeholder="Buscar" value="<?=$this->input->get('title')?>">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary mb-2">Buscar</button>            
                <?php if ($this->input->get()) : ?>
                    <a class="btn link mb-2 f-right" href="<?=current_url()?>">Limpar</i></a> 
                <?php endif ?>                         
            </div>

        </form>
    </div>
    <div class="col-2">
        <a class="btn btn-success mb-2 f-right" href="<?=base_url('admin/pages/create')?>" title="Novo"><i class="fa fa-plus" style="font-size:19px"></i></a>
    </div>
</div>
<div class="row msgOk"> 
    <?php echo get_msg("msgOk"); ?>
</div>
<div class="row"> 
    <div class="col-12">
        <?php if (count($pages) > 0) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Data de Alteração</th>
                        <th>Ação</th>
                    </tr>
                </thead>                

                <?php foreach ($pages as $page): ?>
                    <?php if ($page->id != 8): ?>
                    <tr>
                        <td><?= $page->title; ?></td>
                        <td><?= $page->slug; ?></td>
                        <td><?= formata_data($page->updated_dt,2) ?></td>
                        <td style="width:185px;">    
                            <a class="btn btn-mini btn-light" title="Ver" target="_blank" href="<?= base_url("{$page->slug}") ?>"><i class="fa fa-eye"></i></a>                    
                            <a class="btn btn-mini btn-primary" title="Editar" href="admin/pages/edit/<?= $page->id; ?>"><i class="fa fa-pencil"></i></a>
                            <?php if ( $page->id ==4 ):  ?>
                                <a title="Excluir" class="btn btn-mini btn-danger disabled" href="javascrip:void(0)" onclick="javascript:if(!confirm('Deseja realmente excluir esta página? Ao excluir não será mais exibido no sistema.')){return false;}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <?php else: ?>
                                <a title="Excluir" class="btn btn-mini btn-danger" href="admin/pages/delete/<?= $page->id; ?>" onclick="javascript:if(!confirm('Deseja realmente excluir esta página? Ao excluir não será mais exibido no sistema.')){return false;}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <?php endif ?>
                        </td>
                    </tr>
                    <?php endif ?>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>Nenhuma Página cadastrada</p>
        <?php endif ?>
    </div>
</div>

<?= $paginacao; ?>