<?php use mvc\translator\translatorClass AS translator ?>
<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = salidaincubadoraTableClass::ID ?>
    <?php $idanual = salidaincubadoraTableClass::ID_ANUAL ?>
    <?php $empleado = salidaincubadoraTableClass::EMPLEADO_ID ?>
    <?php $cantidad = salidaincubadoraTableClass::CANTIDAD ?>
    <?php $fecha = salidaincubadoraTableClass::FECHA ?>
    <?php $fecha_lle = salidaincubadoraTableClass::FECHA_LLEGADA ?>
    <?php $fecha_sa = salidaincubadoraTableClass::FECHA_SALIDAD ?>
    <?php $npedido = salidaincubadoraTableClass::NO_PEDIDO ?>
    <?php $observacion = salidaincubadoraTableClass::OBSERVACION ?>
    <?php $idEmp = empleadoTableClass::ID ?>
    <?php $nomEmp = empleadoTableClass::NOMBRE ?>
    <?php $idInc = incubadoraTableClass::ID ?>
    <?php $nomInc = incubadoraTableClass::NOMBRE ?>
    
    <legend><h1><i class="fa fa-bookmark"> </i> Pedido N° "<?php echo $objSalida->$npedido ?>"</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">N° Anual: </h4>
        <p class="list-group-item-text"><?php echo $objSalida->$idanual ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha</h4>
        <p class="list-group-item-text"><?php echo translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objSalida->$fecha))) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Cantidad</h4>
        <p class="list-group-item-text"><?php echo $objSalida->$cantidad ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Realizacion</h4>
        <p class="list-group-item-text"><?php echo translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objSalida->$fecha))) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Llegada Trasportador</h4>
        <p class="list-group-item-text"><?php echo translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objSalida->$fecha_lle))) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Salida Trasportador</h4>
        <p class="list-group-item-text"><?php echo translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objSalida->$fecha_sa))) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Realizo</h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objSalida->$empleado) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Observacion</h4>
        <p class="list-group-item-text"><?php echo ($objSalida->$observacion) ? $objSalida->$observacion : 'Ninguna' ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'edit', array($id => $objSalida->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>