<?php $this->start('css'); ?>
<link href="/js/plugins/msgGrowl/css/msgGrowl.css" rel="stylesheet">

<?php $this->end(); ?>
<?php $this->start('script'); ?>
<script src="/js/plugins/msgGrowl/js/msgGrowl.js"></script>

<script>
    function mostrarUnidade() {

        var materialDescricao = $('#materialTipo option:selected').attr('tipoUnidade');
        $('#descTipoUnidade').html('(' + materialDescricao + ')');



    }
    function enviarForm(nomeForm) {

        $("#" + nomeForm).submit();

    }

    function alterarDados() {

        var dados = $('#form-dadosos').serialize();
        $.ajax({
            url: '/atendimento/ajaxEditarAtendimento',
            type: 'post',
            data: dados,
            dataType: 'json',
            beforeSend: function() {
                $('#carregando').modal('show');
            },
            success: function(retorno) {

                $.msgGrowl({
                    type: retorno.tipo
                    , title: retorno.titulo
                    , text: retorno.msg
                    , position: 'top-right'
                });


            },
            error: function(error) {
                $.msgGrowl({
                    type: 'error'
                    , title: 'Erro'
                    , text: 'Não foi possivel realizar essa operação. Você não tem permissão para isso'
                    , position: 'top-right'
                });
            },
            complete: function() {

                $('#carregando').modal('hide');
            }
        }
        );

    }

    function agendarOS() {
        var dados = $('#form-agendamento').serialize();
        $.ajax({
            url: '/atendimento/ajaxAgendar',
            type: 'post',
            data: dados,
            dataType: 'json',
            beforeSend: function() {
                $('#carregando').modal('show');
            },
            success: function(retorno) {

                $.msgGrowl({
                    type: retorno.tipo
                    , title: retorno.titulo
                    , text: retorno.msg
                    , position: 'top-right'
                });


            },
            error: function(error) {
                $.msgGrowl({
                    type: 'error'
                    , title: 'Erro'
                    , text: 'Não foi possivel efetivar o agendamento'
                    , position: 'top-right'
                });
            },
            complete: function() {

                $('#carregando').modal('hide');
            }
        }
        );
    }

    function atribuir() {
        var dados = $('#form-atribuicao').serialize();
        $.ajax({
            url: '/atendimento/ajaxAtribuir',
            type: 'post',
            data: dados,
            dataType: 'json',
            beforeSend: function() {
                $('#carregando').modal('show');
            },
            success: function(retorno) {

                $.msgGrowl({
                    type: retorno.tipo
                    , title: retorno.titulo
                    , text: retorno.msg
                    , position: 'top-right'
                });

            },
            error: function(error) {
                $.msgGrowl({
                    type: 'error'
                    , title: 'Erro'
                    , text: 'Não foi possivel efetivar o agendamento'
                    , position: 'top-right'
                });
            },
            complete: function() {

                $('#carregando').modal('hide');
            }
        }
        );
    }

    function rat() {
        var dados = $('#form-rat').serialize();
        $.ajax({
            url: '/atendimento/agendar',
            type: 'post',
            data: dados,
            dataType: 'json',
            beforeSend: function() {
                $('#carregando').modal('show');
            },
            success: function(retorno) {

                $.msgGrowl({
                    type: 'success'
                    , title: 'Salvo com sucesso'
                    , text: 'Informações salvas com sucesso.'
                    , position: 'top-right'
                });


            },
            error: function(error) {
                $.msgGrowl({
                    type: 'error'
                    , title: 'Erro'
                    , text: 'Não foi possivel criar o relatorio de atendimento técnico'
                    , position: 'top-right'
                });
            },
            complete: function() {

                $('#carregando').modal('hide');
            }
        }
        );
    }

    function ajaxFinalizar() {

        var dados = $('#form-finalizar').serialize();
        $.ajax({
            url: '/atendimento/finalizar',
            type: 'post',
            data: dados,
            dataType: 'json',
            beforeSend: function() {
                $('#carregando').modal('show');
            },
            success: function(retorno) {

                $.msgGrowl({
                    type: 'success'
                    , title: 'Salvo com sucesso'
                    , text: 'Informações salvas com sucesso.'
                    , position: 'top-right'
                });


            },
            error: function(error) {
                $.msgGrowl({
                    type: 'error'
                    , title: 'Erro'
                    , text: 'Não foi possivel finalizar essa ordem de serviço'
                    , position: 'top-right'
                });
            },
            complete: function() {

                $('#carregando').modal('hide');
            }
        }
        );
    }

    function incluiritemrat() {

        var materialTipo = $('#materialTipo').val();
        var materialDescricao = $('#materialTipo option:selected').text();
        var materialQuantidade = $('#materialQuantidade').val();
        var materialInformacoes = $('#materialInformacoes').val();


        $.ajax({
            url: "/atendimento/ajaxIncluirItemRat",
            type: "POST",
            data: {material_id: materialTipo, quantidade: materialQuantidade, descricao: materialDescricao, informacoes: materialInformacoes},
            dataType: "json",
            success: function(retorno) {

                $.msgGrowl({
                    type: retorno.tipo
                    , title: retorno.titulo
                    , text: retorno.msg
                });

                VisualizaTabelaItens('<?php echo $atendimento['Atendimento']['atendimento_id']; ?>');

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

    function MostrarMateriaisDoTecnico() {
        $.ajax({
            url: '/atendimento/ajaxMostrarMateriaisDoTecnico/<?php echo $atendimento['Atendimento']['atendimento_id']; ?>',
            type: "POST",
            dataType: "html",
            success: function(retorno) {
                $("#MostrarMateriaisDoTecnico").html(retorno);
            },
            error: function() {
                alert('Deu erro');
            }
        });
    }

    function VisualizaTabelaItens(atendimento_id) {

        $.ajax({
            url: '/atendimento/ajaxVisualizaTabelaItens/' + atendimento_id,
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

    function removeitemrat(indice) {

        $.ajax({
            url: '/atendimento/ajaxRemoverItemRat/' + indice,
            type: 'post',
            dataType: 'html',
            success: function(retorno) {
                $.msgGrowl({
                    type: 'success'
                    , title: 'Removido com sucesso'
                    , text: 'Informações salvas com sucesso.'
                    , position: 'top-right'
                });
                VisualizaTabelaItens('<?php echo $atendimento['Atendimento']['atendimento_id']; ?>');
            }
        });


    }
    MostrarMateriaisDoTecnico();
    VisualizaTabelaItens('<?php echo $atendimento['Atendimento']['atendimento_id']; ?>');

    $('.datepicker').datepicker({dateFormat: "dd/mm/yy"});

    var parametro = location.href.split('#').pop();

    if (parametro.length > 11) {
        parametro = "dadosos";
    }
    $('#' + parametro).addClass('active');
    $('.' + parametro).addClass('active');
</script>

<?php $this->end(); ?>
<div class="col-md-12">      		

    <div class="widget stacked ">

        <div class="widget-header">
            <i class="icon-user"></i>
            <h3>Informações de ordem de serviço <strong class="badge"> 88559</strong></h3>
        </div> <!-- /widget-header -->

        <div class="widget-content">



            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="dadosos">
                        <a href="#dadosos" data-toggle="tab">Informações ordem de serviço</a>
                    </li>
                    <li class="agendamento">
                        <a href="#agendamento" data-toggle="tab">Agendamento</a>
                    </li>
                    <li class="atribuicao"><a href="#atribuicao" data-toggle="tab">Atribuição</a></li>
                    <li class="rat"><a href="#rat" data-toggle="tab">RAT</a></li>

                    <li class="finalizar"><a href="#finalizar" data-toggle="tab">Finalizar</a></li>
                </ul>

                <br>

                <div class="tab-content">

                    <div class="tab-pane " id="dadosos">
                        <form id="form-dadosos" action="#" method="post" class="form-horizontal col-md-8">
                            <fieldset>

                                <div class="form-group">											
                                    <label for="username" class="col-md-4">Número da OS</label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->input('Atendimento.atendimento_id', array('type' => 'hidden', 'class' => 'form-control', 'id' => 'atendimento_id', 'label' => false)); ?>
                                        <?php echo $this->Form->input('Cliente.atendimento_id', array('type' => 'hidden', 'class' => 'form-control', 'id' => 'cliente-atendimento_id', 'label' => false)); ?>

                                        <?php echo $this->Form->input('Atendimento.nros', array('class' => 'form-control', 'id' => 'nros', 'label' => false)); ?>
                                        <p class="help-block">Arquivo importado dia <?php echo $atendimento['Atendimento']['data_criacao']; ?></p>
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->


                                <div class="form-group">											
                                    <label for="firstname" class="col-md-4">Número de contrato</label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->input('Atendimento.nrcontrato', array('class' => 'form-control', 'id' => 'nrcontrato', 'label' => false)); ?>
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->


                                <div class="form-group">											
                                    <label for="status" class="col-md-4">Status da ordem de serviço</label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->input('Atendimento.status_atendimento_id', array('type' => 'select', 'options' => $statusAtendimento, 'class' => 'form-control', 'id' => 'nrcontrato', 'label' => false)); ?>
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->

                                <div class="form-group">											
                                    <label class="col-md-4" for="nome">Nome do Cliente</label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->input('Cliente.nome', array('class' => 'form-control', 'id' => 'atendimento-nome', 'label' => false)); ?>

                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->


                                <div class="form-group">											
                                    <label class="col-md-4" for="logradouro">Logradouro</label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->input('Cliente.logradouro', array('class' => 'form-control', 'id' => 'atendimento-logradouro', 'label' => false)); ?>
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->

                                <div class="form-group">											
                                    <label class="col-md-4" for="numero">Número</label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->input('Cliente.numero', array('class' => 'form-control', 'id' => 'atendimento-numero', 'label' => false)); ?>
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->



                                <div class="form-group">											
                                    <label class="col-md-4" for="bairro">Bairro</label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->input('Cliente.bairro', array('class' => 'form-control', 'id' => 'atendimento-bairro', 'label' => false)); ?>
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->


                                <div class="form-group">											
                                    <label class="col-md-4" for="cidade">Cidade</label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->input('Cliente.cidade', array('class' => 'form-control', 'id' => 'atendimento-cidade', 'label' => false)); ?>
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->



                                <hr><br>

                                <div class="form-group">											
                                    <label class="col-md-4" for="password1">Tipo de Serviço</label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->input('Atendimento.tipo_servico_id', array('type' => 'select', 'options' => $tipoServico, 'class' => 'form-control', 'id' => 'atendimento-tipo_servico_id', 'label' => false)) ?>
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->

                                <div class="form-group">											
                                    <label class="col-md-4" for="tarefa">Descrição da atividade</label>
                                    <div class="col-md-8" >
                                        <?php echo $this->Form->input('Atendimento.tarefa', array('class' => 'form-control', 'id' => 'atendimento-cidade', 'label' => false)); ?>

                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->

                                <br>


                                <div class="form-group">

                                    <div class="col-md-offset-4 col-md-8">
                                        <button type="button"  class="btn btn-primary" onclick="alterarDados(this)" data-type="success">Salvar</button> 
                                        <a href="/atendimento/listar" class="btn btn-default">Voltar</a>
                                    </div>
                                </div> <!-- /form-actions -->
                            </fieldset>
                        </form>
                    </div>

                    <div class="tab-pane" id="agendamento">
                        <form id="form-agendamento" class="form-horizontal col-md-8">
                            <fieldset>




                                <div class="form-group">
                                    <label class="col-md-4" for="emailserver">Data de agendamento</label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->input('Agendamento.atendimento_id', array('type' => 'hidden', 'value' => $this->request->data['Atendimento']['atendimento_id'])); ?>
                                        <?php $data_agendamento = !empty($this->request->data['Agendamento']['0']['data_agendamento']) ? date('d/m/Y', strtotime($this->request->data['Agendamento']['0']['data_agendamento'])) : date('d/m/Y'); ?>
                                        <?php echo $this->Form->input('Agendamento.data_agendamento', array('type' => 'text', 'class' => 'form-control datepicker', 'value' => $data_agendamento, 'id' => 'data-agendamento', 'label' => false)); ?>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-4" for="contato">Contato</label>
                                    <div class="col-md-8">
                                        <?php $contato = !empty($this->request->data['Agendamento']['0']['contato']) ? $this->request->data['Agendamento']['0']['contato'] : ""; ?>
                                        <?php echo $this->Form->input('Agendamento.contato', array('type' => 'text', 'class' => 'form-control', 'value' => $contato, 'id' => 'agendamento-contato', 'label' => false)); ?>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="message" class="col-lg-4">Observações</label>
                                    <div class="col-md-8">

                                        <?php $observacao = !empty($this->request->data['Agendamento']['0']['observacoes']) ? $this->request->data['Agendamento']['0']['observacoes'] : ""; ?>
                                        <?php echo $this->Form->textarea('Agendamento.observacoes', array('rows' => '4', 'class' => 'form-control datepicker', 'value' => $observacao, 'id' => 'agendamento-observacoes', 'label' => false)); ?>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-offset-4 col-md-8">
                                        <button type="button" class="btn btn-primary" onclick="agendarOS();">Salvar</button> <a href="/atendimento/listar" class="btn btn-default">Voltar</a>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                    <div class="tab-pane" id="atribuicao">
                        <form id="form-atribuicao" class="form-horizontal col-md-8">
                            <fieldset>




                                <div class="form-group">
                                    <label for="" class="col-md-4">Atribuir ao técnico</label>
                                    <div class="col-md-8">
                                        <?php echo $this->Form->input('Atribuicao.atendimento_id', array('type' => 'hidden', 'value' => $this->request->data['Atendimento']['atendimento_id'])); ?>
                                        <?php $tecnico_id = !empty($this->request->data['Atribuicao']['0']['tecnico_id']) ? $this->request->data['Atribuicao']['0']['tecnico_id'] : '-'; ?>
                                        <?php echo $this->Form->input('Atribuicao.tecnico_id', array('type' => 'select', 'options' => $tecnicos, 'class' => 'form-control', 'value' => $tecnico_id, 'id' => 'atribuicao-tecnico-id', 'label' => false)); ?>


                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="message" class="col-lg-4">Data para execução</label>
                                    <div class="col-md-8">
                                        <?php $data_execucao = !empty($this->request->data['Agendamento']['0']['data_agendamento']) ? date('d/m/Y', strtotime($this->request->data['Agendamento']['0']['data_agendamento'])) : date('d/m/Y'); ?>

                                        <?php echo $this->Form->input('Atribuicao.data_execucao', array('type' => 'text', 'class' => 'form-control datepicker', 'value' => $data_execucao, 'id' => 'atribuicao-data-execucao', 'label' => false)); ?>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-4 col-md-8">
                                        <button type="button" class="btn btn-primary" onclick="atribuir()">Salvar</button> <a href="/atendimento/listar" class="btn btn-default">Voltar</a>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                    <div class="tab-pane" id="rat">

                        <fieldset>

                            <div id="MostrarMateriaisDoTecnico" class="form-horizontal col-md-12">
                                        <div class="alert alert-danger alert-dismissable">
											  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											  <strong>Desculpe!</strong> Nenhum material atribuido ao técnico definido no agendamento.</a>.
										</div>
                            </div>


                            <div id="visualizaTabelaItens" class="form-horizontal col-md-12">
                                <!--ELEMENTOS SALVOS NA SESSAO - INICIO ajaxIncluirItemRat -->
                                <div class="form-group">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Modelo</th>
                                                <th>Quantidade</th>
                                                <th>Informações</th>
                                                <th>Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <tr>
                                                <td colspan="5">Nenhum item incluido</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--ELEMENTOS SALVOS NA SESSAO - FIM -->
                            </div>

                           <form id="form-rat" class="form-horizontal col-md-12">
                                
								<div class="form-group">
                                    <label for="message" class="col-lg-4">Data da realização</label>
                                    <div class="col-md-8">
									
                                        <input type="text" class="form-control datepicker" name="data[Rat][data_realizacao]"/>
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="message" class="col-lg-4">Número RAT</label>
                                    <div class="col-md-8">
										<input type="hidden" class="form-control" name="data[Rat][atendimento_id]" value="<?php echo $atendimento['Atendimento']['atendimento_id']; ?>"/>
                                        <input type="text" class="form-control" name="data[Rat][numero_rat]"/>
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="message" class="col-lg-4">Observações</label>
                                    <div class="col-md-8">
                                        <input type="hidden" value="numeroos" name="numeroos" class="form-control" />
                                        <input type="hidden" value="2" name="atendimento_id" class="form-control" />
                                        <textarea class="form-control" name="observacoes" id="observacoes-rat" rows="4"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-4 col-md-8">
                                        <button type="button" class="btn btn-primary" onclick="rat()">Salvar</button> <a href="/" class="btn btn-default">Cancel</a>
                                    </div>
                                </div>

                            </form>
                        
						   </fieldset>
                    </div>	

                    <div class="tab-pane" id="finalizar">
                        <form id="form-finalizar" class="form-horizontal col-md-12">
                            <fieldset>


                                 
	
                                <div class="form-group">
                                    <label for="message" class="col-lg-4">Observações de finalizacao</label>
                                    <div class="col-md-8">
									<input type="" name="data[Atendimento][atendimento_id]" value="<?php echo $atendimento['Atendimento']['atendimento_id'];?>"/>
								 <textarea class="form-control" name="data[Atendimento][informacoes]" id="observacoes-finalizar" rows="4"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-4 col-md-8">
                                        <button type="button" class="btn btn-primary" onclick="finalizar()">Finalizar</button> <a href="" class="btn btn-default">Cancel</a>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                </div>


            </div>





        </div> <!-- /widget-content -->

    </div> <!-- /widget -->

</div> <!-- /span8 -->

