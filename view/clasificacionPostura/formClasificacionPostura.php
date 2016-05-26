<?php use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $id = clasificacionPosturaTableClass::ID ?>
<?php $nombre = clasificacionPosturaTableClass::NOMBRE ?>
<?php $descripcion = clasificacionPosturaTableClass::DESCRIPCION ?>
<?php $observacion = clasificacionPosturaTableClass::OBSERVACION ?>
<?php // $clasiId = clasificacionPosturaTableClass::CLASIFICACION_POSTURA_ID ?>
<?php $clasiForm = session::getInstance()->getFlash('clasi') ?>

<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionPostura', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
<!--  <div class="form-group">
    <label for="<?ph echo clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::CLASIFICACION_POSTURA_ID, true) ?>" class="col-sm-2 control-label">Clasificacion</label>
    <div class="col-sm-10">
      <select class="form-control" name="<?ph echo clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::CLASIFICACION_POSTURA_ID, true) ?>" id="<?ph echo clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::CLASIFICACION_POSTURA_ID, true) ?>">
        <option value="">Seleccione</option>
        <?ph foreach ($objclasi as $data): ?>
          <?ph if ($data->$clasiId === null): ?>
            <option <?ph echo (((isset($edit) and $edit) and ( $objclasificacionPostura->$clasiId == $data->$id )) ? 'selected ' : ((isset($clasiForm[$clasiId]) and ( $clasiForm[$clasiId] == $data->$id)) ? 'selected ' : '')) ?>value="<?ph echo $data->$id ?>"><?ph echo $data->$nombre ?></option>
          <?ph endif; ?>
        <?ph endforeach; ?>
      </select>
    </div>
  </div>-->
  <div class="form-group">
    <label for="<?php echo clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::NOMBRE, true) ?>" name="<?php echo clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objclasificacionPostura->$nombre : ((isset($clasiForm[$nombre])) ? $clasiForm[$nombre] : '') ?>">
    </div>
  </div>
  <div id="observa" class="form-group">
    <label for="<?php echo clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::DESCRIPCION, true) ?>" class="col-sm-2 control-label">Descripcion</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" id="<?php echo clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::DESCRIPCION, true) ?>" name="<?php echo clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::DESCRIPCION, true) ?>"><?php echo (isset($edit) and $edit) ? $objclasificacionPostura->$descripcion : ((isset($clasiForm[$descripcion])) ? $clasiForm[$descripcion] : '') ?></textarea>
    </div>
  </div>
  <div id="observa" class="form-group">
    <label for="<?php echo clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::OBSERVACION, true) ?>" class="col-sm-2 control-label">Observacion</label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" id="<?php echo clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::OBSERVACION, true) ?>" name="<?php echo clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::OBSERVACION, true) ?>"><?php echo (isset($edit) and $edit) ? $objclasificacionPostura->$observacion : ((isset($clasiForm[$observacion])) ? $clasiForm[$observacion] : '') ?></textarea>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionPostura', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionPostura', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
  <input type="hidden" id="<?php echo clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::ID, true) ?>" name="<?php echo clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::ID, true) ?>" value="<?php echo (isset($edit) === true and $edit === true) ? $objclasificacionPostura->$id : '' ?>">
</form>