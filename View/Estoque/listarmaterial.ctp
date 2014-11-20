<?php $this->start('script'); ?>
<script src="/js/plugins/msgbox/jquery.msgbox.min.js"></script>
<script>
    function excluir(obj){
        
        $.msgbox("Tem certeza que deseja excluir esse item do seu estoque?", {
		  type: "confirm",
		  buttons : [
		    {type: "submit", value: "Sim"},
		    
		    {type: "cancel", value: "Não"}
		  ]
		}, function(result) {
                        if(result){
                           var material_id = $(obj).attr('material_id');
                           window.location.href = "/estoque/excluirmaterial/"+material_id;

                        };
			});
        
    }
		
	
</script>
<?php $this->end(); ?>

<?php $this->start('css'); ?>
<link href="/js/plugins/msgbox/jquery.msgbox.css" rel="stylesheet">	

<?php $this->end(); ?>



<?php $msg = $this->Session->flash('confirmar');
if ($msg) {
    ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>Sucesso:</strong> <?php echo $msg; ?>.
    </div>
<?php } ?>



<?php $msg = $this->Session->flash('negar');
if ($msg) {
    ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>Erro:</strong> <?php echo $msg; ?>.
    </div>
<?php } ?>

<div class="widget stacked ">

    <div class="widget-header">
        <i class="icon-filter"></i>
        <h3>Filtrar</h3>
    </div> <!-- /.widget-header -->

    <div class="widget-content">
        <div class="form-horizontal col-md-7">

<?php echo $this->FilterForm->create(); ?>


            <div class="form-group">
                <label class="col-md-4">Nome do material</label>
                <div class="col-md-8">
<?php echo $this->FilterForm->input('descricao', array('class' => 'form-control', 'label' => false)); ?>
                </div>
            </div> <!-- /.form-group -->



            <div class="form-group">

                <div class="col-md-8">
<?php echo $this->FilterForm->submit('Buscar', array('class' => 'btn btn-success')); ?>

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
                        <th>Nome do material</th>
                        <th>Quantidade total em estoque</th>



                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
<?php foreach ($materiais as $indice => $valor) { ?>
                        <tr>
                            <td><?php echo $valor['Material']['descricao']; ?></td>
                            <td><?php echo $valor['Material']['total']; ?></td>



                            <td>
                                <a href="/estoque/cadastrarmaterial/<?php echo $valor['Material']['material_id']; ?>" class="label label-success"><i class="icon-search"></i> Editar</a>
                                <a href="#" onclick="excluir(this)" material_id="<?php echo $valor['Material']['material_id']; ?>" class="label msgbox-confirm label-danger"><i class="icon-remove"></i> Excluir</a>

                            </td>
                        </tr>
                            <?php } ?>
                    <tr>
                        <td colspan="3">
<?php echo $this->Paginator->numbers(); ?>
                            <a href="/estoque/cadastrarmaterial" class="btn btn-primary pull-right">Cadastrar novo material</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div> <!-- /.table-responsive -->



    </div> <!-- /widget-content -->

</div> <!-- /widget -->

