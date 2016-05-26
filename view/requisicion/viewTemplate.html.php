<?php use mvc\translator\translatorClass AS translator ?>
<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = requisicionTableClass::ID ?>
    <?php $empleado = requisicionTableClass::EMPLEADO_ID ?>
    <?php $fecha = requisicionTableClass::FECHA_REALIZACION ?>
    <?php $anulado = requisicionTableClass::ANULADO ?>
    <legend><h1><i class="fa fa-bookmark"></i> <?php echo i18nClass::__('requisicion1') ?> "<?php echo ($objRequisicion->$fecha) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objRequisicion->$fecha))) : 'No Registrada' ?>"</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('empleado') ?></h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objRequisicion->$empleado) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('anulado') ?></h4>
        <p class="list-group-item-text"><?php echo ($objRequisicion->$anulado) ? 'Si' : 'No' ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('requisicion', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('requisicion', 'edit', array($id => $objRequisicion->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>