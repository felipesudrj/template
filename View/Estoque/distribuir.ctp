<?php $this->start('script'); ?>
<script>
function incluiritem() {

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

                VisualizaTabelaItens();

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

function removeitem(indice) {

        $.ajax({
            url: '/estoque/ajaxRemoverItem/' + indice,
            type: 'post',
            dataType: 'html',
            success: function(retorno) {
                $.msgGrowl({
                    type: 'success'
                    , title: 'Removido com sucesso'
                    , text: 'Informações salvas com sucesso.'
                    , position: 'top-right'
                });
                VisualizaTabelaItens();
            }
        });


    }
     
function VisualizaTabelaItens(atendimento_id) {

        $.ajax({
            url: '/estoque/ajaxVisualizaTabelaItens/',
            type: "POST",
            dataType: "html",
            success: function(retorno) {
                $("#visualizaTabelaItens").html(retorno);
            },
            error: function() {
                alert('Deu erro');
            }
        });



    }

function mostrarUnidade() {

        var materialDescricao = $('#materialTipo option:selected').attr('tipoUnidade');
        $('#descTipoUnidade').html('(' + materialDescricao + ')');



    }    
	 </script>

<?php $this->end(); ?>
<div class="widget stacked">

      			<div class="widget-header">
					<i class="icon-tasks"></i>
					<h3>Distribuição de materiais </h3>
				</div> <!-- /.widget-header -->


				<div class="widget-content">

					<form action="/estoque/distribuir" role="form"  method="post" class="form-horizontal col-md-7">

						
									
										<div id="MostrarMateriaisDisponiveis" class="form-horizontal col-md-12">
										<!-- LISTAR MATERIAIS  - INICIO -->
										<div class="form-group">
										<label for="modelo" class="col-lg-4">Tipo de Material</label>
											<div class="col-md-8">
											
											 <select onclick="mostrarUnidade()" id="materialTipo"  name="material_id" class="form-control">
												<option tipoUnidade="" selected="true" disabled="true">Selecione o tipo de material</option>
												<?php foreach ($materiais as $indMat => $valMat) { ?>
													<option tipoUnidade="<?php echo $valMat['Material']['UnidadeMedida']['descricao']; ?>" value="<?php echo $valMat['MaterialDistribuido']['material_id']; ?>" >
														<?php echo $valMat['Material']['descricao']; ?>
													</option>
												<?php } ?>
											</select>
											</div>
										</div>	
										
										<div class="form-group">
										<label for="numeroserie"  class="col-lg-4">Quantidade</label>
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
										<input type="button" class="btn btn-default pull-right" value="Incluir" onclick="incluiritem();">
										</div>
										
										<hr>
										<!-- LISTAR MATERIAIS - FIM -->
										</div>
									
										<div id="visualizaTabelaItens" class="form-horizontal col-md-12">
										<!--ELEMENTOS SALVOS NA SESSAO - INICIO -->
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
												  
												 <tr>
												 <td colspan="5">Nenhum item na lista</td>
												 </tr>
												  
												</tbody>
										</table>
										</div>
										<!--ELEMENTOS SALVOS NA SESSAO - FIM -->
										</div>
									
					
						
							<div class="form-group">
							<label class="col-md-4">Selecione o técnico</label>
							<div class="col-md-8">
									<input type="select" name="Material.quantidade" required="true" value="" value="" class="form-control" />

							</div>
						</div> <!-- /.form-group -->
						
						
					
						
							<div class="form-group">

								<div class="col-md-offset-4 col-md-8">
									<a href="/estoque/relatorioitens" class="btn btn-default">Imprimir relatório</a>
									<button type="submit" class="btn btn-default">Salvar e sair</button>
								</div>

							</div> <!-- /.form-group -->

					</form>


				</div> <!-- /.widget-content -->


      		</div> <!-- /.widget -->

      
