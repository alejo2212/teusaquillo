<?php

use mvc\translator\translatorClass AS translator ?>
<?php

use mvc\config\configClass as config ?>
<?php
use mvc\i18n\i18nClass ?>
<?php
use mvc\session\sessionClass as session ?>
<?php $id = loteTableClass::ID ?>
<?php $nlote = loteTableClass::LOTE ?>
<?php $fEntradaG = loteTableClass::FECHA_ENTRADA_GRANJA ?>
<?php $fSalidaEs = loteTableClass::FECHA_SALIDA_ESTIPULADA ?>
<?php $fSalidaR = loteTableClass::FECHA_SALIDA_REAL ?>
<?php $razaId = loteTableClass::RAZA_ID ?>
<?php $pesoPm = loteTableClass::PESO_PROMEDIO_MACHOS ?>
<?php $pesoPh = loteTableClass::PESO_PROMEDIO_HEMBRAS ?>
<?php $cantM = loteTableClass::CANTIDAD_MACHOS ?>
<?php $cantH = loteTableClass::CANTIDAD_HEMBRAS ?>
<?php $cantT = loteTableClass::CANTIDAD_TOTAL ?>
<?php $fEntradaProduc = loteTableClass::FECHA_ENTRA_PRODUCCION ?>
<?php $observacion = loteTableClass::OBSERVACION ?>
<?php $empleId = loteTableClass::EMPLEADO_ID ?>
<?php $idraza = razaTableClass::ID ?>
<?php $nraza = razaTableClass::NOMBRE ?>
<?php $idEmpleado = empleadoTableClass::ID ?>
<?php $nombreEmpleado = empleadoTableClass::NOMBRE ?>
<?php $loteForm = session::getInstance()->getFlash('lote') ?>


