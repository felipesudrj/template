

<div class="row">


    <div class="col-md-6 col-xs-12">


        <div class="widget stacked">

            <div class="widget-header">
                <i class="icon-bookmark"></i>
                <h3>Quick Shortcuts</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">

                <div class="shortcuts">

                    <a href="/atendimento/tecnico" class="shortcut">
                        <i class="shortcut-icon icon-calendar"></i>
                        <span class="shortcut-label">Lista <br>de chamados</span>								
                    </a>




                    <a href="javascript:;" class="shortcut">
                        <i class="shortcut-icon icon-cog"></i>
                        <span class="shortcut-label">Equipamentos retirados</span>
                    </a>				
                </div> <!-- /shortcuts -->	

            </div> <!-- /widget-content -->

        </div> <!-- /widget -->




    </div> <!-- /span6 -->


    <div class="col-md-6">	










        <div class="widget stacked widget-table action-table">

            <div class="widget-header">
                <i class="icon-th-list"></i>
                <h3>Ordem de serviço</h3>
            </div> <!-- /widget-header -->

            <div class="widget-content">

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Número OS</th>
                            <th>Serviço</th>
                            <th>Status</th>
                            <th>Data de agendamento</th>
                            <th class="td-actions"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($atendimento as $indice => $valor) { ?>
                            <tr>
                                <td><?php echo $valor['Atendimento']['nros'];?></td>
                                <td><?php echo $valor['TipoServico']['descricao'];?></td>
                                 <td><?php echo $valor['StatusAtendimento']['descricao'];?></td>
                                   <td><?php echo $valor['Agendamento']['data_agendamento'];?></td>
                                <td class="td-actions">
                                    <a href="/atendimento/alterar/<?php echo $valor['Atendimento']['atendimento_id'];?>#dadosos" class="btn btn-xs btn-primary">
                                        <i class="btn-icon-only icon-search">VER</i>										
                                    </a>
                                    <?php if($valor['StatusAtendimento']['status_atendimento_id']==3){?>
                                    <a href="/atendimento/alterar/<?php echo $valor['Atendimento']['atendimento_id'];?>#rat" class="btn btn-xs btn-success">
                                        <i class="btn-icon-only icon-ok">RAT</i>										
                                    </a>
                                     <?php }?>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                    <footer>
                        <tr>
                            <td colspan="5"><a href="/atendimento/tecnico"><span class="pull-right badge badge-important">Ver todos</span></a></td>
                        </tr>
                    </footer>
                </table>

            </div> <!-- /widget-content -->

        </div> <!-- /widget -->

    </div> <!-- /span6 -->

</div> <!-- /row -->



