<legend>Gerenciar Usuários</legend>
<!-- Form Busca -->

<div class="row"> 
   
    <form class="form-search form-inline" method="get" action="admin/users/manage">
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" name="busca" class="form-control" placeholder="Buscar">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Buscar</button>

    </form>
   
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
                    <th>Nome</th>
                    <th>Data de Acesso</th>
                    <th>Nível</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <?php foreach ($dadosbusca as $dados): ?>
            <?php if ($dados->status == 2) { $status = 'class="muted"';}else{ $status = "";}?>
                <tr <?php echo $status; ?>>
                    <th><?php echo $dados->id; ?></th>
                    <td><?php echo $dados->nome; ?></td>
                    <td><?php echo formata_data_extenso($dados->dt_acesso); ?></td>
                    <td><?php if ($dados->nivel == 1){echo "Administrador";}else{echo "Usuário";} ?></td>
                    <td>
                        <?php if ($dados->status == 1){?>
                        <a style="width: 75px" class="btn btn-mini ativo" href="index.php/usuarios/status/<?php echo $dados->id; ?>/1"><i class=" icon-plus"></i> Ativo</a>
                        <?php } else { ?>
                        <a style="width: 75px" class="btn btn-mini inativo" href="index.php/usuarios/status/<?php echo $dados->id; ?>/2"><i class=" icon-minus"></i> Inativo</a>
                        <?php } ?>
                    </td>
                    <td>
                        <a class="btn btn-mini btn-primary" title="Editar" href="admin/users/edit/<?php echo $dados->id; ?>"><i class="fa fa-pencil"></i></a>
                        <a title="Excluir" class="btn btn-mini btn-danger" href="admin/users/delete/<?php echo $dados->id; ?>" onclick="javascript:if(!confirm('Deseja realmente excluir os dados deste usuario? Ao excluir este usuário não terá acesso ao sistema')){return false;}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php echo $paginacao; ?>