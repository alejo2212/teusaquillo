<?php use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $id = cajonCompostajeTableClass::ID ?>
<?php $numero = cajonCompostajeTableClass::NUMERO?>
<?php $observacion = cajonCompostajeTableClass::OBSERVACION ?>
<?php $cajonCompostaje = session::getInstance()->getFlash('cajonCompostaje') ?>
<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('cajonCompostaje', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
  <div class="form-group">
      <label for="<?php echo cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::NUMERO, true) ?>" class="col-sm-2 control-label">Numero</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="<?php echo cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::NUMERO, true) ?>" name="<?php echo cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::NUMERO, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objcajonCompostaje->$numero : ((isset($cajonCompostaje[$numero])) ? $cajonCompostaje[$numero] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::OBSERVACION, true) ?>" class="col-sm-2 control-label">Observacion</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="<?php echo cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::OBSERVACION, true) ?>" name="<?php echo cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::OBSERVACION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objcajonCompostaje->$observacion : ((isset($cajonCompostaje[$observacion])) ? $cajonCompostaje[$observacion] : '')  ?>">
    </div>
    </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('cajonCompostaje', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('cajonCompostaje', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
   <?php if (isset($edit) === true and $edit === true):?>
    <input type="hidden" id="<?php echo cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::ID, true) ?>" name="<?php echo cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::ID, true) ?>" value="<?php echo $objcajonCompostaje->$id ?>">
        <?php endif; ?>
</form>