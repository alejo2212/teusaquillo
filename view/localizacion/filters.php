<?php $id = localidadTableClass::ID ?>
<?php $nombre = localidadTableClass::NOMBRE ?>
<?php $localidadId = localidadTableClass::LOCALIDAD_ID ?>
<!-- Modal -->
<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Filtros <?php echo $countPages ?></h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'index') ?>" class="form-horizontal" role="form">
        <div class="modal-body">

          <div class="form-group">
            <label for="<?php echo localidadTableClass::getNameField(localidadTableClass::NOMBRE, true) ?>" class="col-sm-3 control-label">Ciudad</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="<?php echo localidadTableClass::getNameField(localidadTableClass::NOMBRE, true) ?>" name="<?php echo localidadTableClass::getNameField(localidadTableClass::NOMBRE, true) ?>" placeholder="Ciudad a buscar">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID, true) ?>" class="col-sm-3 control-label">Departamento</label>
            <div class="col-sm-9">
              <select class="form-control" name="<?php echo localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID, true) ?>" id="<?php echo localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objDeptos as $dataDepto): ?>
                  <?php if ($dataDepto->$localidadId === null): ?>
                    <option value="<?php echo $dataDepto->$id ?>"><?php echo $dataDepto->$nombre ?></option>
                  <?php endif; ?>
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