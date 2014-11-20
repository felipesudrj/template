<?php $this->start('script'); ?>
<script src="/js/demo/sliders.js"></script>
<script>
    $('.datepicker').datepicker({dateFormat: "dd/mm/yy"});

</script>


<?php $this->end(); ?>
<div class="row">



    <div class="col-md-12 col-xs-12">	






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




                    <div class="form-group ">

                        <label>Status serviço</label>

                        <?php echo $this->FilterForm->input('statusAtendimento', array('class' => 'select-box form-control')); ?>

                    </div>


                </div>

                <div class="col-md-4 ">
                    <label>Selecione uma data inicial</label>
                    <br>
                    <?php echo $this->FilterForm->input('agendamento', array('class' => 'form-control datepicker'), array('before' => '<br>Até', 'class' => 'form-control datepicker')); ?>

                </div>
                <!--INCLUIR OBSERVACOES-->
                <div class="col-md-3 ">

                    <div class="form-group" style="margin-top:30px;">

                        <?php echo $this->FilterForm->submit('Filtrar', array('class' => 'btn btn-success')); ?>

                    </div>
                </div>
            </div>
            </form>						
        </div> <!-- /widget -->	


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
                            <th>Endereço</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($atendimento)){?>
                        <tr>
                            <td colspan="5">
                                Nenhuma demanda
                            </td>
                        </tr>
                        
                        <?php }?>
                        <?php foreach ($atendimento as $indice => $valor) { ?>
                            <tr>
                                <td><?php echo $valor['Atendimento']['nros'];?></td>
                                <td><?php echo $valor['TipoServico']['descricao'];?></td>
                                <td><?php echo $valor['Cliente']['logradouro'];?>, <?php echo $valor['Cliente']['numero'];?> - <?php echo $valor['Cliente']['bairro'];?> - <?php echo $valor['Cliente']['cidade'];?> - <?php echo $valor['Cliente']['estado'];?></td>
                                <td><?php echo $valor['StatusAtendimento']['descricao'];?></td>
                                <td class="td-actions">
                                    <a href="/atendimento/alterar/<?php echo $valor['Atendimento']['atendimento_id'];?>#dadosos" class="btn btn-xs btn-primary">
                                        <i class="btn-icon-only icon-search"> VER</i>										
                                    </a>

                                     <?php if($valor['StatusAtendimento']['status_atendimento_id']==3){?>
                                    <a href="/atendimento/alterar/<?php echo $valor['Atendimento']['atendimento_id'];?>#rat" class="btn btn-xs btn-success">
                                        <i class="btn-icon-only icon-ok"> RAT</i>										
                                    </a>
                                     <?php }?>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                    <footer>
                        <tr>
                            <td colspan="5">

                              

                               
                                      <?php echo $this->Paginator->prev(__('Página anterior'), array('class'=>'btn btn-default'));?>
                                   
                                     <?php echo $this->Paginator->next(__('Próxima página'), array('class'=>'btn btn-default'));?>

                              



                            </td>
                        </tr>
                    </footer>
                </table>

            </div> <!-- /widget-content -->

        </div> <!-- /widget -->




    </div> <!-- /span6 -->

</div> <!-- /row -->