	

			<?php 
			$msg = $this->Session->flash('confirmar'); if($msg){?>
			<div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <strong>OK:</strong> <?php echo $msg;?>.
            </div>
			<?php } ?>
			
			
			
			<?php 
			$msg = $this->Session->flash('negar'); if($msg){?>
			<div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <strong>Erro:</strong> <?php echo $msg;?>.
            </div>
			<?php } ?>
		


      		<div class="widget stacked">

      			<div class="widget-header">
					<i class="icon-tasks"></i>
					<h3>Cadastro de material</h3>
				</div> <!-- /.widget-header -->


				<div class="widget-content">

                                   
                                    
                            <?php echo $this->Form->create(array('class'=>'form-horizontal col-md-7','method'=>'post'))?>
						<div class="form-group">
							<label class="col-md-4">Nome do material</label>
							<div class="col-md-8">
                                                            <?php echo $this->Form->input('Material.material_id',array('type'=>'hidden'));?>

                                                            <?php echo $this->Form->input('Material.descricao',array('class'=>'form-control','label'=>false));?>
							</div>
						</div> <!-- /.form-group -->
						
						<div class="form-group">
							<label class="col-md-4">Unidade de Medida</label>
							<div class="col-md-8">
                                                            <?php echo $this->Form->input('Material.unidade_medida_id',array('type'=>'select','options'=>$UnidadeMedidas,'empty'=>"Selecione uma unidade",'class'=>'form-control','label'=>false));?>

                                                        </div>
						</div> <!-- /.form-group -->

					
						
						
						<div class="form-group">
							<label class="col-md-4">Outras informações</label>
							<div class="col-md-8">
								<?php echo $this->Form->input('Material.informacoes',array('type'=>'textarea',  'class'=>'form-control','label'=>false));?>

							</div>
						</div> <!-- /.form-group -->
						
						
							<div class="form-group">

								<div class="col-md-offset-4 col-md-8">
                                                                    <?php echo $this->Form->submit('Gravar',array("class"=>"btn btn-default"));?>
								
								</div>

							</div> <!-- /.form-group -->

					</form>


				</div> <!-- /.widget-content -->


      		</div> <!-- /.widget -->

    
