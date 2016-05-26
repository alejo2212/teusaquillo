<?php
use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $tipoidForm = session::getInstance()->getFlash('tipoid') ?>
<?php $id = tipoIdentificacionTableClass::ID ?>
<?php $descripcion = tipoIdentificacionTableClass::DESCRIPCION ?>
<?php $abrevia = tipoIdentificacionTableClass::ABREVIATURA ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoid', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <div class="form-group">
    <label for="<?php echo tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DESCRIPCION, true) ?>" class="col-sm-2 control-label">Descripcion</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DESCRIPCION, true) ?>" name="<?php echo tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DESCRIPCION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objTipoid->$descripcion : ((isset($tipoidForm[$descripcion])) ? $tipoidForm[$descripcion] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ABREVIATURA, true) ?>" class="col-sm-2 control-label">Abreviatura</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ABREVIATURA, true) ?>" name="<?php echo tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ABREVIATURA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objTipoid->$abrevia : ((isset($tipoidForm[$abrevia])) ? $tipoidForm[$abrevia] : '') ?>">
    </div>
  </div>
  <input type="hidden" id="<?php echo tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ID, true) ?>" name="<?php echo tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ID, true) ?>" value="<?php echo (isset($edit) === true and $edit === true) ? $objTipoid->$id : '' ?>">

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoid', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoid', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>