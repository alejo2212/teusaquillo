<?php use mvc\translator\translatorClass AS translator ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\i18n\i18nClass ?>
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

<div class="container container-fluid">
  <fieldset>
    <legend><h1><i class="fa fa-bookmark"></i> Descripcion "<?php echo $objMaquina->$descrip ?>"</h1></legend>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Clasificacion</h4>
        <p class="list-group-item-text"><?php echo clasificacionMaquinaTableClass::getClasiMaquinaById($objMaquina->$clasimaquiid) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Ingreso</h4>
        <p class="list-group-item-text"><?php echo ($objMaquina->$fechaIngre) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objMaquina->$fechaIngre))) : 'No Registrada' ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Codigo</h4>
        <p class="list-group-item-text"><?php echo $objMaquina->$codigo ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Referencia</h4>
        <p class="list-group-item-text"><?php echo $objMaquina->$referencia  ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de Maqntenimiento</h4>
        <p class="list-group-item-text"><?php echo ($objMaquina->$fechaMante) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objMaquina->$fechaMante))) : 'No Registrada' ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Intervalo Para el Mantenimiento</h4>
        <p class="list-group-item-text"><?php echo $objMaquina->$intervaloMante ?> Dias</p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Valor</h4>
        <p class="list-group-item-text"><?php echo '$ ',$objMaquina->$valor ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Activo</h4>
        <p class="list-group-item-text"><?php echo ($objMaquina->$activo) ? 'Si' : 'No' ?></p>
      </div>
    </div>
    
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('maquina', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('maquina', 'edit', array($id => $objMaquina->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>