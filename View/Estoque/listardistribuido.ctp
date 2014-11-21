<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap Elements :: Base Admin</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">    
    
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/bootstrap-responsive.min.css" rel="stylesheet">
    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="./css/font-awesome.min.css" rel="stylesheet">
    
    <link href="./css/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet">
    
    <link href="./css/base-admin-3.css" rel="stylesheet">
    <link href="./css/base-admin-3-responsive.css" rel="stylesheet">

    <link href="./css/custom.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <style>

    .btn {
    	margin: 0 .25em .5em;
    }

    .btn-group {
    	margin: 0 .25em .5em;
    }

    .btn-group .btn {
    	margin: 0;
    }

    </style>
  </head>

<body>

<nav class="navbar navbar-inverse" role="navigation">

  <div class="container">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <i class="icon-cog"></i>
    </button>
    <a class="navbar-brand" href="./index.html">Base Admin 3.0</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
            
      <a href="javscript:;" class="dropdown-toggle" data-toggle="dropdown">
        <i class="icon-cog"></i>
        Settings
        <b class="caret"></b>
      </a>
      
      <ul class="dropdown-menu">
        <li><a href="./account.html">Account Settings</a></li>
        <li><a href="javascript:;">Privacy Settings</a></li>
        <li class="divider"></li>
        <li><a href="javascript:;">Help</a></li>
      </ul>
      
    </li>

    <li class="dropdown">
            
      <a href="javscript:;" class="dropdown-toggle" data-toggle="dropdown">
        <i class="icon-user"></i> 
        Rod Howard
        <b class="caret"></b>
      </a>
      
      <ul class="dropdown-menu">
        <li><a href="javascript:;">My Profile</a></li>
        <li><a href="javascript:;">My Groups</a></li>
        <li class="divider"></li>
        <li><a href="javascript:;">Logout</a></li>
      </ul>
      
    </li>
    </ul>
    
    <form class="navbar-form navbar-right" role="search">
      <div class="form-group">
        <input type="text" class="form-control input-sm search-query" placeholder="Search">
      </div>
    </form>
  </div><!-- /.navbar-collapse -->
</div> <!-- /.container -->
</nav>
    



    
<div class="subnavbar">

  <div class="subnavbar-inner">
  
    <div class="container">
      
      <a href="javascript:;" class="subnav-toggle" data-toggle="collapse" data-target=".subnav-collapse">
          <span class="sr-only">Toggle navigation</span>
          <i class="icon-reorder"></i>
          
        </a>

      <div class="collapse subnav-collapse">
        <ul class="mainnav">
        
          <li class="">
            <a href="./index.html">
              <i class="icon-home"></i>
              <span>Home</span>
            </a>              
          </li>
          
          <li class="dropdown active">         
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
              <i class="icon-th"></i>
              <span>Components</span>
              <b class="caret"></b>
            </a>      
          
            <ul class="dropdown-menu">
              <li><a href="./elements.html">Elements</a></li>
              <li><a href="./forms.html">Form Styles</a></li>
              <li><a href="./jqueryui.html">jQuery UI</a></li>
              <li><a href="./charts.html">Charts</a></li>
              <li><a href="./popups.html">Popups/Notifications</a></li>
            </ul>         
          </li>
          
          <li class="dropdown">         
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
              <i class="icon-copy"></i>
              <span>Sample Pages</span>
              <b class="caret"></b>
            </a>      
          
            <ul class="dropdown-menu">
              <li><a href="./pricing.html">Pricing Plans</a></li>
              <li><a href="./faq.html">FAQ's</a></li>
              <li><a href="./gallery.html">Gallery</a></li>
              <li><a href="./reports.html">Reports</a></li>
              <li><a href="./account.html">User Account</a></li>
            </ul>         
          </li>
          
          <li class="dropdown">         
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
              <i class="icon-external-link"></i>
              <span>Extra Pages</span>
              <b class="caret"></b>
            </a>  
          
            <ul class="dropdown-menu">
              <li><a href="./login.html">Login</a></li>
              <li><a href="./signup.html">Signup</a></li>
              <li><a href="./error.html">Error</a></li>
              <li class="dropdown-submenu">
                  <a tabindex="-1" href="#">More options</a>
                  <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="#">Second level</a></li>

                    <li><a href="#">Second level</a></li>
                    <li><a href="#">Second level</a></li>
                  </ul>
                </li>
            </ul>           
          </li>
        
        </ul>
      </div> <!-- /.subnav-collapse -->

    </div> <!-- /container -->
  
  </div> <!-- /subnavbar-inner -->

</div> <!-- /subnavbar -->
    
    

