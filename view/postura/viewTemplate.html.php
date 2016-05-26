<?php

use mvc\translator\translatorClass AS translator ?>
<?php
use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $idLote = loteTableClass::ID ?>
    <?php $idAmbi = ambienteBaseTableClass::ID ?>
    <?php $id = posturaTableClass::ID ?>
    <?php $lote = posturaTableClass::LOTE_ID ?>
    <?php $ambi = posturaTableClass::AMBIENTE_ID ?>
    <?php $fecha = posturaTableClass::FECHA ?>

    <legend><h1><i class="fa fa-bookmark"></i> Postura </h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha</h4>
        <p class="list-group-item-text"><?php echo translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objPostura->$fecha))) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Lote</h4>
        <p class="list-group-item-text"><?php echo loteTableClass::getLote($objPostura->$lote) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Ambiente</h4>
        <p class="list-group-item-text"><?php echo ambienteTableClass::getNombreById($objPostura->$ambi) ?></p>
      </div>
    </div>
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'edit', array($id => $objPostura->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>