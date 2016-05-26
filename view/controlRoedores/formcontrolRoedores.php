<?php

use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $id = controlRoedoresTableClass::ID ?>
<?php $admin = controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR ?>
<?php $vete = controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO ?>
<?php $respon = controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE ?>
<?php $fechare = controlRoedoresTableClass::FECHA_REALIZACION ?>
<?php $insumo = controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID ?>
<?php $pellets = controlRoedoresTableClass::PELLETS ?>
<?php $bloques = controlRoedoresTableClass::BLOQUES ?>
<?php $eviconsu = controlRoedoresTableClass::EVIDENCIA_CONSUMO ?>
<?php $lugar = controlRoedoresTableClass::LUGAR ?>
<?php $observacion = controlRoedoresTableClass::OBSERVACION ?>
<?php $idEmpleado = empleadoTableClass::ID ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $controlRoedores = session::getInstance()->getFlash('controlRoedores') ?>


<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlRoedores', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">

    <div class="row">


        <div id="bloque1" class="col-lg-6 col-md-6 col-sm-6" >
            <div class="form-group">
                <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>" class="">Administrador</label>
                <select class="form-control" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>">
                    <option value="">Seleccione</option>
                    <?php foreach ($objAdmin as $dataAdmin): ?>
                        <option <?php echo (((isset($edit) and $edit) and ($objcontrolRoedores->$admin == $dataAdmin->$idEmpleado)) ? 'selected ' : ((isset($controlRoedores[$admin]) and ($controlRoedores[$admin] == $dataAdmin->$idEmpleado)) ? 'selected ' : (count($objAdmin) == 1) ? ' selected ' : '')) ?>value="<?php echo  $dataAdmin->$idEmpleado ?>"><?php echo $dataAdmin->$nombreEmpleado ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>" class=" control-label">Responsable</label>
                <select class="form-control" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>">
                    <option value="">Seleccione</option>
                    <?php foreach ($objEmpleado as $dataEmple): ?>
                        <option <?php echo (((isset($edit) and $edit) and ($objcontrolRoedores->$respon == $dataEmple->$idEmpleado)) ? 'selected ' : ((isset($controlRoedores[$respon]) and ($controlRoedores[$respon] == $dataAdmin->$idEmpleado)) ? 'selected ' : '')) ?> value="<?php echo $dataEmple->$idEmpleado ?>"><?php echo $dataEmple->$nombreEmpleado ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <input type="hidden" value="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('controlAlimento', 'searchControl') ?>" id="urlBuscarControl">
                <label for="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>">Salida N°</label>
                <div class="input-group">
                    <input type="text" class="form-control" data-id="idBuscarControl" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objcontrolRoedores->$insumo :   ((isset($controlRoedores[$insumo])) ? $controlRoedores[$insumo] : '') ?>">
                    <span class="input-group-btn">
                        <a id="btnBuscarControl" class="btn btn-default"><i class="fa fa-search fa-fw"></i> Buscar</a>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::BLOQUES, true) ?>" class=" control-label">Bloques</label>
                <input type="text" class="form-control" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::BLOQUES, true) ?>" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::BLOQUES, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objcontrolRoedores->$bloques : ((isset($controlRoedores[$bloques])) ? $controlRoedores[$bloques] : 0) ?>">
            </div>
            <div class="form-group">
                <label for="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::LUGAR, true) ?>" class=" control-label">Lugar De Aplicacion</label>
                <input type="text" class="form-control" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::LUGAR, true) ?>" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::LUGAR, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objcontrolRoedores->$lugar :   ((isset($controlRoedores[$lugar])) ? $controlRoedores[$lugar] : ((isset($controlRoedores[$lugar])) ? $controlRoedores[$lugar] : '')) ?>">
            </div>
        </div><!-- /.bloque 1. -->

        <div id="bloque2" class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" class="">Veterinario</label>
                <select class="form-control" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>">
                    <option value="">Seleccione</option>
                    <?php foreach ($objVeterinario as $dataVeteri): ?>
                        <option <?php echo (((isset($edit) and $edit) and ($objcontrolRoedores->$vete == $dataVeteri->$idEmpleado)) ? 'selected ' : ((isset($controlRoedores[$vete]) and ($controlRoedores[$vete] ==  $dataVeteri->$idEmpleado)) ? 'selected ' : (count($objVeterinario) == 1) ? ' selected ' : '')) ?> value="<?php echo  $dataVeteri->$idEmpleado ?>"><?php echo $dataVeteri->$nombreEmpleado ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) ?>" class=" control-label">Fecha De Realizacion</label>
                <input type="datetime-local" class="form-control" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) ?>" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objcontrolRoedores->$fechare) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objcontrolRoedores->$fechare)) : '' : ((isset($controlRoedores[$fechare])) ? $controlRoedores[$fechare] : '') ?>">
            </div>
            <div class="form-group">
                <label for="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::PELLETS, true) ?>" class=" control-label">Pellets</label>
                <input type="text" class="form-control" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::PELLETS, true) ?>" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::PELLETS, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objcontrolRoedores->$pellets  : ((isset($controlRoedores[$pellets])) ? $controlRoedores[$pellets] : 0) ?>">
            </div>
            <div class="form-group">
                <label for="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EVIDENCIA_CONSUMO, true) ?>" class=" control-label">Evidencia De Consumo</label>
                <select class="form-control" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EVIDENCIA_CONSUMO, true) ?>" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EVIDENCIA_CONSUMO, true) ?>">
                    
                        <option value="">Seleccione</option>
                        <option <?php echo (((isset($edit) and $edit) and ($objcontrolRoedores->$eviconsu)) ? 'selected ' : ((isset($controlRoedores[$eviconsu]) and ($controlRoedores[$eviconsu] ==  't')) ? 'selected ' : '')) ?> value="t">SI</option>
                        <option <?php echo (((isset($edit) and $edit) and ($objcontrolRoedores->$eviconsu==false)) ? 'selected ' : ((isset($controlRoedores[$eviconsu]) and ($controlRoedores[$eviconsu] ==  'f')) ? 'selected ' : '')) ?>value="f">NO</option>
                   
                </select>
            </div>
        </div><!-- /.bloque 2. -->


    </div>
    <div class="row">
        <div id="bloque1" class="form-group">
            <label for="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::OBSERVACION, true) ?>" class=" control-label">Observaciones</label>
            <textarea class="form-control" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::OBSERVACION, true) ?>" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::OBSERVACION, true) ?>"><?php echo (isset($edit) and $edit) ? $objcontrolRoedores->$observacion :  ((isset($controlRoedores[$observacion])) ? $controlRoedores[$observacion] : '') ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlRoedores', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlRoedores', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
        </div>
    </div>
    <?php if (isset($edit) === true and $edit === true): ?>
        <input type="hidden" id="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::ID, true) ?>" name="<?php echo controlRoedoresTableClass::getNameField(controlRoedoresTableClass::ID, true) ?>" value="<?php echo $objcontrolRoedores->$id ?>">
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