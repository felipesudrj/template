<?php $this->start('css'); ?>
<link href="/js/plugins/msgGrowl/css/msgGrowl.css" rel="stylesheet">

<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script src="/js/plugins/msgGrowl/js/msgGrowl.js"></script>

<script>

    function incluiritemrat() {

        var materialTipo = $('#materialTipo').val();
        var materialDescricao = $('#materialTipo option:selected').text();
        var materialQuantidade = $('#materialQuantidade').val();
        var materialInformacoes = $('#materialInformacoes').val();


        $.ajax({
            url: "/estoque/ajaxIncluirItem",
            type: "POST",
            data: {material_id: materialTipo, quantidade: materialQuantidade, descricao: materialDescricao, informacoes: materialInformacoes},
            dataType: "json",
            success: function(retorno) {

                $.msgGrowl({
                    type: retorno.tipo
                    , title: retorno.titulo
                    , text: retorno.msg
                });

                visualizaTabelaItens();

            },
            error: function() {
                $.msgGrowl({
                    type: 'error'
                    , title: "Erro"
                    , text: "Ocorreu um erro ao realizar essa operação"
                });
            }
        });
    }

    function visualizaTabelaItens() {

        $.ajax({
            url: '/estoque/ajaxVisualizaTabelaItens',
            type: 'post',
            dataType: 'html',
            success: function(retorno) {

                $('#visualizaTabelaItens').html(retorno);

            }
        });


    }

    function removeitem(indice) {

        $.ajax({
            url: '/estoque/ajaxRemoverItem/' + indice,
            type: 'post',
            dataType: 'json',
            success: function(retorno) {
                visualizaTabelaItens();
            }
        });


    }
    
    function mostrarUnidade() {

        var materialDescricao = $('#materialTipo option:selected').attr('tipoUnidade');
        $('#descTipoUnidade').html('(' + materialDescricao + ')');



    }
    visualizaTabelaItens();





</script>
<?php $this->end(); ?>


<div class="col-md-12">


    <div class="widget stacked">

        <div class="widget-header">
            <i class="icon-tasks"></i>
            <h3>Distribuição de materiais </h3>
        </div> <!-- /.widget-header -->


        <div class="widget-content">

            <div class="form-horizontal col-md-7">



                <div id="MostrarMateriaisDoTecnico" class="form-horizontal col-md-12">
                    <!-- LISTAR MATERIAIS QUE O TECNICO POSSUI - INICIO -->
                    <div class="form-group">
                        <label for="modelo" class="col-lg-4">Tipo de Material</label>
                        <div class="col-md-8">

                            <select id="materialTipo" onclick="mostrarUnidade()"  name="material_id" class="form-control">
                                <option disabled="true" selected="true">Selecione um tipo de material</option>
                                <?php foreach ($materiais as $indMat => $valMat) { ?>
                                    <option tipoUnidade="<?php echo $valMat['UnidadeMedida']['descricao']; ?>" value="<?php echo $valMat['Material']['material_id']; ?>"><?php echo $valMat['Material']['descricao']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>	

                    <div class="form-group">
                        <label for="numeroserie"  class="col-lg-4">Quantidade <span id="descTipoUnidade"></span></label>
                        <div class="col-md-8">
                            <input type="text" name="quantidade" class="form-control" id="materialQuantidade" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="numeroserie" class="col-lg-4">Outras Informações</label>
                        <div class="col-md-8">
                            <input type="text"  name="informacoes" class="form-control" id="materialInformacoes" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="button" class="btn btn-default pull-right" value="Incluir" onclick="incluiritemrat();">
                    </div>

                    <hr>
                    <!-- LISTAR MATERIAIS QUE O TECNICO POSSUI - FIM -->
                </div>

                <div id="visualizaTabelaItens" class="form-horizontal col-md-12">
                    <!--ELEMENTOS SALVOS NA SESSAO - INICIO ajaxIncluirItemRat -->
                    <div class="form-group">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Quantidade</th>
                                    <th>Informações</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($itens as $indice => $mat) { ?>
                                    <tr>
                                        <td><?php echo $indice; ?></td>
                                        <td><?php echo $mat['descricao']; ?></td>
                                        <td><?php echo $mat['quantidade']; ?></td>
                                        <td><?php echo $mat['informacoes']; ?></td>
                                        <td><a href="" onclick="removeitemrat('<?php echo $indice; ?>')">Remover</a></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td>3</td>
                                    <td>3</td>
                                    <td>Larry the Bird</td>
                                    <td>@twitter</td>
                                    <td><a href="/atendimento/itemrat/remove/numeroitem">Remover</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--ELEMENTOS SALVOS NA SESSAO - FIM -->
                </div>

                     <?php echo $this->Form->create(); ?>

                <div class="form-group">
                    <label class="col-md-4">Selecione o técnico</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->input('MaterialDistribuido.tecnico_id',array('empty'=>'Selecione um técnico','type'=>'select','option'=>$tecnicos,'label'=>false,'class'=>'form-control')); ?>

                    </div>
                </div> <!-- /.form-group -->




                <div class="form-group">

                    <div class="col-md-offset-4 col-md-8">
                        <?php echo $this->Form->submit('Gravar',array('class'=>'btn btn-success')); ?>

                    </div>

                </div> <!-- /.form-group -->

            
            </div>


        </div> <!-- /.widget-content -->


    </div> <!-- /.widget -->

</div> <!-- /.col-md-12 -->