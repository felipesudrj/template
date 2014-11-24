<?php $this->start('script'); ?>
<script>
    $("#from").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat: 'dd/mm/yy',
        onClose: function(selectedDate) {
            $("#to").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#to").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat: 'dd/mm/yy',
        onClose: function(selectedDate) {
            $("#from").datepicker("option", "maxDate", selectedDate);
        }
    });
</script>
<?php $this->end(); ?>
<div class="widget stacked">

    <div class="widget-header">
        <i class="icon-star"></i>
        <h3>Relatório de atendimento </h3>
    </div> <!-- /widget-header -->

    <div class="widget-content">
        <div class="stats">




            <?php echo $this->Form->create(); ?>
            <div class="col-md-5">

                
<div class="form-group">
                    <label>Data de agendamento</label>
                
                <?php
                echo $this->Form->input('Agendamento.data_agendamento', array('type'=>'text','label'=>false,'class' => 'form-control', 'id' => 'from'));
                
                ?>
</div>





            </div> <!-- /stat -->

            <div class="col-md-5">
                <div class="form-group">
                    <label>Técnico</label>
                    <?php echo $this->Form->input('Tecnico.tecnico_id', array('empty'=>'Selecione um técnico','label'=>false,'class' => 'select-box form-control','type'=>'select')); ?>

                </div>
                <div class="form-group">

                    <label>Status de ordem de serviço</label>
                    <?php echo $this->Form->input('Atendimento.status_atendimento_id', array('empty'=>'Selecione o status da demanda','options'=>$statusAtendimento,'label'=>false,'type'=>'select','class' => 'select-box form-control')); ?>

                </div>

                <div class="form-group">

                    <?php echo $this->Form->submit('Gerar relatório', array('class' => 'btn btn-success')); ?>
                </div>
            </div> <!-- /stat -->

        </div>

    </div> <!-- /widget-content -->

</div>
