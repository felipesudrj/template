<?php $this->start('script');?>
<script>
    
  function habilitarSenha(){
       
        $('#nsenha').attr('disabled',false);
        $('#nsenha').val('');
  }
      

<?php if(empty($this->request->data['Usuario']['senha'])){?>
    habilitarSenha();
<?php }?>

</script>
<?php $this->end();?>

<?php if($this->Session->flash('confirma')){?>
    <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <strong>Cadastro realizado!</strong> Cadastro realizado com sucesso.
            </div>
<?php } ?>


<?php if($this->Session->flash('atencao')){?>
            <div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <strong>Atenção!</strong> 
              <?php  foreach ($erros as $ind=>$msg){?>
              <p><?php echo $msg['0'];?></p>
              <?php }?>
            </div>

            
<?php } ?>


<div class="col-md-12">

    <div class="widget stacked">

        <div class="widget-header">
            <i class="icon-tasks"></i>
            <h3>Cadastro de funcionário</h3>
        </div> <!-- /.widget-header -->


        <div class="widget-content">

            <?php echo $this->Form->create('cadastrar',array("role"=>"form","method"=>"post" ,"class"=>"form-horizontal col-md-7")); ?>
            
                <div class="form-group">
                    <label class="col-md-4">Número Matrícula</label>
                    <div class="col-md-8">
                        <?php echo $this->Form->input('Tecnico.tecnico_id', array('type'=>"hidden", 'label' => false, 'class' => "form-control")); ?>

                        <?php echo $this->Form->input('Tecnico.matricula', array('label' => false, 'class' => "form-control")); ?>

                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">
                    <label class="col-md-4">Nome do Funcionário</label>
                    <div class="col-md-8">
                                     <?php echo $this->Form->input('Tecnico.nome', array('label' => false, 'class' => "form-control", 'error' => array('attributes' => array('class' => 'badge')))); ?>

                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">
                    <label class="col-md-4">Email</label>
                    <div class="col-md-8">
             <?php echo $this->Form->input('Tecnico.email', array('label' => false, 'class' => "form-control")); ?>
                    </div>
                </div> <!-- /.form-group -->






                <div class="form-group">
                    <label class="col-md-4">Celular</label>
                    <div class="col-md-8">
                          
             <?php echo $this->Form->input('Tecnico.celular', array('label' => false, 'class' => "form-control")); ?>

                    </div>
                </div> <!-- /.form-group -->


                 <div class="form-group">
                    <label class="col-md-4">Perfil do usuario</label>
                    <div class="col-md-8">

                            <?php echo $this->Form->input('Usuario.tipo_usuario_id', array('type'=>'select','options'=>$tipoUsuario,'label' => false, 'class' => "form-control")); ?>
           
                    </div>
                </div> <!-- /.form-group -->
                
                 <div class="form-group">
                    <label class="col-md-4">login</label>
                    <div class="col-md-8">

                            <?php echo $this->Form->input('Usuario.login', array('label' => false, 'class' => "form-control")); ?>
           
                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">
                    <label class="col-md-4">Senha de acesso</label>
                    <div class="col-md-8" onclick="habilitarSenha()">

             <?php echo $this->Form->input('Usuario.usuario_id', array('type'=>"hidden",'label' => false, 'class' => "form-control")); ?>
             <?php echo $this->Form->input('Usuario.senha', array('type'=>'password',"disabled"=>true,'label' => false,'id'=>'nsenha','class' => "form-control")); ?>
           
                    </div>
                </div> <!-- /.form-group -->


                <div class="form-group">
                    <label class="col-md-4">Outras informações</label>
                    <div class="col-md-8">
                     <?php echo $this->Form->textarea('Tecnico.informacoes', array('label' => false, 'class' => "form-control","rows"=>"4")); ?>

                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">

                    <div class="col-md-offset-4 col-md-8">
                        <?php echo $this->Form->submit('Salvar',array("class"=>"btn btn-default"));?>
                    </div>

                </div> <!-- /.form-group -->

            </form>


        </div> <!-- /.widget-content -->


    </div> <!-- /.widget -->

</div> <!-- /.col-md-12 -->