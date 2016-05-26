<?php
use mvc\config\configClass as config;
use mvc\i18n\i18nClass ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $posturaForm = session::getInstance()->getFlash('postura') ?>
<?php $id = posturaTableClass::ID ?>
<?php $lote = posturaTableClass::LOTE_ID ?>
<?php $ambi = posturaTableClass::AMBIENTE_ID ?>
<?php $idambi = ambienteTableClass::ID ?>
<?php $nomambi = ambienteTableClass::NOMBRE ?>
<?php $idlote = loteTableClass::ID ?>
<?php $nomlote = loteTableClass::LOTE ?>
<?php $fecha = posturaTableClass::FECHA;

$fechahoy = strftime('%Y-%m-%dT%H:%M:%S', strtotime(date(config::getFormatTimestamp())));
$newLeng = strlen($fechahoy) - 3;
$fechahoy = substr($fechahoy, 0, $newLeng);
if(isset($edit) === true and isset($objPostura->$fecha)){
  $objPostura->$fecha = strftime('%Y-%m-%dT%H:%M:%S', strtotime(date(config::getFormatTimestamp())));
$newLeng = strlen($objPostura->$fecha) - 3;
$objPostura->$fecha = substr($objPostura->$fecha, 0, $newLeng);
}
?>
<?php // print_r($objPostura) ?>
<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">

  <div class="form-group">
    <label for="<?php echo posturaTableClass::getNameField(posturaTableClass::FECHA, true) ?>" class="col-sm-3 control-label">Fecha de Realizacion</label>
    <div class="col-sm-9">
        <!--<input type="text" value="<?ph echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($objPostura->$fecha)); ?>">-->
        <input type="datetime-local" autocomplete="on" class="form-control" id="<?php echo posturaTableClass::getNameField(posturaTableClass::FECHA, true) ?>" name="<?php echo posturaTableClass::getNameField(posturaTableClass::FECHA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($objPostura->$fecha) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objPostura->$fecha)) : $fechahoy : ((isset($posturaForm[$fecha])) ? $posturaForm[$fecha] : $fechahoy) ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo posturaTableClass::getNameField(posturaTableClass::LOTE_ID, true) ?>" class="col-sm-3 control-label">Lote</label>
    <div class="col-sm-9">
      <select class="form-control" name="<?php echo posturaTableClass::getNameField(posturaTableClass::LOTE_ID, true) ?>" id="<?php echo posturaTableClass::getNameField(posturaTableClass::LOTE_ID, true) ?>">
        <!--<option value="">Seleccione</option>-->
        
        <?php foreach ($objlote as $data): ?>
          <option <?php echo (((isset($edit) and $edit) and ($objPostura->$lote == $data->$idlote)) ? 'selected ' : ((isset($posturaForm[$lote]) and ($posturaForm[$lote] == $data->$idlote)) ? 'selected ' : '')) ?> value="<?php echo $data->$idlote ?>"><?php echo $data->$nomlote ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo posturaTableClass::getNameField(posturaTableClass::AMBIENTE_ID, true) ?>" class="col-sm-3 control-label">Ambiente</label>
    <div class="col-sm-9">
      <select class="form-control" name="<?php echo posturaTableClass::getNameField(posturaTableClass::AMBIENTE_ID, true) ?>" id="<?php echo posturaTableClass::getNameField(posturaTableClass::AMBIENTE_ID, true) ?>">
        <option value="">Seleccione</option>
        
        <?php foreach ($objambiente as $dataambi): ?>
          <option <?php echo (((isset($edit) and $edit) and ($objPostura->$ambi == $dataambi->$idambi)) ? 'selected ' : ((isset($posturaForm[$ambi]) and ($posturaForm[$ambi] == $dataambi->$idambi)) ? 'selected ' : '')) ?> value="<?php echo $dataambi->$idambi ?>"><?php echo $dataambi->$nomambi ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>

  <input type="hidden" id="<?php echo posturaTableClass::getNameField(posturaTableClass::ID, true) ?>" name="<?php echo posturaTableClass::getNameField(posturaTableClass::ID, true) ?>" value="<?php echo (isset($edit) === true and $edit === true) ? $objPostura->$id : '' ?>">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
    </div>
  </div>
</form>
