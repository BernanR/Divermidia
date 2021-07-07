<legend>Gerenciar Produtos</legend>
<!-- Form Busca -->

<div class="row"> 
    <div class="col-10">
        <form class="form-search form-inline" method="get" action="admin/products/manage">
            <div class="form-group mr-3 mb-2">
                <input type="text" name="name" class="form-control" placeholder="Buscar" value="<?=$this->input->get('name')?>">
            </div>

            <div class="form-group mr-3 mb-2">
                <?php $category = ($this->input->get('category_id')) ? $this->input->get('category_id') : []; ?>
                
                <select name="category_id" class="form-control">
                    <option value="" disabled selected="selected">Categoria</option>
                    <?php foreach ($categories as $v): ?>
                        <option <?=($v->id == $category) ? 'selected' : '' ?>  value="<?=$v->id?>"><?=$v->name?></option>            
                    <?php endforeach ?>            
                </select>
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
        <a class="btn btn-success mb-2 f-right" href="<?=base_url('admin/products/create')?>" title="Novo"><i class="fa fa-plus" style="font-size:19px"></i></a>
    </div>
</div>
<div class="row msgOk"> 
    <?php echo get_msg("msgOk"); ?>
</div>

<div class="row"> 
    <div class="col-12">
        <?php if (count($products) > 0) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Marca</th>
                        <th>Categorias</th>
                        <th>Data de Alteração</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <th><?php echo $product->id; ?></th>
                        <td><?php echo ($product->file != '') ? $this->image_handler->thumb('./assets/img/products/', $product->file) : '' ?></td>
                        <td><?php echo $product->name; ?></td>
                        <td><?php echo $product->brand; ?></td>
                        <td><?php echo $product->categories; ?></td>
                        <td><?php echo formata_data($product->updated_dt,2) ?></td>
                        <td style="width:175px;">                                                
                            <a class="btn btn-mini btn-light" title="Ver" target="_blank" href="<?php echo base_url("produto/" . $product->slug); ?>"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-mini btn-primary" title="Editar" href="admin/products/edit/<?php echo $product->id; ?>"><i class="fa fa-pencil"></i></a>
                            <a title="Excluir" class="btn btn-mini btn-danger" href="admin/products/delete/<?php echo $product->id; ?>" onclick="javascript:if(!confirm('Deseja realmente excluir este produto? Ao excluir não será mais exibido no sistema.')){return false;}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>Nenhuma mídia cadastrada</p>
        <?php endif ?>
    </div>
</div>
<?php echo $paginacao; ?>