<?php
$this->start('css');
echo $this->Html->css('pages/plans.css');
?>

<?php $this->end(); ?>




<div class="col-md-12" style="margin-top: 2.5em;">

    <div class="widget stacked">

        <div class="widget-header">
            <i class="icon-tasks"></i>
            <h3>Alterar senha</h3>
        </div> <!-- /.widget-header -->


        <div class="widget-content">

            <?php //echo $this->Form->create('Usuario',array('method'=>'post','class'=>'form-horizontal col-md-7','url'=>array('controller'=>'Usuario','action'=>'index'))); ?>
            <form action="" method="post" role="form" class="form-horizontal col-md-7">


                <div class="form-group">
                    <label class="col-md-4">Senha Atual</label>
                    <div class="col-md-8">
                        
                        <?php echo $this->Form->input('Usuario.atual', array('type' => 'password', 'class' => 'form-control', 'label' => false, 'div' => false)) ?>
                    </div>
                </div> <!-- /.form-group -->



                <div class="form-group">
                    <label class="col-md-4">Nova Senha</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->input('Usuario.senha', array('type' => 'password', 'class' => 'form-control', 'label' => false, 'div' => false)) ?>
                    </div>
                </div> <!-- /.form-group -->



                <div class="form-group">
                    <label class="col-md-4">Confirmar Nova Senha</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->input('Usuario.confirma', array('type' => 'password', 'class' => 'form-control', 'label' => false, 'div' => false)) ?>
                    </div>
                </div> <!-- /.form-group -->
                
                
                <div class="form-group">

                    <div class="col-md-offset-4 col-md-8">

                        <input type="submit" class="btn btn-default" value="Alterar" />
                    </div>



                </div> <!-- /.form-group -->


                <div class="form-group">

                    <div class="col-md-offset-4 col-md-8">

                        <?php echo $this->session->flash('confirma'); ?>
                    </div>


                </div> <!-- /.form-group -->
            </form>


        </div> <!-- /.widget-content -->


    </div> <!-- /.widget -->

</div> <