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
                                <th>Matricula</th>
                                <th>Nome do técnico</th>
                                <th>Telefone</th>
                                <th>Email</th>
                                
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tecnicos as $indice => $dados) { ?>  
                                <tr>
                                    <td><?php echo $dados['Tecnico']['matricula']; ?></td>
                                    <td><?php echo $dados['Tecnico']['nome']; ?></td>
                                    <td><?php echo $dados['Tecnico']['celular']; ?></td>
                                    <td>
                                      <?php echo $dados['Tecnico']['email']; ?>
                                    </td>
                                    <td>
                                        <a href="/tecnico/excluir" class="label label-danger"><span class="icon icon-remove-sign"></span>Excluir</a>
                                        <a href="/tecnico/cadastrar/<?php echo $dados['Tecnico']['tecnico_id']; ?>" class="label label-danger"><span class="icon icon-info-sign"></span>Informações</a>
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