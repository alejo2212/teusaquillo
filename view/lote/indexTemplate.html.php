<?php

use mvc\translator\translatorClass AS translator ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php
use mvc\session\sessionClass as session;
if (session::getInstance()->hasAttribute('where')) {
  $where = session::getInstance()->getAttribute('where');
  session::getInstance()->setAttribute('where', $where);
}
use mvc\i18n\i18nClass ?>
<div class="container container-fluid">
  <div class="page-header">
    <h3> LOTE </h3>
  </div>
  <?php \mvc\view\viewClass::includeHandlerMessage() ?> <!-- linea de los mensajes-->
  <div id="toolBarGeneral" role="toolbar">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('lote', 'new') ?>" class="btn btn-success btn-xs"><i class="fa fa-plus fa-fw"></i><?php echo i18nClass::__('nuevo') ?></a>
    <a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-xs"><i class="fa fa-times fa-fw"></i> Eliminar</a>
    <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFilter"><i class="fa fa-filter fa-fw"></i><?php echo i18nClass::__('filtrar') ?> </a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('lote', 'index').'?r=true' ?>" class="btn btn-default btn-xs"><i class="fa fa-refresh fa-fw"></i> <?php echo i18nClass::__('resetear') ?></a>
    <div class="btn-group">
      <a href="" class="btn btn-warning btn-xs" ><i class="fa fa-file-pdf-o fa-fw"></i> Informe</a>
      <a href="" class="btn btn-warning dropdown-toggle btn-xs" data-toggle="dropdown">
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('lote', 'informe') ?>" target=_blank ><i class="fa fa-file-text-o fa-fw"></i> Completo</a></li>
        <li><a href="#" data-toggle="modal" data-target="#myModalInforme"><i class="fa fa-filter fa-fw"></i> Puntual</a></li>
        <li class="divider"></li>
        <li><a href="" target=_blank ><i class="fa fa-check-square-o fa-fw"></i> Ica</a></li>
        <li><a href="" target=_blank ><i class="fa fa-line-chart fa-fw"></i> Jefe</a></li>
        <li><a href="" target=_blank ><i class="fa fa-medkit fa-fw"></i> Veterinario</a></li>
      </ul>
    </div>
  </div>
  <?php if (count($objLote) === 0): ?>
    <h1><?php echo i18nClass::__('noExistenDatos') ?></h1>
  <?php else: ?>

    <form id="gridMain" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('lote', 'deleteAll') ?>" method="post">
      <div class="table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center"><input type="checkbox" id="chkAll"></th>
              <th><?php echo i18nClass::__('lote') ?></th>
              <th><?php echo i18nClass::__('fechaEntradaGranja') ?></th>
              <th><?php echo i18nClass::__('fechaEntradaProduccion') ?></th>
              <th><?php echo i18nClass::__('fechaSalidaReal') ?></th>
              <th><?php echo i18nClass::__('raza') ?></th>
              <th><?php echo i18nClass::__('cantidadMachos') ?></th>
              <th><?php echo i18nClass::__('cantidadHembras') ?></th>
              <th><?php echo i18nClass::__('cantidadTotal') ?></th>
              <th><?php echo i18nClass::__('acciones') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $id = loteTableClass::ID ?>
            <?php $nlote = loteTableClass::LOTE ?>
            <?php $fEntradaG = loteTableClass::FECHA_ENTRADA_GRANJA ?>
            <?php $fSalidaR = loteTableClass::FECHA_SALIDA_REAL ?>
            <?php $fEntradaProduc = loteTableClass::FECHA_ENTRA_PRODUCCION ?>
            <?php $razaId = loteTableClass::RAZA_ID ?>
            <?php $cantM = loteTableClass::CANTIDAD_MACHOS ?>
            <?php $cantH = loteTableClass::CANTIDAD_HEMBRAS ?>
            <?php $cantT = loteTableClass::CANTIDAD_TOTAL ?>

            <?php foreach ($objLote as $data): ?>
              <tr>
                <td class="text-center"><input type="checkbox" id="chk<?php echo $data->$id ?>" name="chk[]" value="<?php echo $data->$id ?>"></td>
                <td><?php echo $data->$nlote ?></td>
                <td class="flote"><?php echo ($data->$fEntradaG) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fEntradaG))) : 'No Registrada' ?></td>
                <td class="flote"><?php echo ($data->$fEntradaProduc) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fEntradaProduc))) : 'No Registrada' ?></td>
                <td class="flote"><?php echo ($data->$fSalidaR) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->$fSalidaR))) : 'No Registrada' ?></td>
                <td><?php echo razatableClass::getNombreById($data->$razaId) ?></td>
                <td><?php echo $data->$cantM ?></td>
                <td><?php echo $data->$cantH ?></td>
                <td><?php echo $data->$cantT ?></td>
                <td class="acciones">
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('lote', 'view', array(loteTableClass::ID => $data->$id)) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
                  <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('lote', 'edit', array(loteTableClass::ID => $data->$id)) ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
                  <a onclick="modalEliminar(<?php echo $data->$id ?>, '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('lote', 'delete') ?>', '<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('lote', 'index') ?>', 'modal<?php echo $data->$id ?>')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Borrar"><i class="fa fa-times"></i></a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="10" class="text-right">
                Página <select id="slcPage" data-url="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('lote', 'index') ?>">
                  <?php for ($x = 0; $x < $countPages; $x++): ?>
                    <option <?php echo ($page == $x) ? 'selected' : '' ?> value="<?php echo ($x + 1) ?>"><?php echo ($x + 1) ?></option>
                  <?php endfor ?>
                </select> de <?php echo $countPages ?>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </form>
  <?php endif ?>
</div>
<?php mvc\view\viewClass::includePartial('lote/filters', array('countPages' => $countPages, 'objRaza' => $objRaza, 'objEmpleado' => $objEmpleado)) ?>
<?php mvc\view\viewClass::includePartial('lote/informe', array('objRaza' => $objRaza, 'objEmpleado' => $objEmpleado)) ?>
<?php mvc\view\viewClass::includePartial('lote/deleteModal') ?>