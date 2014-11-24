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
                    <h1 style="text-align: center;">Relatório de atendimentos</h1>
                </div>


                <div class="row ">
                    <table class="table " style="font-size:12px; width:400px;" >


                        <tr>
                            <td class="col-md-3">Total registros encontrados</td>
                            <td class=""><?php echo $total; ?></td>

                        </tr>


                    </table>
                </div>

                <div class="row corpo col-lg-16" >




                    <table class="table table-bordered " style="font-size:12px;">

                        <thead>
                            <tr>
                                <th>N. Ordem de serviço</th>
                                <th>N. Contrato</th>
                                <th>Data de Agendamento</th>
                                <th>Data de Execução</th>
                                <th>Nome do técnico</th>
                                <th>Tipo de serviço</th>
                                <th>Status de atendimento</th>
                                <th>N. Rat</th>
                                <th>Itens Rat</th>
                                <th>Observações do atendimento técnico</th>
                                <th>Observações de finalização</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php foreach ($atendimentos as $indice => $valor) { ?>
                                <tr>
                                    <td><?php echo $valor['Atendimento']['nros']; ?></td>
                                    <td><?php echo $valor['Atendimento']['nrcontrato']; ?></td>
                                    <td><?php echo $valor['Agendamento']['data_agendamento']; ?></td>
                                    <td><?php echo $valor['Agendamento']['data_agendamento']; ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>

            </div>
    </body>
</html>
