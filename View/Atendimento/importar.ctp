<?php 
$msg = $this->Session->flash('confirma');
if($msg){?>
		<div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Perfeito!</strong> arquivo importado com sucesso. <a href="/atendimento/listar" class="alert-link">Visualizar lista.</a>
              <br><?php echo $msg;?> arquivos foram importados.
            </div>
<?php }?>

			
<?php 
$msg = $this->Session->flash('negar');
if($msg){?>			
	<div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>Erro!</strong> O arquivo não pode ser importado, tente novamente.
              <br><?php echo $msg;?>
            </div>
<?php }?>

<div class="row">

      	<div class="col-md-12">

		
		
      		<div class="widget stacked">

      			<div class="widget-header">
					<i class="icon-tasks"></i>
					<h3>Importação de arquivo</h3>
				</div> <!-- /.widget-header -->


				<div class="widget-content">

					<form action="/atendimento/importar" role="form" class="col-md-5" method="post" enctype="multipart/form-data">


						<div class="form-group">
							<label>Selecione o arquivo</label>
							<input type="file" name="data[Atendimento][file]" value="" class="form-control" />
						</div> <!-- /.form-group -->

						
						<div class="form-group ">

				            <label>Tipo de serviço</label>

				            <select id="select2" name="data[Atendimento][tipo_id]" class="form-control">
				                <option value="1">Rota diaria</option>
				                <option value="2">BackLog</option>
				                
				            </select>
				          </div> <!-- /.form-group -->

				        
							<div class="form-group">
								<button type="submit" class="btn btn-default">Enviar</button>

							</div> <!-- /.form-group -->

					</form>


				</div> <!-- /.widget-content -->


      		</div> <!-- /.widget -->

      	</div> <!-- /.col-md-12 -->


      </div>