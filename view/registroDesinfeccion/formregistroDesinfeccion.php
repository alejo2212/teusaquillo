<?php

use mvc\i18n\i18nClass ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $id = registroDesinfeccionTableClass::ID ?>
<?php $fechare = registroDesinfeccionTableClass::FECHA_REALIZACION ?>
<?php $fechater = registroDesinfeccionTableClass::FECHA_TERMINADO ?>
<?php $respon = registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE ?>
<?php $veri = registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR ?>
<?php $insumo = registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID ?>
<?php $solucion = registroDesinfeccionTableClass::SOLUCION ?>
<?php $observacion = registroDesinfeccionTableClass::OBSERVACION ?>
<?php $tipdesin = registroDesinfeccionTableClass::TIPO_DESINFECCION_ID ?>
<?php $desBodega = registroDesinfeccionTableClass::DES_BODEGA ?>
<?php $desPediluvios = registroDesinfeccionTableClass::DES_PEDILUVIOS ?>
<?php $desRamadas = registroDesinfeccionTableClass::DES_RAMDAS ?>
<?php $cantPediluvios = registroDesinfeccionTableClass::CANT_PEDILUVIOS ?>
<?php $idEmpleado = empleadoTableClass::ID ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $idTdesin = tipoDesinfeccionTableClass::ID ?>
<?php $nombreTdesin = tipoDesinfeccionTableClass::NOMBRE ?>
<?php $registroDesinfeccion = session::getInstance()->getFlash('registroDesinfeccion') ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroDesinfeccion', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">

  <div class="row">


    <div id="bloque1" class="col-lg-6 col-md-6 col-sm-6" >
      <div class="form-group">
        <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>" class="">Responsable</label>
        <select class="form-control" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>">
          <option value="">Seleccione</option>
          <?php foreach ($objRespon as $dataAdmin): ?>
            <option <?php echo (((isset($edit) and $edit) and ( $objregistroDesinfeccion->$respon == $dataAdmin->$idEmpleado)) ? 'selected ' : ((isset($registroDesinfeccion[$respon]) and ( $registroDesinfeccion[$respon] == $dataAdmin->$idEmpleado)) ? 'selected ' : '')) ?>value="<?php echo $dataAdmin->$idEmpleado ?>"><?php echo $dataAdmin->$nombreEmpleado ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) ?>" class=" control-label">Fecha De Finalizacion</label>
        <input type="datetime-local" class="form-control" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) ?>" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objregistroDesinfeccion->$fechater) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objregistroDesinfeccion->$fechater)) : '' : ((isset($registroDesinfeccion[$fechater])) ? $registroDesinfeccion[$fechater] : '') ?>">
      </div>

      <div class="form-group">
        <label for="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SOLUCION, true) ?>" class=" control-label">Solucion</label>
        <input type="text" class="form-control" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SOLUCION, true) ?>" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SOLUCION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objregistroDesinfeccion->$solucion : ((isset($registroDesinfeccion[$solucion])) ? $registroDesinfeccion[$insumo] : '') ?>">
      </div>
      <div class="form-group">
        <label for="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::DES_PEDILUVIOS, true) ?>" class=" control-label">Desinfeccion de Pediluvios</label>
        <select class="form-control" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::DES_PEDILUVIOS, true) ?>" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::DES_PEDILUVIOS, true) ?>">

          <option value="">Seleccione</option>
          <option <?php echo (((isset($edit) and $edit) and ( $objregistroDesinfeccion->$desPediluvios)) ? 'selected ' : ((isset($registroDesinfeccion[$desPediluvios]) and ( $registroDesinfeccion[$desPediluvios] == 't')) ? 'selected ' : '')) ?> value="t">SI</option>
          <option <?php echo (((isset($edit) and $edit) and ( $objregistroDesinfeccion->$desPediluvios == false)) ? 'selected ' : ((isset($registroDesinfeccion[$desPediluvios]) and ( $registroDesinfeccion[$desPediluvios] == 'f')) ? 'selected ' : '')) ?>value="f">NO</option>

        </select>
      </div>
      <div class="form-group">
        <label for="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::DES_BODEGA, true) ?>" class=" control-label">Desinfeccion de Bodega</label>
        <select class="form-control" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::DES_BODEGA, true) ?>" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::DES_BODEGA, true) ?>">

          <option value="">Seleccione</option>
          <option <?php echo (((isset($edit) and $edit) and ( $objregistroDesinfeccion->$desBodega)) ? 'selected ' : ((isset($registroDesinfeccion[$desBodega]) and ( $registroDesinfeccion[$desBodega] == 't')) ? 'selected ' : '')) ?> value="t">SI</option>
          <option <?php echo (((isset($edit) and $edit) and ( $objregistroDesinfeccion->$desBodega == false)) ? 'selected ' : ((isset($registroDesinfeccion[$desBodega]) and ( $registroDesinfeccion[$desBodega] == 'f')) ? 'selected ' : '')) ?>value="f">NO</option>

        </select>
      </div>

    </div><!-- /.bloque 1. -->

    <div id="bloque2" class="col-lg-6 col-md-6 col-sm-6">
      <div class="form-group">
        <label for="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) ?>" class=" control-label">Fecha De Realizacion</label>
        <input type="datetime-local" class="form-control" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) ?>" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objregistroDesinfeccion->$fechare) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objregistroDesinfeccion->$fechare)) : '' : ((isset($registroDesinfeccion[$fechare])) ? $registroDesinfeccion[$fechare] : '') ?>">
      </div>
      <div class="form-group">
        <input type="hidden" value="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('controlAlimento', 'searchControl') ?>" id="urlBuscarControl">
        <label for="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>">Salida N°</label>
        <div class="input-group">
          <input type="text" class="form-control" data-id="idBuscarControl" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objregistroDesinfeccion->$insumo : ((isset($registroDesinfeccion[$insumo])) ? $registroDesinfeccion[$insumo] : '') ?>">
          <span class="input-group-btn">
            <a id="btnBuscarControl" class="btn btn-default"><i class="fa fa-search fa-fw"></i> Buscar</a>
          </span>
        </div>
      </div>
      <div class="form-group">
        <label for="<?php echo tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::ID, true) ?>" class="">Tipo Desinfeccion</label>
        <select class="form-control" name="<?php echo tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::ID, true) ?>" id="<?php echo tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::ID, true) ?>">
          <option value="">Seleccione</option>
          <?php foreach ($objtipoDesinfeccion as $datadesinfeccion): ?>
            <option <?php echo (((isset($edit) and $edit) and ( $objregistroDesinfeccion->$tipdesin == $datadesinfeccion->$idTdesin)) ? 'selected ' : ((isset($registroDesinfeccion[$tipdesin]) and ( $registroDesinfeccion[$tipdesin] == $datadesinfeccion->$idTdesin)) ? 'selected ' : '' )) ?>value="<?php echo $datadesinfeccion->$idTdesin ?>"><?php echo $datadesinfeccion->$nombreTdesin ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      
      <div class="form-group">
        <label for="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::CANT_PEDILUVIOS, true) ?>" class=" control-label">Cantidad de Pediluvios desinfectados</label>
        <input type="number" class="form-control" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::CANT_PEDILUVIOS, true) ?>" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::CANT_PEDILUVIOS, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objregistroDesinfeccion->$cantPediluvios : ((isset($registroDesinfeccion[$cantPediluvios])) ? $registroDesinfeccion[$cantPediluvios] : 1) ?>">
      </div>
      <div class="form-group">
        <div class=" table-responsive">
          <table class="table table-hover table-bordered table-condensed">
            <thead class="tdesin">
              <tr><button type="button" class="btn btn-sm btn-default popover-dismiss" data-toggle="popover" title="Ramadas Seleccionadas" data-placement="top" data-content="<?php echo (isset($edit) and $edit) ? $objregistroDesinfeccion->$desRamadas : ((isset($registroDesinfeccion[$desRamadas])) ? $registroDesinfeccion[$desRamadas] : '') ?>"> --------------------- <i class="fa fa-hand-o-up fa-fw"> </i> Ver Ramadas seleccionadas anteriormente <i class="fa fa-hand-o-up fa-fw"> </i>--------------------- </button></tr>
              <tr>
                <th>Todas</th>
                <th>Ramada 1</th>
                <th>Ramada 2</th>
                <th>Ramada 3</th>
                <th>Ramada 4</th>
                <th>Ramada 5</th>
                <th>Ramada 6</th>
                <th>Ramada 7</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <?php $ambiId = ambienteTableClass::ID ?>
              <tr>
                <td><input type="checkbox" id="chkAll"></td>
                <?php foreach ($numramadas as $dataR): ?>
                  <td><input type="checkbox" id="chk<?php echo $dataR->$ambiId ?>" name="chk[]" value="<?php echo $dataR->$ambiId ?>"></td>
                <?php endforeach ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      
    </div><!-- /.bloque 2. -->


  </div>
  <div class="row">
    <div id="bloque1" class="form-group">
      <label for="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::OBSERVACION, true) ?>" class=" control-label">Observaciones</label>
      <textarea class="form-control" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::OBSERVACION, true) ?>" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::OBSERVACION, true) ?>"><?php echo (isset($edit) and $edit) ? $objregistroDesinfeccion->$observacion : ((isset($registroDesinfeccion[$observacion])) ? $registroDesinfeccion[$observacion] : '') ?></textarea>
    </div>
    <div id="bloque1" class="col-lg-6 col-md-6 col-sm-6">
      <div class="form-group">
        <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" class="control-label">Verificador</label>
        <select class="form-control" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>">
          <option value="">Seleccione</option>
          <?php foreach ($objVerificador as $dataVerifi): ?>
            <option <?php echo (((isset($edit) and $edit) and ( $objregistroDesinfeccion->$veri == $dataVerifi->$idEmpleado)) ? 'selected ' : ((isset($registroDesinfeccion[$veri]) and ( $registroDesinfeccion[$veri] == $dataVerifi->$idEmpleado)) ? 'selected ' : '' )) ?> value="<?php echo $dataVerifi->$idEmpleado ?>"><?php echo $dataVerifi->$nombreEmpleado ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroDesinfeccion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroDesinfeccion', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
  <?php if (isset($edit) === true and $edit === true): ?>
    <input type="hidden" id="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::ID, true) ?>" name="<?php echo registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::ID, true) ?>" value="<?php echo $objregistroDesinfeccion->$id ?>">
  <?php endif; ?>

</form>

<div class="modal fade" id="modalBuscar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>