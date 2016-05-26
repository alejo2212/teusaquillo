
<?php

use mvc\session\sessionClass as session ?>
<?php
use mvc\i18n\i18nClass ?>
<?php $idInsu = insumoTableClass::ID ?>
<?php $nombreInsu = insumoTableClass::NOMBRE ?>
<?php $salidaIn = salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID ?>
<?php $insumo = salidaInsumoDetalleTableClass::INSUMO_ID ?>
<?php $id = salidaInsumoDetalleTableClass::ID ?>
<?php $salidaIn = salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID ?>
<?php $bodegaId = salidaInsumoDetalleTableClass::BODEGA_ID ?>
<?php $cantidad = salidaInsumoDetalleTableClass::CANTIDAD ?>
<?php $observacion = salidaInsumoDetalleTableClass::OBSERVACION ?>
<?php $anulado = salidaInsumoDetalleTableClass::ANULADO ?>
<?php $idBo = bodegaTableClass::ID ?>
<?php $lote = loteTableClass::LOTE ?>
<?php $idBoClasi = bodegaTableClass::BODEGA_CLASIFICACION_ID ?>
<?php $nomBo = bodegaClasificacionTableClass::NOMBRE ?>
<?php $salidaInsumoDetalleForm = session::getInstance()->getFlash('salidaInsumoDetalle') ?>
<div class="container container-fluid ajaxLoadCant">
</div>
<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumoDetalle', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="POST">
  <input type="hidden" class="form-control" id="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID, true) ?>" name="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $SalidainsumoDetalle->$salidaIn : $idsal ?>">  

  <div class="form-group">
    <label for="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::BODEGA_ID, true) ?>" class="col-sm-2 control-label">Bodega</label>
    <div class="col-sm-10">
      <select onchange="traerInsumos('<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumoDetalle', 'ajaxTraerInsumo') ?>', this)" id="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::BODEGA_ID, true) ?>" name="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::BODEGA_ID, true) ?>" class="form-control">
        <option value="0">Seleccione</option>
        <?php foreach ($objBodegas as $dataBo): ?>
          <option data-idsalinsu="<?php echo (isset($edit) and $edit) ? $SalidainsumoDetalle->$salidaIn : $idsal ?>" data-idlote="<?php echo $dataBo->$lote ?>" data-idboclasi="<?php echo $dataBo->$idBoClasi ?>"  value="<?php echo $dataBo->$lote.$dataBo->$idBoClasi ?>"><?php echo 'Lote:', $dataBo->$lote, ' Bodega:', $dataBo->$nomBo ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::INSUMO_ID, true) ?>" class="col-sm-2 control-label">Insumo</label>
    <div class="col-sm-10">
      <select onchange="ValidarCantidadInsumo('<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumoDetalle', 'ajaxValCantInsumo') ?>', this)" id="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::INSUMO_ID, true) ?>" name="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::INSUMO_ID, true) ?>" class="form-control ajaxLoad disabled" disabled>
        <option value="0">Seleccione una bodega</option>

        <!--<?php // foreach ($objInsumo as $dataInsu): ?>
                  <option  <?php // echo (((isset($edit) and $edit) and ( $SalidainsumoDetalle->$insumo == $dataInsu->$idInsu )) ? 'selected ' : ((isset($salidaInsumoDetalleForm[$insumo]) and ( $salidaInsumoDetalleForm[$insumo] == $dataInsu->$idInsu)) ? 'selected ' : '') ) ?> value="<?php // echo $dataInsu->$idInsu ?>"><?php // echo $dataInsu->$nombreInsu ?></option>
        <?php // endforeach; ?>-->

      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::CANTIDAD, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('cantidad') ?></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::CANTIDAD, true) ?>" name="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::CANTIDAD, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $SalidainsumoDetalle->$cantidad : ((isset($salidaInsumoDetalleForm[$cantidad])) ? $salidaInsumoDetalleForm[$cantidad] : '') ?>">
    </div>
  </div>
  <?php if (isset($edit) and $edit): ?>
    <div class="form-group">
      <label for="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::ANULADO, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('activado') ?></label>
      <div class="col-sm-10 checkboxFlow">
        <input type="checkbox" class="form-control" id="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::ANULADO, true) ?>" name="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::ANULADO, true) ?>" value="t" <?php echo (isset($edit) and $edit and $SalidainsumoDetalle->$anulado) ? 'checked' : '' ?>>
        <input type="hidden" id="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::ID, true) ?>" name="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::ID, true) ?>" value="<?php echo (isset($edit) and $edit) ? $SalidainsumoDetalle->$id : '' ?>">
      </div>
    </div>
  <?php endif ?>

  <div class="form-group">
    <label for="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::OBSERVACION, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('observacion') ?></label>
    <div class="col-sm-10">
      <textarea class="form-control" rows="3" id="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::OBSERVACION, true) ?>" name="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::OBSERVACION, true) ?>"> <?php echo (isset($edit) and $edit) ? $SalidainsumoDetalle->$observacion : ((isset($SalidaInsumoDetalleForm[$observacion])) ? $SalidaInsumoDetalleForm[$observacion] : '') ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-right">
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumo', 'detail', array(salidaInsumoDetalleTableClass::ID => (isset($edit) and $edit) ? $SalidainsumoDetalle->$salidaIn : $idsal)) ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> <?php echo i18nClass::__('volver') ?></a>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
      <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumo', 'detail', array(salidaInsumoDetalleTableClass::ID => (isset($edit) and $edit) ? $SalidainsumoDetalle->$salidaIn : $idsal)) ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i>  <?php echo i18nClass::__('cancelar') ?></a>
    </div>
  </div>
  <?php if (isset($edit) === true and $edit === true): ?>
    <input type="hidden" id="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::ID, true) ?>" name="<?php echo salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::ID, true) ?>" value="<?php echo $SalidainsumoDetalle->$id ?>">
  <?php endif; ?>
