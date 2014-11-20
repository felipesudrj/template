<?php // echo $this->element('sql_dump'); ?>




<div class="row">

    <div class="col-md-12">      		

        <div class="widget stacked">
            <?php echo $this->FilterForm->create(); ?>
            <div class="widget-header">
                <i class="icon-filter"></i>
                <h3>Filtro</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content ">




                <div class="col-md-3">

                    <div class="form-group">
                        <label>Número de OS</label>
                        <?php echo $this->FilterForm->input('nros', array('type' => 'text', "class" => "form-control")); ?>

                    </div>

                    <div class="form-group ">

                        <label>Tipo de serviço</label>
                        <?php echo $this->FilterForm->input('tipoServico', array('class' => 'select-box form-control')); ?>

                    </div>




                </div>

                <!--INCLUIR OBSERVACOES-->
                <div class="col-md-3 ">


                    <div class="form-group ">

                        <label>Nome do Cliente</label>
                        <?php echo $this->FilterForm->input('nomeCliente', array('type' => 'text', 'class' => 'form-control')); ?>

                    </div> 

                    <div class="form-group ">

                        <label>Tecnico responsável</label>
                        <?php echo $this->FilterForm->input('tecnico', array('class' => 'select-box form-control')); ?>

                    </div> 


                </div>

                <div class="col-md-3">
                    <div class="form-group ">

                        <label>Status serviço</label>
                        <?php echo $this->FilterForm->input('statusAtendimento', array('class' => 'select-box form-control')); ?>

                    </div>

                    <div class="form-group" >
                        <label></label>
                        <?php echo $this->FilterForm->submit('Filtrar', array('class' => 'btn btn-success')); ?>

                    </div>
                </div>
            </div>
            </form>						
        </div> <!-- /widget -->

        <div class="widget stacked ">

            <div class="widget-header">
                <i class="icon-list"></i>
                <h3>Listagem de atendimentos</h3>
            </div> <!-- /.widget-header -->

            <div class="widget-content">


                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Número da OS</th>
                                <th>Nome Cliente</th>
                                <th>Tipo de serviço</th>
                                <th>Status</th>
                                <th>Técnico</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($atendimento as $indice => $dados) { ?>  
                                <tr>
                                    <td><?php echo $dados['Atendimento']['nros']; ?></td>
                                    <td><?php echo $dados['Cliente']['nome']; ?></td>
                                    <td><?php echo $dados['TipoServico']['descricao']; ?></td>
                                    <td>
                                        <?php
                                        switch ($dados['StatusAtendimento']['status_atendimento_id']) {
                                            case 1:$label = "label-danger";
                                                break;
                                            case 2:$label = "label-warning";
                                                break;
                                            case 3:$label = "label-info";
                                                break;
                                            case 4:$label = "label-success";
                                                break;
                                        }
                                        ?>
                                        <span class="label <?php echo $label; ?>"><?php echo $dados['StatusAtendimento']['descricao']; ?></span>

                                    </td>
                                    <td><?php echo $dados['Tecnico']['nome']; ?></td>

                                    <td>
                                        <a href="/atendimento/alterar/<?php echo $dados['Atendimento']['atendimento_id']; ?>#dadosos" class="badge"><i class="icon-search"></i> Visualizar</a>

                                        <?php if ($dados['StatusAtendimento']['status_atendimento_id'] == 1) { ?>

                                            <a href="/atendimento/alterar/<?php echo $dados['Atendimento']['atendimento_id']; ?>#agendamento" class="badge"><i class="icon-calendar"></i> Agendar</a>

                                        <?php } ?>

                                        <?php if ($dados['StatusAtendimento']['status_atendimento_id'] == 2) { ?>

                                            <a href="/atendimento/alterar/<?php echo $dados['Atendimento']['atendimento_id']; ?>#atribuicao" class="badge"><i class="icon-plus"></i> Atribuir ao técnico</a>

                                        <?php } ?>
                                            
                                       <?php if ($dados['StatusAtendimento']['status_atendimento_id'] == 4) { ?>

                                            <a href="/atendimento/alterar/<?php echo $dados['Atendimento']['atendimento_id']; ?>#finalizar" class="badge "><i class="icon-list"></i> Finaliza demanda</a>

                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4" style="text-align: center;"><?php
                                        echo $this->Paginator->counter(
                                                'Total de registros {:count}'
                                        );
                                        ?>
                                        <br>
                                        <?php echo $this->Paginator->first('Primeira'); ?>  
                                        <?php echo $this->paginator->numbers(); ?>  
                                        <?php echo $this->Paginator->last('Última'); ?> 
                                    </div>

                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div> <!-- /.table-responsive -->



            </div> <!-- /widget-content -->

        </div> <!-- /widget -->

    </div> <!-- /span12 -->

</div> <!-- /row -->