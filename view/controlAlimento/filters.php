<!-- Modal -->
<?php $idEmp = empleadoTableClass::ID ?>
<?php $nombreEmp = empleadoTableClass::NOMBRE ?>
<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Filtros <?php echo $countPages ?></h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('controlAlimento', 'index') ?>" class="form-horizontal" role="form">
        <div class="modal-body">

          <div class="form-group">
            <label for="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID_EMPLEADO, true) ?>" class="col-sm-2 control-label">Empleado</label>
            <div class="col-sm-10">
              <select class="form-control" name="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID_EMPLEADO, true) ?>" id="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID_EMPLEADO, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objEmpleado as $data): ?>
                  <option value="<?php echo $data->$idEmp ?>"><?php echo $data->$nombreEmp ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEXO, true) ?>" class="col-sm-2 control-label">Sexo</label>
            <div class="col-sm-10">
              <select id="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEXO, true) ?>" name="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEXO, true) ?>" class="form-control">
          <option value="">Seleccione</option>
          <option value="t">Masculino</option>
          <option value="f">Femenino</option>
        </select>
            </div>
          </div>
          <div class="form-group">
            <label for="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEMANA, true) ?>" class="col-sm-2 control-label">Semana</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEMANA, true) ?>" name="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEMANA, true) ?>" placeholder="Buscar por Semana">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Fecha de Control</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA, true) ?>_ini" name="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA, true) ?>_ini" placeholder="Fecha inicio">
              <br>
              <input type="date" class="form-control" id="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA, true) ?>_fin" name="<?php echo controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA, true) ?>_fin" placeholder="Fecha final">
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