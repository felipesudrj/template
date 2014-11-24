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
        <div class="container">
            <div class="col-md-16">


                <div class="row titulo">
        <h1 style="text-align: center;">Relatório de equipamentos - Controle de estoque técnico</h1>
                </div>

                <?php if($equipamentos){ ?>
                <div class="row ">
                    <table class="table table-bordered" style="font-size:12px; width:500px;" >

                        <tr>
                            <td class="col-md-4">Nome do técnico</td>
                            <td class=""><?php echo $equipamentos['0']['Tecnico']['nome'];  ?></td>
                            <td class="col-md-2">Matrícula</td>
                            <td class=""><?php echo $equipamentos['0']['Tecnico']['matricula'];  ?></td>
                        </tr>




                    </table>
                </div>

                <div class="row corpo col-md-12" >




                    <table class="table table-bordered " style="font-size:12px;">

                        <thead>
                            <tr>
                                <th>Cod. material</th>
                                <th>Nome do material</th>

                                <th>Quantidade de material retirado</th>
                                <th>Quantidade de material utilizado</th>
                                <th>Estoque atual do técnico</th>
                                <th>Data da última retirada</th>

                            </tr>
                        </thead>


                        <tbody>
                           <?php 
                           $total = 0;
                           foreach ($equipamentos as $indice=>$valor){ $total++;?>
                            <tr>
                                <td><?php echo $valor['MaterialDistribuido']['material_id'];?></td>
                                <td><?php echo $valor['Material']['descricao'];?></td>
                                <td><?php echo $valor['MaterialDistribuido']['TotalDistribuido'];?></td>
                                <td><?php echo $valor['MaterialDistribuido']['TotalMaterial'];?></td>
                                <td><?php echo $valor['MaterialDistribuido']['TotalDistribuido'] - $valor['MaterialDistribuido']['TotalMaterial'];?></td>
                                <td><?php echo date('d/m/Y',  strtotime($valor['MaterialDistribuido']['data_retirada']))    ;?></td>
                            </tr>
                           <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan='6'>
                                    Total itens: <span class="badge"><?php echo $total; ?></span>
                                </td>
                            </tr>
                        </tfoot>

                    </table>
                </div>
                <?php }else{?>
                Nenhuma informação encontrada
                <?php }?>
            </div>
    </body>
</html>
