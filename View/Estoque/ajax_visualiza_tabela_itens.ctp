<!--ELEMENTOS SALVOS NA SESSAO - INICIO ajaxIncluirItemRat -->
<div class="form-group">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Cod. Material</th>
                <th>Modelo</th>
                <th>Quantidade</th>
                <th>Informações</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($itens)) { ?>
                <tr>
                    <td colspan="5">Nenhum item cadastrado</td>
                    
                </tr>

            <?php } else { ?> 
                <?php foreach ($itens as $indice => $mat) { ?>
                    <tr>
                        <td><?php echo $indice; ?></td>
                        <td><?php echo $mat['descricao']; ?></td>
                        <td><?php echo $mat['quantidade']; ?></td>
                        <td><?php echo $mat['informacoes']; ?></td>
                        <td><a onclick="removeitem('<?php echo $indice; ?>')">Remover</a></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>
<!--ELEMENTOS SALVOS NA SESSAO - FIM -->