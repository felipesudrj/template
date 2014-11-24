<div class="widget stacked ">

    <div class="widget-header">
        <i class="icon-gears"></i>
        <h3>Gerenciar estoque</h3>
    </div> <!-- /.widget-header -->

    <div class="widget-content">
        <div class="form-horizontal col-md-7">


            <?php echo $this->Form->create();?>
            <div class="form-group">
                <label class="col-md-4">Total de material em estoque</label>
                <div class="col-md-8">
                    <span class="badge"><?php echo (!empty($total))?$total:"0";?></span> (Estoque - Distribuido)
                </div>
            </div> <!-- /.form-group -->


             <div class="form-group">
                <label class="col-md-4">Adicionar quantidade itens</label>
                <div class="col-md-8">
                                         <?php echo $this->Form->input('TotalMaterial.material_id',array('type'=>'hidden','value'=>$material_id));?>

                    <?php echo $this->Form->input('TotalMaterial.quantidade',array('class'=>'form-control','label'=>false));?>
                </div>
            </div> <!-- /.form-group -->



            <div class="form-group">
                <label class="col-md-4">Remover quantidade itens</label>
                <div class="col-md-8">
                     <?php echo $this->Form->input('MaterialDistribuido.material_id',array('type'=>'hidden','value'=>$material_id));?>

                    <?php echo $this->Form->input('MaterialDistribuido.quantidade',array('class'=>'form-control','label'=>false));?>
                </div>
            </div> <!-- /.form-group -->
            
            
            <div class="form-group">
                <label class="col-md-4"></label>
                <div class="col-md-8">
                                        <?php echo $this->Form->submit('Atualizar estoque',array('class'=>'btn btn-success'));?>

                </div>
            </div> <!-- /.form-group -->
        </div>
    </div>
</div>