</form>
<script>
  function traerInsumos(url, select) {
//        alert('&lote=' + $(select).find('option:selected').data('idlote'));
    if ($(select).val() == 0) {
      $('.ajaxLoad').children().remove().end().append('<option selected value="0">Seleccione una bodega aa</option>');
      $('.ajaxLoad').addClass('disabled').attr('disabled', 'true');
    } else {
      $.ajax({
        url: url,
        data: 'id=' + $(select).find('option:selected').data('idboclasi') + '&lote=' + $(select).find('option:selected').data('idlote'),
        dataType: 'json',
        type: 'POST',
        success: function(data) {
//                    data = {
//                        datos: [
//                            {id: 1, insumo: 'Julian'},
//                            {id: 2, insumo: 'Jhonny'}
//                        ]
//                    };
          $('.ajaxLoad').children().remove().end().append('<option selected value="0">Seleccione</option>');
          $(data.datos).each(function(index, value) {
            $('.ajaxLoad').append('<option data-idclasi="'+ $(select).find('option:selected').data('idboclasi') +'" data-idlote="'+ $(select).find('option:selected').data('idlote') + '" data-idsalinsu="'+ $(select).find('option:selected').data('idsalinsu') +'" value="' + value.id + '">' + value.insumo + '</option>');
          });
          $('.ajaxLoad').removeClass('disabled').removeAttr('disabled');
        }
      });
    }
  }
  
  function ValidarCantidadInsumo(url, select) {
//        alert('idinsumo=' + $(select).find('option:selected').val());
//        exit();
    if ($(select).val() == 0) {
      $('.ajaxLoadCant').children().remove().end();
    } else {
      $.ajax({
        url: url,
        data: 'id=' + $(select).find('option:selected').val() + '&lote=' + $(select).find('option:selected').data('idlote') + '&idclasi=' + $(select).find('option:selected').data('idclasi')+ '&idsalinsu=' + $(select).find('option:selected').data('idsalinsu'),
        dataType: 'json',
        type: 'POST',
        success: function(data) {
//                    data = {
//                        datos: [
//                            {id: 1, insumo: 'Julian'},
//                            {id: 2, insumo: 'Jhonny'}
//                        ]
//                    };
          $('.ajaxLoadCant').children().remove().end();
          $(data.datos).each(function(index, value) {
            if(value.disponible == null){
              value.disponible=value.cantidad;
            }
//            $('.ajaxLoadCant').append('<input type="text" value="'+ value.idbodega +'">');
            $('.ajaxLoadCant').append('<div class="alert alert-info alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><i class="glyphicon glyphicon-info-sign"></i> <strong>Información!</strong> Cantidad disponible de '+ value.insumo +' en Bodega: '+ value.disponible +'</div>');
          });
//          $('.ajaxLoadCant').removeClass('disabled').removeAttr('disabled');
        }
      });
    }
  }
</script>