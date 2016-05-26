<?php use mvc\translator\translatorClass AS translator ?>
<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = controlCompostajeTableClass::ID ?>
    <?php $admin = controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR?>
    <?php $veteri = controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO?>
    <?php $respon = controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE?>
    <?php $fecha = controlCompostajeTableClass::FECHA_REALIZACION?>
    <?php $cajonCompos = controlCompostajeTableClass::CAJON_COMPOSTAJE_ID?>
    <?php $gallinaza = controlCompostajeTableClass::GALLINAZA_UTILIZADA?>
    <?php $avestotal = controlCompostajeTableClass::CANTIDAD_TOTAL_AVES?>
    <?php $machos = controlCompostajeTableClass::CANTIDAD_MACHOS?>
    <?php $hembras = controlCompostajeTableClass::CANTIDAD_HEMBRAS?>
    <?php $lote = controlCompostajeTableClass::SALIDA_LOTE_ID?>
    <?php $observa = controlCompostajeTableClass::OBSERVACION?>
    <?php $deleted = controlCompostajeTableClass::DELETED_AT?>
    
    <legend><h1><i class="fa fa-archive"></i> Control Compostaje</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Administrador</h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objCompostajeV->$admin) ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Veterinario</h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objCompostajeV->$veteri) ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Responsable</h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objCompostajeV->$respon) ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Realizacion</h4>
        <p class="list-group-item-text"><?php echo ($objCompostajeV->$fecha) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objCompostajeV->$fecha))) : 'No Registrada' ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading">N° de Cajon</h4>
        <p class="list-group-item-text"><?php echo $objCompostajeV->$cajonCompos ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Gallinaza Utilizada</h4>
        <p class="list-group-item-text"><?php echo $objCompostajeV->$gallinaza ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Total de Aves</h4>
        <p class="list-group-item-text"><?php echo $objCompostajeV->$avestotal ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Cantidad de Hembras</h4>
        <p class="list-group-item-text"><?php echo $objCompostajeV->$hembras ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Cantidad de Machos</h4>
        <p class="list-group-item-text"><?php echo $objCompostajeV->$machos ?></p>
      </div>
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Observaciones</h4>
        <p class="list-group-item-text"><?php echo ($objCompostajeV->$observa) ? $objCompostajeV->$observa : 'Ninguna' ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlCompostaje', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlCompostaje', 'edit', array($id => $objCompostajeV->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>