<div class="main">

    <div class="container">


      <div class="row">
      	
      	<div class="col-md-12">      		
      		
			
			
			<div class="widget stacked ">

            <div class="widget-header">
              <i class="icon-filter"></i>
              <h3>Filtrar</h3>
            </div> <!-- /.widget-header -->

			 <div class="widget-content">
				
				<div class="form-horizontal col-md-7">
				
				 <?php echo $this->FilterForm->create(); ?>

						<div class="form-group">
							<label class="col-md-4">Numero protocolo</label>
							<div class="col-md-8">
							<?php echo $this->FilterForm->input('protocolo',array('class'=>'form-control'); ?>
							</div>
						</div> <!-- /.form-group -->
						
						<div class="form-group">
							<label class="col-md-4">Data de retirada </label>
							<div class="col-md-8">
								<?php echo $this->FilterForm->input('data_retirada',array('class'=>'datepicker form-control'); ?>
							</div>
						</div> <!-- /.form-group -->
						
						<div class="form-group">
							<label class="col-md-4">Nome do Técnico</label>
							<div class="col-md-8">
								<?php echo $this->FilterForm->input('tecnico_id',array('class'=>'form-control'); ?>
							</div>
						</div> <!-- /.form-group -->
						
						<div class="form-group">
							
							<div class="col-md-8">
									<?php echo $this->FilterForm->submit('Filtrar', array('class' => 'btn btn-success')); ?>
						</div>
						</div> <!-- /.form-group -->
				</div>
			
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
								<th>N. Protocolo</th>
								<th>Nome Técnico</th>
								<th>Quantidade Itens</th>
								<th>Data de retirada</th>
								<th>Ações</th>
					        </tr>
					        </thead>
					        <tbody>
					        <?php foreach($protocolos as $indice=>$valor){ ?>
							<tr>
							<td><?php echo $protocolos['MaterialDistribuido']['protocolo']; ?></td>
							<td><?php echo $protocolos['Tecnico']['nome']; ?></td>
							<td><?php echo $protocolos['MaterialDistribuido']['QuantidadeItens']; ?></td>
							<td><?php echo $protocolos['MaterialDistribuido']['data_retirada']; ?></td>
							
							
							<td>
								
								<a href="/estoque/imprimirlista/<?php echo  $protocolos['MaterialDistribuido']['protocolo'];?>" class="label label-danger" target="new"><i class="icon-search"></i> Ver relatório completo</a>
								
							</td>
							</tr>
							<?php } ?>
							
					        </tbody>
					      </table>
					  </div> <!-- /.table-responsive -->
			
					
					
				</div> <!-- /widget-content -->
					
			</div> <!-- /widget -->
      		
	    </div> <!-- /span12 -->
      	
      </div> <!-- /row -->

    </div> <!-- /container -->
    
</div> <!-- /main -->
    
<div id="visualizar" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Informações do funcionário</h4>
      </div>
      <div class="modal-body" id="visualizaFuncionario">
         <p><strong>Matrícula:</strong> 888777</p>
		 <p><strong>Nome:</strong> Felipe Oliveira</p>
		 <p><strong>Telefone:</strong> 888777</p>
		 <p><strong>Celular:</strong> 888777</p>
		 <p><strong>Email:</strong> 888777</p>
		 <p><strong>Observações:</strong> testaiuoi adua oisdua siod uasoidu asoidu aoiduiiuouiouoiasdoui uioa sdiasd oa uisdi oa dsoia sdouiau oisd</p>
      </div>

     </div>
    </div>
   </div>    
    
 
<div class="extra">

	<div class="container">

		<div class="row">
			
			<div class="col-md-3">
				
				<h4>About</h4>
				
				<ul>
					<li><a href="javascript:;">About Us</a></li>
					<li><a href="javascript:;">Twitter</a></li>
					<li><a href="javascript:;">Facebook</a></li>
					<li><a href="javascript:;">Google+</a></li>
				</ul>
				
			</div> <!-- /span3 -->
			
			<div class="col-md-3">
				
				<h4>Support</h4>
				
				<ul>
					<li><a href="javascript:;">Frequently Asked Questions</a></li>
					<li><a href="javascript:;">Ask a Question</a></li>
					<li><a href="javascript:;">Video Tutorial</a></li>
					<li><a href="javascript:;">Feedback</a></li>
				</ul>
				
			</div> <!-- /span3 -->
			
			<div class="col-md-3">
				
				<h4>Legal</h4>
				
				<ul>
					<li><a href="javascript:;">License</a></li>
					<li><a href="javascript:;">Terms of Use</a></li>
					<li><a href="javascript:;">Privacy Policy</a></li>
					<li><a href="javascript:;">Security</a></li>
				</ul>
				
			</div> <!-- /span3 -->
			
			<div class="col-md-3">
				
				<h4>Settings</h4>
				
				<ul>
					<li><a href="javascript:;">Consectetur adipisicing</a></li>
					<li><a href="javascript:;">Eiusmod tempor </a></li>
					<li><a href="javascript:;">Fugiat nulla pariatur</a></li>
					<li><a href="javascript:;">Officia deserunt</a></li>
				</ul>
				
			</div> <!-- /span3 -->
			
		</div> <!-- /row -->

	</div> <!-- /container -->

</div> <!-- /extra -->


    
    
<div class="footer">
		
	<div class="container">
		
		<div class="row">
			
			<div id="footer-copyright" class="col-md-6">
				&copy; 2012-13 Jumpstart UI.
			</div> <!-- /span6 -->
			
			<div id="footer-terms" class="col-md-6">
				Theme by <a href="http://jumpstartui.com" target="_blank">Jumpstart UI</a>
			</div> <!-- /.span6 -->
			
		</div> <!-- /row -->
		
	</div> <!-- /container -->
	
</div> <!-- /footer -->
    


<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="./js/libs/jquery-1.9.1.min.js"></script>
<script src="./js/libs/jquery-ui-1.10.0.custom.min.js"></script>
<script src="./js/libs/bootstrap.min.js"></script>

<script src="./js/Application.js"></script>

<script>
function getFuncionario(id){
		
		$.ajax({
			url:"cadastro-funcionario.html",
			type:'post',
			data:{id:id},
			success:function(result){ 
				$('#visualizaFuncionario').html('corpo do ajax');
									},
			error:function(){
				$('#visualizaFuncionario').html('Ocorreu um erro de leitura de código');
				}
			}
			);
		

}
</script>

  </body>
</html>