<form class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('lote', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
    <div class="row">
        <div id="bloque1" class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::LOTE, true) ?>"><?php echo i18nClass::__('lote') ?></label>
                <input type="text" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::LOTE, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::LOTE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $lote->$nlote : ((isset($loteForm[$nlote])) ? $loteForm[$nlote] : '') ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div id="bloque1" class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::EMPLEADO_ID, true) ?>">Empleado quien recibe</label>
                <select id="<?php echo loteTableClass::getNameField(loteTableClass::EMPLEADO_ID, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::EMPLEADO_ID, true) ?>" class="form-control">
                    <option value="">Seleccione</option>
                    <?php foreach ($objEmpleado as $dataEmple): ?>
                        <option  <?php echo (((isset($edit) and $edit) and ( $lote->$empleId == $dataEmple->$idEmpleado )) ? 'selected ' : ((isset($loteForm[$empleId]) and ( $loteForm[$empleId] == $dataEmple->$idEmpleado)) ? 'selected ' : '') ) ?> value="<?php echo $dataEmple->$idEmpleado ?>"><?php echo $dataEmple->$nombreEmpleado ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) ?>"><?php echo i18nClass::__('fechaSalidaEstipulada') ?> </label>
                <input type="text" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) ?>"  value="<?php echo (isset($edit) and $edit) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($lote->$fSalidaEs))) : ((isset($loteForm[$fSalidaEs])) ? $loteForm[$fSalidaEs] : '') ?>" disabled="disabled">
            </div>
            <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) ?>"><?php echo i18nClass::__('fechaEntradaProduccion') ?></label>
                <input type="datetime-local" class="form-control"  id="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) ?>" value="<?php echo (isset($edit) and $edit) ? ($lote->$fEntradaProduc)?strftime('%Y-%m-%dT%H:%M:%S', strtotime($lote->$fEntradaProduc)):'' : ((isset($loteForm[$fEntradaProduc])) ? $loteForm[$fEntradaProduc] : '') ?>">
            </div>

            <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::CANTIDAD_HEMBRAS, true) ?>"><?php echo i18nClass::__('cantidadHembras') ?></label>
                <input type="text" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::CANTIDAD_HEMBRAS, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::CANTIDAD_HEMBRAS, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $lote->$cantH : ((isset($loteForm[$cantH])) ? $loteForm[$cantH] : '') ?>">
            </div>
            <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::CANTIDAD_MACHOS, true) ?>"><?php echo i18nClass::__('cantidadMachos') ?></label>
                <input type="text" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::CANTIDAD_MACHOS, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::CANTIDAD_MACHOS, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $lote->$cantM : ((isset($loteForm[$cantM])) ? $loteForm[$cantM] : '') ?>">
            </div>
        </div><!-- /.bloque 1. -->

        <div id="bloque2" class="col-lg-6 col-md-6 col-sm-6"><!-- INICIO /.bloque 2. -->
           
            <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) ?>"><?php echo i18nClass::__('fechaEntradaGranja') ?> </label>
                <input type="datetime-local" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) ?>" required value="<?php echo (isset($edit) and $edit) ? ($lote->$fEntradaG)?strftime('%Y-%m-%dT%H:%M:%S', strtotime($lote->$fEntradaG)):'' : ((isset($loteForm[$fEntradaG])) ? $loteForm[$fEntradaG] : '') ?>">
            </div>
            <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) ?>"><?php echo i18nClass::__('fechaSalidaReal') ?> </label>
                <input type="datetime-local" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) ?>" value="<?php echo (isset($edit) and $edit) ? ($lote->$fSalidaR)?strftime('%Y-%m-%dT%H:%M:%S', strtotime($lote->$fSalidaR)):'' : ((isset($loteForm[$fSalidaR])) ? $loteForm[$fSalidaR] : '') ?>">
            </div>
            <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::RAZA_ID, true) ?>"><?php echo i18nClass::__('raza') ?></label>
                <select id="<?php echo loteTableClass::getNameField(loteTableClass::RAZA_ID, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::RAZA_ID, true) ?>" class="form-control">
                    <option value=""><?php echo i18nClass::__('seleccione') ?></option>
                    <?php foreach ($objRaza as $dataRaza): ?>
                        <option  <?php echo (((isset($edit) and $edit) and ( $lote->$razaId == $dataRaza->$idraza )) ? 'selected ' : ((isset($loteForm[$razaId]) and ( $loteForm[$razaId] == $dataRaza->$idraza)) ? 'selected ' : '') ) ?>  value="<?php echo $dataRaza->$idraza ?>">  <?php echo $dataRaza->$nraza ?></option>
                    <?php endforeach; ?>
                </select>
            </div> 

            <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::PESO_PROMEDIO_HEMBRAS, true) ?>"><?php echo i18nClass::__('pesoPromedioHembras') ?> (grms)</label>
                <input type="text" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::PESO_PROMEDIO_HEMBRAS, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::PESO_PROMEDIO_HEMBRAS, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $lote->$pesoPh : ((isset($loteForm[$pesoPh])) ? $loteForm[$pesoPh] : '') ?>">
            </div>
            <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::PESO_PROMEDIO_MACHOS, true) ?>"><?php echo i18nClass::__('pesoPromedioMachos') ?> (grms)</label>
                <input type="text" class="form-control" id="<?php echo loteTableClass::getNameField(loteTableClass::PESO_PROMEDIO_MACHOS, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::PESO_PROMEDIO_MACHOS, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $lote->$pesoPm : ((isset($loteForm[$pesoPm])) ? $loteForm[$pesoPm] : '') ?>">
            </div>


        </div><!-- /.bloque 2. -->
    </div>
    <div class="row">
        <div id="bloque1" class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label for="<?php echo loteTableClass::getNameField(loteTableClass::OBSERVACION, true) ?>"><?php echo i18nClass::__('observacion') ?></label>
                <textarea class="form-control" rows="3" id="<?php echo loteTableClass::getNameField(loteTableClass::OBSERVACION, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::OBSERVACION, true) ?>"><?php echo (isset($edit) and $edit) ? $lote->$observacion : ((isset($loteForm[$observacion])) ? $loteForm[$observacion] : '') ?></textarea>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('lote', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i><?php echo i18nClass::__('volver') ?> </a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('lote', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i><?php echo i18nClass::__('cancelar') ?></a>
        </div>
    </div>
    <?php if (isset($edit) === true and $edit === true): ?>
        <input type="hidden" id="<?php echo loteTableClass::getNameField(loteTableClass::ID, true) ?>" name="<?php echo loteTableClass::getNameField(loteTableClass::ID, true) ?>" value="<?php echo $lote->$id ?>">
    <?php endif; ?>
</form>
