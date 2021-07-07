<legend>Gerenciar Marcas</legend>
<!-- Form Busca -->


<div class="row msgOk">     
    <?php echo get_msg("msgOk"); ?>
</div>

<div class="row"> 
    <div class="col-10">
        <form class="form-search form-inline" method="get" action="admin/brands/manage">
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
        <a class="btn btn-success mb-2 f-right" href="<?=base_url('admin/brands/create')?>" title="Cadatrar nova categoria"><i class="fa fa-plus" style="font-size:19px"></i></a>
    </div>
</div>

<div class="row"> 
    <?php echo get_msg("msgs"); ?>
</div>
<div class="row"> 
    <div class="col-12">
        <table style="max-width: 100% !important;" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Categorias</th>
                    <th>Data de Alteração</th>
                    <th>Banner Desktop</th>
                    <th>Banner Mobile</th>
                    <th>Ação</th>
                </tr>
            </thead>
            
            <?php foreach ($brands as $brand): ?>
                                
                <tr>
                    <th><?= $brand->id; ?></th>
                    <td><?= $brand->name; ?></td>
                    <td title="<?php echo $brand->categories; ?>"><?php echo $brand->categories; ?></td>
                    <td><?php echo formata_data($brand->updated_dt,2) ?></td>
                    <td>
                        <?php $banner = brand_banner($brand->banner); ?>
                        <?php if ( $brand->banner !== '' and isImage($banner) ):  ?>
                            <img class="img_banner" src="<?=$banner?>" alt="banner-<?=$brand->name?>" title="Banner <?=$brand->name?>">                        
                        <?php endif ?>
                    </td>
                    <td>
                        <?php 
                            $mobile_image = brand_banner($brand->banner_mobile, true); 
                        ?>
                        <?php if ( $brand->banner_mobile !== '' and isImage($mobile_image)):  ?>
                            <img class="img_banner" src="<?=$mobile_image?>" alt="banner_mobile-<?=$brand->name?>" title="Banner mobile <?=$brand->name?>">                        
                        <?php endif ?>
                    </td>
                    <td style="width:170px;">                        
                        <a class="btn btn-mini btn-primary" title="Editar" href="admin/brands/edit/<?php echo $brand->id; ?>"><i class="fa fa-pencil"></i></a>
                        <a title="Excluir" class="btn btn-mini btn-danger" href="admin/brands/delete/<?php echo $brand->id; ?>" onclick="javascript:if(!confirm('Deseja realmente excluir os dados desta categoria? Ao excluir não será mais exibido no sistema.')){return false;}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php echo $paginacao; ?>