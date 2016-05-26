<!-- Modal -->
<?php $idCiu = localidadTableClass::ID ?>
<?php $nomCiu = localidadTableClass::NOMBRE ?>
<?php $id = incubadoraTableClass::ID ?>
<?php $nombre = incubadoraTableClass::NOMBRE ?>

<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Filtros <?php echo $countPages ?></h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('incubadora', 'index') ?>" class="form-horizontal" role="form">
        <div class="modal-body">
          <div class="form-group">
            <label for="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::NOMBRE, true) ?>" name="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::NOMBRE, true) ?>" placeholder="Nombre a Buscar">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::LOCALIZACION_ID, true) ?>" class="col-sm-2 control-label">Ciudad</label>
            <div class="col-sm-10">
              <select class="form-control" name="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::LOCALIZACION_ID, true) ?>" id="<?php echo incubadoraTableClass::getNameField(incubadoraTableClass::LOCALIZACION_ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objlocalidad as $data): ?>

                  <option value="<?php echo $data->$idCiu ?>"><?php echo $data->$nomCiu ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
      </form>
    </div>
  </div>
</div>