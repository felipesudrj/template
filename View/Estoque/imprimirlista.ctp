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
        <h1 style="text-align: center;">Relatório de itens retirados</h1>
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td class="col-md-2">Nome do técnico</td>
                    <td><?php echo $tecnico;?></td>
                    <td class="col-md-2">Data retirada</td>
                    <td><?php echo date('d/m/Y');?></td>
                    <td class="col-md-2">Protocolo</td>
                    <td><?php echo $protocolo;?></td>
                </tr>
            </thead>
          
        </table>

        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Cod. Material</th>
                    <th>Modelo</th>
                    <th>Quantidade</th>
                    <th>Informações</th>

                </tr>
            </thead>
            <tbody>
                <?php if (empty($itens)) { ?>
                    <tr>
                        <td colspan="5">Nenhum item cadastrado</td>

                    </tr>

                <?php } else { ?> 
                    <?php foreach ($itens as $indice => $mat) { ?>
                        <tr>
                            <td><?php echo $indice; ?></td>
                            <td><?php echo $mat['descricao']; ?></td>
                            <td><?php echo $mat['quantidade']; ?></td>
                            <td><?php echo $mat['informacoes']; ?></td>

                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>

        <div class="col-md-12">

            <div class="col-md-6 pull-right">
                __________________________________________
                <br> Assinatura do técnico
            </div>

        </div>
    </body>
</html>