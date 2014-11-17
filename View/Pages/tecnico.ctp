<?php $this->start('script');?>
<script src="/js/demo/sliders.js"></script>
<?php $this->end();?>
<div class="row">
      	
     
      	
      	<div class="col-md-12 col-xs-12">	
      		
      		
      		
      		
					
					
			<div class="widget stacked">
			<form action="" method="post">
			
				<div class="widget-header">
					<i class="icon-filter"></i>
					<h3>Filtro</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content ">
					

				
				
				<div class="col-md-3">
				
					<div class="form-group">
							<label>Número de OS</label>
							<input type="text" name="data[Atendimento][numero]" value="" class="form-control">
					</div>
				
					<div class="form-group ">

				            <label>Tipo de serviço</label>

				            <select id="select2" name="data[Atendimento][tipo_id]" class="form-control">
				                <option value="">Todos</option>
				                <option value="1">Instalação</option>
				                <option value="2">Retirada</option>
				                <option value="3">Manutenção</option>
				               
				            </select>
					</div>
					
					
					
					
					<div class="form-group ">

				            <label>Status serviço</label>

				            <select id="select2" name="data[Atendimento][status_id]" class="form-control">
				                <option value="">Todos</option>
				                <option value="1">Aguardando atendimento</option>
				                <option value="2">Finalizado</option>
				               
				            </select>
					</div>
					
					
				</div>

				<div class="col-md-4 ">
				<label>Selecione uma data</label>
				<div id="datepicker-inline"></div>
				</div>
				<!--INCLUIR OBSERVACOES-->
				<div class="col-md-3 ">
					
				<div class="form-group" style="margin-top:30px;">
				
					<button type="submit" class="btn btn-success">Filtrar</button>

				</div>
				</div>
			</div>
			</form>						
			</div> <!-- /widget -->	
			
			
			<div class="widget stacked widget-table action-table">
					
				<div class="widget-header">
					<i class="icon-th-list"></i>
					<h3>Ordem de serviço - Data 07/11/2014</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Número OS</th>
								<th>Serviço</th>
								<th>Endereço</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>4458847</td>
								<td>Instalação</td>
								<td>R. Angelo dias 276, Velha Blumenau SC</td>
								<td>Agendado</td>
								<td class="td-actions">
									<a href="/atendimento/visualizar/numeroOS" class="btn btn-xs btn-primary">
										<i class="btn-icon-only icon-search"></i>										
									</a>
									
									<a href="/atendimento/rat/numeroOS" class="btn btn-xs btn-success">
										<i class="btn-icon-only icon-ok"></i>										
									</a>
								</td>
							</tr>
							
							
							</tbody>
							<footer>
							<tr>
							<td colspan="5">
							
							
            
          <ul class="pagination">
         
            <li class="active"><a href="#">1</a></li>
            <li><a href="javascript:;">2</a></li>
            <li><a href="javascript:;">3</a></li>
            <li><a href="javascript:;">4</a></li>
            <li><a href="javascript:;">5</a></li>
           
          </ul>

                            
           							
							</td>
							</tr>
							</footer>
						</table>
					
				</div> <!-- /widget-content -->
			
			</div> <!-- /widget -->
										
					
					
			
	      </div> <!-- /span6 -->
      	
      </div> <!-- /row -->