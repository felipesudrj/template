<?php
$this->start('css');
echo $this->Html->css('pages/plans.css');
?>

<?php $this->end(); ?>




<div class="col-md-12" style="margin-top: 2.5em;">

    <div class="widget stacked">

        <div class="widget-header">
            <i class="icon-tasks"></i>
            <h3>Dados do usuário</h3>
        </div> <!-- /.widget-header -->


        <div class="widget-content">

            <?php //echo $this->Form->create('Usuario',array('method'=>'post','class'=>'form-horizontal col-md-7','url'=>array('controller'=>'Usuario','action'=>'index'))); ?>
            <form action="" method="post" role="form" class="form-horizontal col-md-7">


                <div class="form-group">
                    <label class="col-md-4">Login</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->input('Usuario.usuario_id', array('type' => 'hidden', 'class' => 'form-control', 'label' => false, 'div' => false)) ?>

                        <?php echo $this->Form->input('Usuario.login', array('disabled' => true, 'class' => 'form-control', 'label' => false, 'div' => false)) ?>
                    </div>
                </div> <!-- /.form-group -->



                <div class="form-group">
                    <label class="col-md-4">Nome</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->input('Usuario.nome', array('class' => 'form-control', 'label' => false, 'div' => false)) ?>
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

</div> <!-- /.col-md-12 -->