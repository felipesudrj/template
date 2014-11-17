    <!-- LISTAR MATERIAIS QUE O TECNICO POSSUI - INICIO -->
    <div class="form-group">
        <label for="modelo" class="col-lg-4">Tipo de Material</label>
        <div class="col-md-8">

            <select onclick="mostrarUnidade()" id="materialTipo"  name="material_id" class="form-control">
                <option tipoUnidade="" selected="true" disabled="true">Selecione o tipo de material</option>
                <?php foreach ($materiais as $indMat => $valMat) { ?>
                    <option tipoUnidade="<?php echo $valMat['Material']['UnidadeMedida']['descricao']; ?>" value="<?php echo $valMat['MaterialDistribuido']['material_id']; ?>" >
                        <?php echo $valMat['Material']['descricao']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>	

    <div class="form-group">
        <label for="numeroserie"  class="col-lg-4">Quantidade  <span  id="descTipoUnidade"></span></label>
        <div class="col-md-8">

            <input type="text" name="quantidade" class="form-control" id="materialQuantidade" value="">

        </div>
    </div>

    <div class="form-group">
        <label for="numeroserie" class="col-lg-4">Outras Informações</label>
        <div class="col-md-8">
            <input type="text"  name="informacoes" class="form-control" id="materialInformacoes" value="">
        </div>
    </div>

    <div class="form-group">
        <input type="button" class="btn btn-default pull-right" value="Incluir" onclick="incluiritemrat();">
    </div>

    <hr>
    <!-- LISTAR MATERIAIS QUE O TECNICO POSSUI - FIM -->

