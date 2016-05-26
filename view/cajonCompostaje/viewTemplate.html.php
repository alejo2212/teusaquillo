<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = cajonCompostajeTableClass::ID ?>
    <?php $numero = cajonCompostajeTableClass::NUMERO ?>
    <?php $observacion = cajonCompostajeTableClass::OBSERVACION?>
    <legend><h1><i class="fa fa-archive"></i> Cajon Compostaje </h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Numero</h4>
        <p class="list-group-item-text"><?php echo $objcajonCompostaje->$numero ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Observacion</h4>
        <p class="list-group-item-text"><?php echo ($objcajonCompostaje->$observacion) ? $objcajonCompostaje->$observacion : 'Ninguna' ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('cajonCompostaje', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('cajonCompostaje', 'edit', array($id => $objcajonCompostaje->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>