<legend>Gerenciar Configurações do site</legend>
<!-- Form Busca -->
<div class="row"> 
    <div class="col-10">
        <form class="form-search form-inline" method="get" action="admin/settings/manage">
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
    <div class="col-2">
        <a class="btn btn-success mb-2 f-right" href="<?=base_url('admin/settings/create')?>" title="Novo"><i class="fa fa-plus" style="font-size:19px"></i></a>
    </div>
</div>

<div class="row"> 
    <?= get_msg("msgOk"); ?>
</div>
<div class="row"> 
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Key</th>
                    <th>Observação</th>
                    <th>Valor</th>
                    <th>Data de Alteração</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <?php foreach ($settings as $setting): ?>
                <tr title="<?=$setting->note;?>" >
                    <th><?= $setting->id; ?></th>
                    <td><?= $setting->key; ?></td>
                    <td><?=$setting->note?></td>
                    <td><?= resumo($setting->value, 5); ?></td>
                    <td><?= formata_data($setting->updated_dt,2) ?></td>
                    <td>                        
                        <a class="btn btn-mini btn-primary" title="Editar" href="admin/settings/edit/<?= $setting->id; ?>"><i class="fa fa-pencil"></i></a>
                        <!-- <a title="Excluir" class="btn btn-mini btn-danger" href="admin/settings/delete/<?= $setting->id; ?>" onclick="javascript:if(!confirm('Deseja realmente excluir os dados desta configuração? Ao excluir não será mais exibido no sistema.')){return false;}"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?= $paginacao; ?>