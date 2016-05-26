<?php use mvc\i18n\i18nClass ?>
<?php use mvc\session\sessionClass as session ?>
<?php $maquinaForm = session::getInstance()->getFlash('maquina') ?>
<?php $idclasima = clasificacionMaquinaTableClass::ID ?>
<?php $nombreclasima = clasificacionMaquinaTableClass::NOMBRE ?>
<?php $id = maquinaTableClass::ID ?>
<?php $clasimaquiid = maquinaTableClass::CLASIFICACION_MAQUINA_ID ?>
<?php $fechaIngre = maquinaTableClass::FECHA_INGRESO ?>
<?php $descrip = maquinaTableClass::DESCRIPCION ?>
<?php $codigo = maquinaTableClass::CODIGO ?>
<?php $referencia = maquinaTableClass::REFERENCIA ?>
<?php $fechaMante = maquinaTableClass::FECHA_MANTENIMIENTO ?>
<?php $intervaloMante = maquinaTableClass::INTERVALO_MANTENIMIENTO ?>
<?php $activo = maquinaTableClass::ACTIVADO ?>
<?php $valor = maquinaTableClass::VALOR ?>
<?php $idclasibode = bodegaClasificacionTableClass::ID ?>
<?php $nombreclasibode = bodegaClasificacionTableClass::NOMBRE ?>
<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('maquina', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
<!--  <div class="form-group">
        <label for="<?php echo bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Clasificacion de Bodega</label>
        <div class="col-sm-10">

            <select class="form-control" name="<?php echo bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::NOMBRE, true) ?>" id="<?php echo bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::NOMBRE, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objclasibodega as $dataclasibode): ?>
                    <option value="<?php echo $dataclasibode->$idclasibode ?>"><?php echo $dataclasibode->$nombreclasibode ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>-->
    <div class="form-group">
    <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::CLASIFICACION_MAQUINA_ID, true) ?>" class="col-sm-2 control-label">Clasificacion</label>
    <div class="col-sm-10">
      <select class="form-control" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::CLASIFICACION_MAQUINA_ID, true) ?>" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::CLASIFICACION_MAQUINA_ID, true) ?>">
        <option value="">Seleccione</option>
        
        <?php foreach ($objClasiMaquina as $data): ?>
          
        <option <?php echo (((isset($edit) and $edit) and ($objMaquina->$clasimaquiid == $data->$idclasima)) ? 'selected ' : ((isset($maquinaForm[$clasimaquiid]) and ($maquinaForm[$clasimaquiid] == $data->$idclasima)) ? 'selected ' : '')) ?>value="<?php echo $data->$idclasima ?>"><?php echo $data->$nombreclasima ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::FECHA_INGRESO, true) ?>" class="col-sm-2 control-label">Fecha de Ingreso</label>
    <div class="col-sm-10">
      <input type="datetime-local" class="form-control" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::FECHA_INGRESO, true) ?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::FECHA_INGRESO, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objMaquina->$fechaIngre) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objMaquina->$fechaIngre)) : '' : ((isset($maquinaForm[$fechaIngre])) ? $maquinaForm[$fechaIngre] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true) ?>" class="col-sm-2 control-label">Descripcion</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true) ?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objMaquina->$descrip : ((isset($maquinaForm[$descrip])) ? $maquinaForm[$descrip] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::CODIGO, true) ?>" class="col-sm-2 control-label">Codigo</label>
    <div class="col-sm-10">
      <input type="text" class="form-control popover-dismiss" data-toggle="popover" title="Ayuda" data-placement="top" data-content="El codigo se asigna deacuerdo a la granja donde este. EJ: si esta en la granja teusaquillo (t1) - granja Cantaclaro (c1)" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::CODIGO, true) ?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::CODIGO, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objMaquina->$codigo : ((isset($maquinaForm[$codigo])) ? $maquinaForm[$codigo] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::REFERENCIA, true) ?>" class="col-sm-2 control-label">Referencia</label>
    <div class="col-sm-10">
      <input type="text" class="form-control popover-dismiss" data-toggle="popover"  title="Ayuda" data-placement="top" data-content="Numero de serie o modelo de la maquina o equipo." id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::REFERENCIA, true) ?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::REFERENCIA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objMaquina->$referencia : ((isset($maquinaForm[$referencia])) ? $maquinaForm[$referencia] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::FECHA_MANTENIMIENTO, true) ?>" class="col-sm-2 control-label">Fecha de Mantenimiento</label>
    <div class="col-sm-10">
      <input type="datetime-local" class="form-control" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::FECHA_MANTENIMIENTO, true) ?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::FECHA_MANTENIMIENTO, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objMaquina->$fechaMante) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objMaquina->$fechaMante)) : '' : ((isset($maquinaForm[$fechaMante])) ? $maquinaForm[$fechaMante] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::INTERVALO_MANTENIMIENTO, true) ?>" class="col-sm-2 control-label">Intervalo Mantenimiento</label>
    <div class="col-sm-10">
      <input type="text" class="form-control popover-dismiss" data-toggle="popover"  title="Ayuda" data-placement="top" data-content="dias restantes en que se realizara el mantenimiento de la maquina o equipo. Ej: se realizara en dos meses se debe colocar el numero de dias que serian  60" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::INTERVALO_MANTENIMIENTO, true) ?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::INTERVALO_MANTENIMIENTO, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objMaquina->$intervaloMante : ((isset($maquinaForm[$intervaloMante])) ? $maquinaForm[$intervaloMante] : '') ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::VALOR, true) ?>" class="col-sm-2 control-label">Valor</label>
    <div class="col-sm-10">
      <input type="text" class="form-control popover-dismiss" data-toggle="popover"  title="Ayuda" data-placement="top" data-content="Costo real de la maquina o equipo." id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::VALOR, true) ?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::VALOR, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objMaquina->$valor : ((isset($maquinaForm[$valor])) ? $maquinaForm[$valor] : '') ?>">
    </div>
  </div>
  
  <?php if (isset($edit) and $edit): ?>
    <div class="form-group">
      <label for="<?php echo maquinaTableClass::getNameField(maquinaTableClass::ACTIVADO, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('activado') ?></label>
      <div class="col-sm-10 checkboxFlow">
        <input type="checkbox" class="form-control" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::ACTIVADO, true) ?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::ACTIVADO, true) ?>" value="t" <?php echo ($objMaquina->$activo) ? 'checked' : '' ?>>
      </div>
    </div>
  <?php endif ?>
<input type="hidden" id="<?php echo maquinaTableClass::getNameField(maquinaTableClass::ID, true) ?>" name="<?php echo maquinaTableClass::getNameField(maquinaTableClass::ID, true) ?>" value="<?php echo (isset($edit) and $edit) ? $objMaquina->$id : '' ?>">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('maquina', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('maquina', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>