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
            <h1 style="text-align: center;">Relatório de ordem de serviço</h1>
            <div class="col-lg-12">
                <table class="table table-bordered" style="font-size: 13px">
                    <tr>
                        <td>Tipo de serviço: <?php echo strtoupper($atendimento['TipoServico']['descricao']); ?></td>
                        <td colspan="2">Tecnico atribuido:  <?php echo strtoupper($atendimento['Tecnico']['nome']); ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12">
                Dados do Cliente
                <table class="table table-bordered" style="font-size: 13px">
                    <tr>
                        <td>Nome:   <strong><?php echo strtoupper($atendimento['Cliente']['nome']); ?></strong></td>
                        <td>Contrato:   <strong><?php echo strtoupper($atendimento['Atendimento']['nrcontrato']); ?></strong></td>
                        <td>ordem de serviço: <strong><?php echo strtoupper($atendimento['Atendimento']['nros']); ?></strong></td>

                    </tr>

                    <tr>
                        <td colspan="2">Endereço:  
                            <strong><?php echo strtoupper($atendimento['Cliente']['logradouro']); ?></strong> - 
                            <strong><?php echo strtoupper($atendimento['Cliente']['numero']); ?></strong>  - 
                            <strong><?php echo strtoupper($atendimento['Cliente']['bairro']); ?></strong>  -

                        </td>
                        <td >complemento:   
                            <strong><?php echo strtoupper($atendimento['Cliente']['complemento']); ?></strong>  -
                        </td>

                    </tr>

                    <tr>
                        <td>Cidade:  
                            <strong><?php echo strtoupper($atendimento['Cliente']['cidade']); ?></strong>

                        </td>
                        <td>UF:
                            <strong><?php echo strtoupper($atendimento['Cliente']['estado']); ?></strong>

                        </td>
                        <td>Telefone:
                            <strong><?php echo ($atendimento['Cliente']['telefone1'])?$atendimento['Cliente']['telefone1']:""; ?></strong>
                           
                            <strong><?php echo ($atendimento['Cliente']['telefone2'])?" / ".$atendimento['Cliente']['telefone2']:""; ?></strong>
                            
                            <strong><?php echo ($atendimento['Cliente']['telefone3'])?" / ".$atendimento['Cliente']['telefone3']:""; ?></strong>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-12">
                Dados do atendimento
                <table class="table table-bordered" style="font-size: 13px">
                    <tr>
                        <td>Agendamento: <?php echo ($atendimento['Agendamento']['data_agendamento'])?date('d/m/Y',  strtotime($atendimento['Agendamento']['data_agendamento'])):""; ?></td>
                        <td colspan="2">Data de execução: <?php echo ($atendimento['Rat']['data_criacao'])?date('d/m/Y',  strtotime($atendimento['Rat']['data_criacao'])):""; ?></td>
                       
                    </tr>

                    <tr>
                        <td colspan="2">Status do atendimento:  <strong><?php echo strtoupper($atendimento['StatusAtendimento']['descricao']); ?></strong> </td>
                        <td>N. RAT:  <strong><?php echo strtoupper($atendimento['Rat']['numero_rat']); ?></strong> </td>

                    </tr>

                    <tr>
                        <td colspan="3">Observações do atendimento técnico:
                        <strong><?php echo strtoupper($atendimento['Rat']['informacoes']); ?></strong> 
                        </td>
                        
                    </tr>

                    <tr>
                        <td colspan="3">Material Utilizado no atendimento: 
                            <?php foreach ($atendimento['MaterialUtilizado'] as $indice=>$valor){?>
                            <span class="badge">
                            <strong><?php echo $valor['quantidade'];?> - <?php echo $valor['Material']['descricao'];?></strong> 
                            </span>
                                <?php }?>
                        </td>
                                        
                    </tr>
                </table>
            </div>

            <div class="col-lg-12">
                Finalização administrativa da ordem de serviço
                <table class="table table-bordered" style="font-size: 13px">
                    <tr>
                        <td>Informações administrativas: <?php echo strtoupper($atendimento['Atendimento']['observacoes_finaliza']); ?></td>
                        <td colspan="2">Data de finalização:  <?php echo ($atendimento['Atendimento']['data_finaliza'])?date('d/m/Y',  strtotime($atendimento['Atendimento']['data_finaliza'])):""; ?></td>

                    </tr>
                </table>
            </div>

        </div>

    </body>

</html>