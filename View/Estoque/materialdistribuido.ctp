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
			
			<div class="widget stacked ">

            <div class="widget-header">
              <i class="icon-filter"></i>
              <h3>Filtrar</h3>
            </div> <!-- /.widget-header -->

			 <div class="widget-content">
				
				<form action="/" role="form" class="form-horizontal col-md-7">


						<div class="form-group">
							<label class="col-md-4">Nome do material</label>
							<div class="col-md-8">
								<input type="text" name="material.nome" value="" class="form-control" />
							</div>
						</div> <!-- /.form-group -->
						
						<div class="form-group">
							<label class="col-md-4">Nome do Técnico</label>
							<div class="col-md-8">
								<input type="text" name="material.nome" value="" class="form-control" />
							</div>
						</div> <!-- /.form-group -->
						
						<div class="form-group">
							
							<div class="col-md-8">
								<input type="submit" name="input1" value="Buscar" class="btn btn-success" />
							</div>
						</div> <!-- /.form-group -->
						</form>
			
			 </div>
			</div>
			
			
			
      		<div class="widget stacked ">

            <div class="widget-header">
              <i class="icon-list"></i>
              <h3>Relatório de materiais</h3>
            </div> <!-- /.widget-header -->

			 <div class="widget-content">
					
					
					<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped">
					        <thead>
					          <tr>
							  <th>Nome do Tecnico</th>
					            <th>Nome do material</th>
								
					            <th>Quantidade total em estoque</th>
					            <th>Quantidade com o técnico</th>
							
					            
								<th>Ações</th>
					          </tr>
					        </thead>
					        <tbody>
					        <?php foreach($tecnicos as $indice=>$valor){ ?>
							<tr>
							<td><?php echo $valor['Tecnico']['matricula'];?></td>
							<td><?php echo $valor['Tecnico']['matricula'];?></td>
							<td><?php echo $valor['Tecnico']['nome'];?></td>
							<td><?php echo $valor['Tecnico']['celular'];?></td>
							
							
							<td>
								<a href="/tecnico/cadastrar/<?php echo $valor['Usuario']['usuario_id'];?>" class="label label-success"><i class="icon-search"></i> Editar</a>
								<a href="/tecnico/excluir/<?php echo $valor['Usuario']['usuario_id'];?>" class="label label-danger"><i class="icon-remove"></i> Excluir</a>
								
							</td>
							</tr>
							<?php } ?>
							<tr>
							<td><?php echo $valor['Tecnico']['matricula'];?></td>
							<td>88899</td>
							<td>Felipe Oliveira</td>
							<td>47-33553322</td>
							
							
							<td>
								<a href="/tecnico/cadastrar/ID" class="label label-success"><i class="icon-search"></i> Editar</a>
								<a href="/tecnico/excluir/ID" class="label label-danger"><i class="icon-remove"></i> Excluir</a>
							</td>
							</tr>
					        </tbody>
					      </table>
					  </div> <!-- /.table-responsive -->
			
					
					
				</div> <!-- /widget-content -->
					
			</div> <!-- /widget -->
      		
	   
