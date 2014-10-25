<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>

<?php if (count($objCargo) === 0): ?>
  <h1>No existen datos</h1>
<?php else: ?>
  <?php $id = cargoTableClass::ID ?>
  <?php $nombre = cargoTableClass::NOMBRE ?>
  <?php $descripcion = cargoTableClass::DESCRIPCION ?>
  <?php foreach ($objCargo as $data): ?>
  <form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('cargo', 'created') ?>" method="post">
    <div class="form-group">
      <label for="<?php echo cargoTableClass::getNameField(cargoTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="<?php echo cargoTableClass::getNameField(cargoTableClass::NOMBRE, true) ?>" name="<?php echo cargoTableClass::getNameField(cargoTableClass::NOMBRE, true) ?>" value="<?php echo $data->$nombre ?>" required>
      </div>
    </div>
    <div class="form-group">
      <label for="<?php echo cargoTableClass::getNameField(cargoTableClass::DESCRIPCION, true) ?>" class="col-sm-2 control-label">Descripcion</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="<?php echo cargoTableClass::getNameField(cargoTableClass::DESCRIPCION, true) ?>" name="<?php echo cargoTableClass::getNameField(cargoTableClass::DESCRIPCION, true) ?>" value="<?php echo $data->$descripcion ?>" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10 text-right">
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('cargo', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('cargo', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
      </div>
    </div>
  </form>
  <?php endforeach ?>
<?php endif; ?>