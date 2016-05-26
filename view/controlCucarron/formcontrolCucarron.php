<?php

use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $id = controlCucarronTableClass::ID ?>
<?php $admin = controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR ?>
<?php $vete = controlCucarronTableClass::EMPLEADO_ID_VETERINARIO ?>
<?php $respon = controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE ?>
<?php $fechare = controlCucarronTableClass::FECHA_REALIZACION ?>
<?php $insumo = controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID ?>
<?php $solucion = controlCucarronTableClass::SOLUCION ?>
<?php $formapli = controlCucarronTableClass::FORMA_APLICACION_ID ?>
<?php $aretrata = controlCucarronTableClass::AREA_TRATADA ?>
<?php $observacion = controlCucarronTableClass::OBSERVACION ?>
<?php $idEmpleado = empleadoTableClass::ID ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $idFapli= formaAplicacionTableClass::ID ?>
<?php $nombreFapli = formaAplicacionTableClass::NOMBRE ?>
<?php $controlCucarron = session::getInstance()->getFlash('controlCucarron') ?>
<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlCucarron', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">

    <div class="row">


        <div id="bloque1" class="col-lg-6 col-md-6 col-sm-6" >
            <div class="form-group">
                <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>" class="">Administrador</label>
                <select class="form-control" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>">
                    <option value="">Seleccione</option>
                    <?php foreach ($objAdmin as $dataAdmin): ?>
                        <option <?php echo (((isset($edit) and $edit) and ($objcontrolCucarron->$admin == $dataAdmin->$idEmpleado)) ? 'selected ' : ((isset($controlCucarron[$admin]) and ($controlCucarron[$admin] == $dataAdmin->$idEmpleado)) ? 'selected ' : (count($objAdmin) == 1) ? ' selected ' : '')) ?>value="<?php echo  $dataAdmin->$idEmpleado ?>"><?php echo $dataAdmin->$nombreEmpleado ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>" class=" control-label">Responsable</label>
                <select class="form-control" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>">
                    <option value="">Seleccione</option>
                    <?php foreach ($objEmpleado as $dataEmple): ?>
                    <option <?php echo (((isset($edit) and $edit) and ($objcontrolCucarron->$respon == $dataEmple->$idEmpleado)) ? 'selected ' : ((isset($controlCucarron[$respon]) and ($controlCucarron[$respon] == $dataEmple->$idEmpleado)) ? 'selected ' : '')) ?>value="<?php echo  $dataEmple->$idEmpleado ?>"><?php echo $dataEmple->$nombreEmpleado ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <input type="hidden" value="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('controlAlimento', 'searchControl') ?>" id="urlBuscarControl">
                <label for="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>">Salida N°</label>
                <div class="input-group">
                    <input type="text" class="form-control" data-id="idBuscarControl" id="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" name="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objcontrolCucarron->$insumo :  ((isset($controlCucarron[$insumo])) ? $controlCucarron[$insumo] : '') ?>">
                    <span class="input-group-btn">
                        <a id="btnBuscarControl" class="btn btn-default"><i class="fa fa-search fa-fw"></i> Buscar</a>
                    </span>
                </div>
            </div>
            
            <div class="form-group">
                <label for="<?php echo formaAplicacionTableClass::getNameField(formaAplicacionTableClass::ID, true) ?>" class=" control-label">Forma De Aplicacion</label>
                <select class="form-control" name="<?php echo formaAplicacionTableClass::getNameField(formaAplicacionTableClass::ID, true) ?>" id="<?php echo formaAplicacionTableClass::getNameField(formaAplicacionTableClass::ID, true) ?>">
                    <option value="">Seleccione</option>
                    <?php foreach ($objformaAplicacion as $FormaApli): ?>
                        <option <?php echo (((isset($edit) and $edit) and ($objcontrolCucarron->$formapli == $FormaApli->$idFapli)) ? 'selected ' : ((isset($controlCucarron[$formapli]) and ($controlCucarron[$formapli] == $FormaApli->$idFapli)) ? 'selected ' : '')) ?>value="<?php echo $FormaApli->$idFapli ?>"><?php echo $FormaApli->$nombreFapli ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div><!-- /.bloque 1. -->

        <div id="bloque2" class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" class="">Veterinario</label>
                <select class="form-control" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>">
                    <option value="">Seleccione</option>
                    <?php foreach ($objVeterinario as $dataVeteri): ?>
                        <option <?php echo (((isset($edit) and $edit) and ($objcontrolCucarron->$vete ==  $dataVeteri->$idEmpleado)) ? 'selected ' : ((isset($controlCucarron[$vete]) and ($controlCucarron[$vete] == $dataVeteri->$idEmpleado)) ? 'selected ' : (count($objVeterinario) == 1) ? ' selected ' : '')) ?>value="<?php echo  $dataVeteri->$idEmpleado ?>"><?php echo $dataVeteri->$nombreEmpleado ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) ?>" class=" control-label">Fecha De Realizacion</label>
                <input type="datetime-local" class="form-control" id="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) ?>" name="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objcontrolCucarron->$fechare) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objcontrolCucarron->$fechare)) : '' : ((isset($controlCucarron[$fechare])) ? $controlCucarron[$fechare] : '') ?>">
            </div>
            <div class="form-group">
                <label for="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::SOLUCION, true) ?>" class=" control-label">Solucion</label>
                <input type="text" class="form-control" id="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::SOLUCION, true) ?>" name="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::SOLUCION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objcontrolCucarron->$solucion : ((isset($controlCucarron[$solucion])) ? $controlCucarron[$solucion] : '')?>">
            </div>
            <div class="form-group">
              <label for="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::AREA_TRATADA, true) ?>" class=" control-label">Area Tratada (M&sup2;)</label>
                <input type="text" class="form-control" id="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::AREA_TRATADA, true) ?>" name="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::AREA_TRATADA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objcontrolCucarron->$aretrata : ((isset($controlCucarron[$aretrata])) ? $controlCucarron[$aretrata] : '') ?>">
            </div>
        </div><!-- /.bloque 2. -->
        <div id="bloque1" class="form-group">
            <label for="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::OBSERVACION, true) ?>" class=" control-label">Observaciones</label>
            <textarea class="form-control" id="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::OBSERVACION, true) ?>" name="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::OBSERVACION, true) ?>"><?php echo (isset($edit) and $edit) ? $objcontrolCucarron->$observacion : ((isset($controlCucarron[$observacion])) ? $controlCucarron[$observacion] : '') ?></textarea>
        </div>
    </div>



    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlCucarron', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlCucarron', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
        </div>
    </div>
    <?php if (isset($edit) === true and $edit === true): ?>
        <input type="hidden" id="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::ID, true) ?>" name="<?php echo controlCucarronTableClass::getNameField(controlCucarronTableClass::ID, true) ?>" value="<?php echo $objcontrolCucarron->$id ?>">
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