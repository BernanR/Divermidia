<legend>Gerenciar Menus</legend>
<!-- Form Busca -->

<div class="row"> 
    <div class="col-10">
        <form class="form-search form-inline" method="get" action="admin/menus/manage">
            <div class="form-group mr-3 mb-2">
                <input type="text" name="name" class="form-control" placeholder="Buscar" value="<?=$this->input->get('name')?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary mb-2">Buscar</button>            
                <?php if ($this->input->get('name')) : ?>
                    <a class="btn link mb-2 f-right" href="<?=current_url()?>">Limpar</i></a> 
                <?php endif ?>                         
            </div>
        </form>
    </div>
    <div class="col-2">
        <a class="btn btn-success mb-2 f-right" href="<?=base_url('admin/menus/create')?>" title="Cadatrar novo menu"><i class="fa fa-plus" style="font-size:19px"></i></a>
    </div>
</div>
<div class="row msgOk"> 
    <?php echo get_msg("msgOk"); ?>
</div>
<div class="row"> 
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ordem</th>
                    <th>Nome</th>
                    <th>Slug</th>
                    <th>Menu Pai</th>
                    <th>Data de Alteração</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <?php foreach ($menus as $menu): ?>
                <tr>
                    <th><?= $menu->id; ?></th>
                    <th><?= $menu->ordem; ?></th>
                    <td><?= $menu->name; ?></td>
                    <td><?= $menu->slug; ?></td>
                    <td><?= $menu->menu_pai; ?></td>
                    <td><?= $menu->updated_dt ?></td>
                    <td>
                        <a class="btn btn-mini btn-primary" title="Editar" href="admin/menus/edit/<?= $menu->id; ?>"><i class="fa fa-pencil"></i></a>

                        <a title="Excluir" class="btn btn-mini btn-danger" href="admin/menus/delete/<?= $menu->id; ?>" onclick="javascript:if(!confirm('Deseja realmente excluir os dados deste menu? Ao excluir não será mais exibido no sistema.')){return false;}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        <?php if ($menu->slug_page != ''):  ?>                    
                            <a class="btn btn-mini btn-light" title="Ver" href="<?= base_url("{$menu->slug_page}") ?>"><i class="fa fa-eye"></i></a>           
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
