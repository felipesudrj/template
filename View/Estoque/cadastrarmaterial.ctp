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

					<form action="/tecnico/cadastrar" role="form"  method="post" class="form-horizontal col-md-7">

						<div class="form-group">
							<label class="col-md-4">Nome do material</label>
							<div class="col-md-8">
								<input type="text" name="Material.nome" required="true" value="" value="" class="form-control" />
							</div>
						</div> <!-- /.form-group -->
						
						<div class="form-group">
							<label class="col-md-4">Unidade de Medida</label>
							<div class="col-md-8">
								<input type="select" name="Material.unidade_medida_id" required="true" value="" value="" class="form-control" />
							</div>
						</div> <!-- /.form-group -->

						<div class="form-group">
							<label class="col-md-4">Quantidade disponível</label>
							<div class="col-md-8">
									<input type="select" name="Material.quantidade" required="true" value="" value="" class="form-control" />

							</div>
						</div> <!-- /.form-group -->
						
						
						<div class="form-group">
							<label class="col-md-4">Outras informações</label>
							<div class="col-md-8">
								<textarea class="form-control" name="message" id="message" rows="4">
								</textarea>
							</div>
						</div> <!-- /.form-group -->
						
						
							<div class="form-group">

								<div class="col-md-offset-4 col-md-8">

									<button type="submit" class="btn btn-default">Gravar</button>
								</div>

							</div> <!-- /.form-group -->

					</form>


				</div> <!-- /.widget-content -->


      		</div> <!-- /.widget -->
