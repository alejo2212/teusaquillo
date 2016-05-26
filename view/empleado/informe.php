<!-- Modal -->
<?php $id = tipoIdentificacionTableClass::ID ?>
<?php $nombre = tipoIdentificacionTableClass::DESCRIPCION ?>
<?php $cargoId = cargoTableClass::ID ?>
<?php $cargoNombre = cargoTableClass::NOMBRE ?>
<div class="modal fade" id="myModalInforme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Generar Informe por:</h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'informe') ?>" target="_blank" class="form-horizontal" role="form">
        <div class="modal-body">

          <div class="form-group">
            <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>" placeholder="Nombre del Empleado">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" class="col-sm-2 control-label">Apellido</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" placeholder="Apellido del Empleado">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true) ?>" class="col-sm-2 control-label">Documento</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true) ?>" placeholder="Numero de Documento del Empleado">
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::GENERO, true) ?>" class="col-sm-2 control-label">Genero</label>
            <div class="col-sm-10">
              <select class="form-control" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::GENERO, true) ?>" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::GENERO, true) ?>">
                <option value="">Seleccione</option>
                  <option value="M">Masculino</option>
                  <option value="F">Femenino</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID, true) ?>" class="col-sm-2 control-label">Tipo de Identificacion</label>
            <div class="col-sm-10">
              <select class="form-control" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID, true) ?>" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objTipoid as $data): ?>

                  <option value="<?php echo $data->$id ?>"><?php echo $data->$nombre ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CARGO, true) ?>" class="col-sm-2 control-label">Cargo</label>
            <div class="col-sm-10">
              <select class="form-control" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CARGO, true) ?>" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CARGO, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objCargo as $datacargo): ?>
                  <option value="<?php echo $datacargo->$cargoId ?>"><?php echo $datacargo->$cargoNombre ?></option>
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