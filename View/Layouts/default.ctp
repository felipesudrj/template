<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Dashboard :: área restrita</title>
        <?php
        echo $this->Html->css(
                array('bootstrap.min.css', 'bootstrap-responsive.min.css'));
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">    
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

        <?php
        echo $this->Html->css(
                array('font-awesome.min.css', 'ui-lightness/jquery-ui-1.10.0.custom.min.css',
                    'base-admin-3.css', 'base-admin-3-responsive.css', 'jquery-ui'
        ));
        ?>

<?php echo $this->fetch('css'); ?>

        <link href="/css/custom.css" rel="stylesheet">

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>




    <body>
        <nav class="navbar navbar-inverse" role="navigation">

            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Navegação</span>
                        <i class="icon-cog"></i>
                    </button>
                    <a class="navbar-brand" href="/">Área restrita</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">

                            <a href="javscript:;" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-user"></i> 
                                Bem vindo   <?php echo ucfirst($this->Session->read('Auth.User.nome')); ?>

                                <b class="caret"></b>
                            </a>

                            <ul class="dropdown-menu">
                                <li><a href="/usuario/">Minha Conta</a></li>
                                <li><a href="/usuario/senha">Alterar senha</a></li>
                                <li class="divider"></li>
                                <li><a href="/pages/sair">Logout</a></li>
                            </ul>

                        </li>
                    </ul>

                </div><!-- /.navbar-collapse -->
            </div> <!-- /.container -->
        </nav>

<?php if ($this->Session->read('Auth.User.tipo_usuario_id') == 1) { ?>
            <div class="subnavbar">

                <div class="subnavbar-inner">

                    <div class="container">

                        <a href="javascript:;" class="subnav-toggle" data-toggle="collapse" data-target=".subnav-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <i class="icon-reorder"></i>

                        </a>

                        <div class="collapse subnav-collapse">
                            <ul class="mainnav">

                                <li class="active">
                                    <a href="/">
                                        <i class="icon-home"></i>
                                        <span>Home</span>
                                    </a>	    				
                                </li>

                                <li class="dropdown">					
                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-th"></i>
                                        <span>Atendimento</span>
                                        <b class="caret"></b>
                                    </a>	    

                                    <ul class="dropdown-menu">
                                        <li><a href="/atendimento/importar">Importar ordem de serviço</a></li>
                                        <li><a href="/atendimento/listar">Agendar Atendimento</a></li>
                                        <li><a href="/atendimento/listar">Atribuir serviço aos técnicos</a></li>
                                        <li><a href="/atendimento/listar">Visualizar ordens de serviço</a></li>

                                    </ul> 				
                                </li>

                                <li class="dropdown">					
                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-briefcase"></i>
                                        <span>Estoque</span>
                                        <b class="caret"></b>
                                    </a>	    

                                    <ul class="dropdown-menu">
                                        <li><a href="/estoque/cadastrarmaterial">Cadastrar novo item</a></li>
                                        <li><a href="/estoque/listarmaterial">Listagem de items</a></li>
                                        <li><a href="/estoque/relatorio">Controle de estoque</a></li>

                                    </ul> 				
                                </li>

                                <li class="dropdown">					
                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-user"></i>
                                        <span>Técnicos</span>
                                        <b class="caret"></b>
                                    </a>	

                                    <ul class="dropdown-menu">
                                        <li><a href="/tecnico/listar">Visualizar técnicos</a></li>
                                        <li><a href="/tecnico/cadastrar">Cadastrar novo técnico</a></li>

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


                                <li class="dropdown">					
                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-list"></i>
                                        <span>Relatórios</span>
                                        <b class="caret"></b>
                                    </a>	    

                                    <ul class="dropdown-menu">
                                        <li><a href="/relatorio/atendimento">Relatório de atendimento técnico</a></li>
                                        <li><a href="/atendimento/agendar">Relatório de estoque</a></li>
                                        <li><a href="/relatorio/atendimento">Relatório financeiro</a></li>

                                    </ul> 				
                                </li>

                            </ul>




                        </div> <!-- /.subnav-collapse -->

                    </div> <!-- /container -->


                </div> <!-- /subnavbar-inner -->

            </div> <!-- /subnavbar -->
<?php } ?>




        <div class="main">

            <div class="container">

                <?php if(!empty($breadcrumb)){?>
                <div class="row">
                    <div class="">
                        <ul class="breadcrumb">
                            <li>
                                <a href="">Inicial</a>
                            </li>
                           <?php foreach ($breadcrumb as $link=>$nome){?>
                            <li >
                                <a href="<?php echo $link;?>"><strong><?php echo $nome;?></strong></a>
                            </li>
                           <?php }?>
                        </ul>
                    </div>
                </div>
                <?php } ?>
                
                
                <div class="row" style="min-height: 500px;">
                    <?php echo $this->Session->flash(); ?>

<?php echo $this->fetch('content'); ?>


                </div> <!-- /row -->

            </div> <!-- /container -->

        </div> <!-- /main -->

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
        <script src="/js/libs/jquery-1.9.1.min.js"></script>
        <script src="/js/libs/jquery-ui-1.10.0.custom.min.js"></script>
        <script src="/js/libs/bootstrap.min.js"></script>

        <script src="/js/plugins/flot/jquery.flot.js"></script>
        <script src="/js/plugins/flot/jquery.flot.pie.js"></script>
        <script src="/js/plugins/flot/jquery.flot.resize.js"></script>

        <script src="/js/Application.js"></script>

<?php echo $this->fetch('script'); ?>

    </body>

</html>
