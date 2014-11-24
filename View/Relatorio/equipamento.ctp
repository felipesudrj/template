<?php $this->start('script'); ?>
<script>
    $(".datepicker").datepicker({
        dateFormat: 'dd/mm/yy'
    });

</script>
<?php $this->end(); ?>



<div class="widget stacked">

    <div class="widget-header">
        <i class="icon-star"></i>
        <h3>Relatório de equipamentos </h3>
    </div> <!-- /widget-header -->

    <div class="widget-content">
        <div class="stats">




                <?php echo $this->Form->create(); ?>
                <div class="col-md-5">

                    <div class="form-group">
                        <label for="from">Numero de protocolo</label>
                        <?php echo $this->Form->input('MaterialDistribuido.protocolo', array('class' => 'form-control', 'label' => false)); ?>



                    </div>

                    <div class="form-group">
                        <label for="from">Data de retirada</label>
                        <?php echo $this->Form->input('MaterialDistribuido.data_retirada', array('type'=>'text','class' => 'datepicker form-control', 'label' => false)); ?>

                    </div>






                </div> <!-- /stat -->

                <div class="col-md-5">
                    <div class="form-group">
                        <label>Técnico</label>
                        <?php echo $this->Form->input('MaterialDistribuido.tecnico_id', array('empty'=>'Selecione um tecnico','type'=>'select','options'=>$tecnicos,'class' => 'form-control', 'label' => false)); ?>



                    </div>

                    <div class="form-group">
                        <?php echo $this->Form->submit('Gerar relatório', array('class' => 'btn btn-success pull-right')); ?>
                    </div>
                </div> <!-- /stat -->

            </form>
        </div>

    </div> <!-- /widget-content -->

</div>
