

	 <div class="row">
	  
     	
      	<div class="col-md-6 col-xs-12">
      		
				
			<div class="widget stacked">
					
				<div class="widget-header">
					<i class="icon-bookmark"></i>
					<h3>Quick Shortcuts</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					<div class="shortcuts">
						<a href="/atendimento/importar" class="shortcut">
							<i class="shortcut-icon icon-upload"></i>
							<span class="shortcut-label">Importar Ordem de serviço</span>
						</a>
						
						<a href="/atendimento/listar/Wm1sc2RHVnlMbTV5YjNNPQ==:/Wm1sc2RHVnlMblJwY0c5VFpYSjJhV052:/Wm1sc2RHVnlMbTV2YldWRGJHbGxiblJs:/Wm1sc2RHVnlMblJsWTI1cFkyOD0=:/Wm1sc2RHVnlMbk4wWVhSMWMwRjBaVzVrYVcxbGJuUnY=:TVE9PQ%3D%3D" class="shortcut">
							<i class="shortcut-icon icon-calendar"></i>
							<span class="shortcut-label">Agendar Atendimento</span>								
						</a>
						
						
						
						<a href="/atendimento/listar/Wm1sc2RHVnlMbTV5YjNNPQ==:/Wm1sc2RHVnlMblJwY0c5VFpYSjJhV052:/Wm1sc2RHVnlMbTV2YldWRGJHbGxiblJs:/Wm1sc2RHVnlMblJsWTI1cFkyOD0=:/Wm1sc2RHVnlMbk4wWVhSMWMwRjBaVzVrYVcxbGJuUnY=:TWc9PQ%3D%3D" class="shortcut">
							<i class="shortcut-icon icon-external-link"></i>
							<span class="shortcut-label">Atribuir Serviços aos técnicos</span>								
						</a>
						
						<a href="/relatorio/atendimento" class="shortcut">
							<i class="shortcut-icon icon-signal"></i>
							<span class="shortcut-label">Relatórios de atendimento</span>	
						</a>
						
						<a href="/estoque/distribuir" class="shortcut">
							<i class="shortcut-icon icon-user"></i>
							<span class="shortcut-label">Distribuição de Material</span>
						</a>
						
						<a href="/estoque/cadastrarmaterial" class="shortcut">
							<i class="shortcut-icon icon-file"></i>
							<span class="shortcut-label">Cadastrar Equipamentos</span>	
						</a>
						
						<a href="/estoque/listarmaterial" class="shortcut">
							<i class="shortcut-icon icon-tasks"></i>
							<span class="shortcut-label">Controle de estoque</span>	
						</a>
						
						<a href="javascript:;" class="shortcut">
							<i class="shortcut-icon icon-cog"></i>
							<span class="shortcut-label">Configurações da conta</span>
						</a>				
					</div> <!-- /shortcuts -->	
				
				</div> <!-- /widget-content -->
				
			</div> <!-- /widget -->
      		
					
										
		
	    </div> <!-- /span6 -->
      	
      	
      	<div class="col-md-6">	
      		
      		
      		
      		
					
					
				
					
					
					
			<div class="widget stacked widget-table action-table">
					
				<div class="widget-header">
					<i class="icon-th-list"></i>
					<h3>Ordem de serviço</h3>
				</div> <!-- /widget-header -->
				
				<div class="widget-content">
					
					 <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Número OS</th>
                            <th>Serviço</th>
                            <th>Status</th>
                            <th>Data de agendamento</th>
                            <th class="td-actions"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($atendimento as $indice => $valor) { ?>
                            <tr>
                                <td><?php echo $valor['Atendimento']['nros'];?></td>
                                <td><?php echo $valor['TipoServico']['descricao'];?></td>
                                 <td><?php echo $valor['StatusAtendimento']['descricao'];?></td>
                                   <td><?php echo $valor['Agendamento']['data_agendamento'];?></td>
                                <td class="td-actions">
                                    <a href="/atendimento/alterar/<?php echo $valor['Atendimento']['atendimento_id'];?>#dadosos" class="btn btn-xs btn-primary">
                                        <i class="btn-icon-only icon-search">VER</i>										
                                    </a>

                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                    <footer>
                        <tr>
                            <td colspan="5"><a href="/atendimento/listar"><span class="pull-right badge badge-important">Ver todos</span></a></td>
                        </tr>
                    </footer>
                </table>
					
				</div> <!-- /widget-content -->
			
			</div> <!-- /widget -->
								
	      </div> <!-- /span6 -->
      	
      </div> <!-- /row -->


    
