<?php

use mvc\i18n\i18nClass ?>
    <?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $id = tipoIdentificacionTableClass::ID ?>
<?php $descripcion = tipoIdentificacionTableClass::DESCRIPCION ?>
<?php $abreviatura = tipoIdentificacionTableClass::ABREVIATURA ?>
    <legend><h1><i class="fa fa-bookmark"></i> Tipo de Identificacion</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('descripcion') ?></h4>
        <p class="list-group-item-text"><?php echo $objTipoid->$descripcion ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo i18nClass::__('abreviatura') ?></h4>
        <p class="list-group-item-text"><?php echo $objTipoid->$abreviatura ?></p>
      </div>
    </div>
</fieldset>
<div class="text-right">
  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoid', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoid', 'edit', array($id => $objTipoid->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
</div>
</div>