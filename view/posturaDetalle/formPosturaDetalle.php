<?php

use mvc\i18n\i18nClass ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $detallePostuForm = session::getInstance()->getFlash('detallePostu') ?>
<?php $id = posturaDetalleTableClass::ID ?>
<?php $idPostu = posturaDetalleTableClass::POSTURA_ID ?>
<?php $idClasi = posturaDetalleTableClass::CLASIFICACION_POSTURA_ID ?>
<?php $idEmple = posturaDetalleTableClass::EMPLEADO_ID ?>
<?php $cantidad = posturaDetalleTableClass::CANTIDAD ?>
<?php $venta = posturaDetalleTableClass::INGRESO_VENTA ?>
<?php $idEm = empleadoTableClass::ID ?>
<?php $nomEm = empleadoTableClass::NOMBRE ?>
<?php $idClas = clasificacionPosturaTableClass::ID ?>
<?php $nomClas = clasificacionPosturaTableClass::NOMBRE ?>
<?php // print_r($objclasi)?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('posturaDetalle', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <input type="hidden" class="form-control" id="<?php echo posturaDetalleTableClass::getNameField(posturaDetalleTableClass::POSTURA_ID, true) ?>" name="<?php echo posturaDetalleTableClass::getNameField(posturaDetalleTableClass::POSTURA_ID, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objDetallePostu->$idPostu : $idPostura ?>">
  <div class="form-group">
    <label for="<?php echo posturaDetalleTableClass::getNameField(posturaDetalleTableClass::CLASIFICACION_POSTURA_ID, true) ?>" class="col-sm-2 control-label">Clasificacion</label>
    <div class="col-sm-10">
      <select class="form-control" name="<?php echo posturaDetalleTableClass::getNameField(posturaDetalleTableClass::CLASIFICACION_POSTURA_ID, true) ?>" id="<?php echo posturaDetalleTableClass::getNameField(posturaDetalleTableClass::CLASIFICACION_POSTURA_ID, true) ?>">
        <option value="">Seleccione</option>
        <?php foreach ($objclasi as $data): ?>
          <?php
          $num = posturaDetalleTableClass::getNumeroClasi($data->$idClas, $idPostura);
          if ($data->$idClas != $num) {
            ?>
            <option <?php echo (((isset($edit) and $edit) and ( $objDetallePostu->$idClasi == $data->$idClas )) ? 'selected ' : ((isset($detallePostuForm[$idClasi]) and ( $detallePostuForm[$idClasi] == $data->$idClas)) ? 'selected ' : '')) ?> value="<?php echo $data->$idClas ?>"><?php echo $data->$nomClas  ?></option>

            <?php
          }
        endforeach;
        ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo posturaDetalleTableClass::getNameField(posturaDetalleTableClass::EMPLEADO_ID, true) ?>" class="col-sm-2 control-label">Empleado</label>
    <div class="col-sm-10">
      <select class="form-control" name="<?php echo posturaDetalleTableClass::getNameField(posturaDetalleTableClass::EMPLEADO_ID, true) ?>" id="<?php echo posturaDetalleTableClass::getNameField(posturaDetalleTableClass::EMPLEADO_ID, true) ?>">
        <option value="">Seleccione</option>
        <?php foreach ($objEmpleado as $dataE): ?>
          <option <?php echo (((isset($edit) and $edit) and ( $objDetallePostu->$idEmple == $dataE->$idClas )) ? 'selected ' : ((isset($detallePostuForm[$idEmple]) and ( $detallePostuForm[$idEmple] == $dataE->$idClas)) ? 'selected ' : '')) ?>value="<?php echo $dataE->$idEm ?>"><?php echo $dataE->$nomEm ?></option>  
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo posturaDetalleTableClass::getNameField(posturaDetalleTableClass::CANTIDAD, true) ?>" class="col-sm-2 control-label">Cantidad Recolectada</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo posturaDetalleTableClass::getNameField(posturaDetalleTableClass::CANTIDAD, true) ?>" name="<?php echo posturaDetalleTableClass::getNameField(posturaDetalleTableClass::CANTIDAD, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objDetallePostu->$cantidad : ((isset($detallePostuForm[$cantidad])) ? $detallePostuForm[$cantidad] : '') ?>">
    </div>
  </div>
<!--  <div class="form-group">
    <label for="<?php // echo posturaDetalleTableClass::getNameField(posturaDetalleTableClass::INGRESO_VENTA, true) ?>" class="col-sm-2 control-label">Ingreso de Venta</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php // echo posturaDetalleTableClass::getNameField(posturaDetalleTableClass::INGRESO_VENTA, true) ?>" name="<?php // echo posturaDetalleTableClass::getNameField(posturaDetalleTableClass::INGRESO_VENTA, true) ?>" value="<?php // echo (isset($edit) and $edit) ? $objDetallePostu->$venta : ((isset($detallePostuForm[$venta])) ? $detallePostuForm[$venta] : '') ?>">
    </div>
  </div>-->

  <input type="hidden" id="<?php echo posturaDetalleTableClass::getNameField(posturaDetalleTableClass::ID, true) ?>" name="<?php echo posturaDetalleTableClass::getNameField(posturaDetalleTableClass::ID, true) ?>" value="<?php echo (isset($edit) === true and $edit === true) ? $objDetallePostu->$id : '' ?>">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'detail', array(posturaTableClass::ID => (isset($edit) and $edit) ? $objDetallePostu->$idPostu : $idPostura)) ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'detail', array(posturaTableClass::ID => (isset($edit) and $edit) ? $objDetallePostu->$idPostu : $idPostura)) ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>
