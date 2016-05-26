<?php use mvc\translator\translatorClass AS translator ?>
<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <fieldset>
        <?php $id = bodegaTableClass::ID ?>
        <?php $lote = bodegaTableClass::LOTE_ID ?>
        <?php $clasibode = bodegaTableClass::BODEGA_CLASIFICACION_ID ?>
        <?php $insu = bodegaTableClass::INSUMO_ID ?>
        <?php $entrabode = bodegaTableClass::ENTRADA_BODEGA_ID ?>
        <?php $fechaven = bodegaTableClass::FECHA_VENCIMIENTO ?>
        <?php $cantida = bodegaTableClass::CANTIDAD ?>
        <?php $actived = bodegaTableClass::ACTIVO ?>
        <legend><h1><i class="fa fa-user"></i> Bodega "<?php echo $objbodega->$id . ' ' . bodegaClasificacionTableClass::getNombreById ($objbodega -> $clasibode) ?>"</h1></legend>

        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Numero de Lote</h4>
                <p class="list-group-item-text"><?php echo loteTableClass::getNombreById ($objbodega->$lote) ?></p>
            </div>
        </div>

        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Clasificacion de Bodega</h4>
                <p class="list-group-item-text"><?php echo bodegaClasificacionTableClass::getNombreById ($objbodega->$clasibode) ?></p>
            </div>
        </div>

        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Insumo</h4>
                <p class="list-group-item-text"><?php echo insumoTableClass::getNombreById ($objbodega->$insu) ?></p>
            </div>
        </div>

<!--        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Numero de entrada Bodega</h4>
                <p class="list-group-item-text"><?php echo $objbodega->$entrabode ?></p>
            </div>
        </div>-->
        
        <div class="panel-group" id="accordion">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
              <b><i class="fa fa-angle-double-down"> </i> Ver Entrada de Bodega numero <?php echo $objbodega->$entrabode ?> </b>
            </a>
          </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
          <div class="panel-body">
            <table class="table">
              <tr>
                <th style="width: 20%;">Empleado</th>
                <th style="width: 20%;">Conductor</th>
                <th>Fecha</th>
                <th>N° Remision</th>
              </tr>
              <tbody>
                <?php $datos = entradaBodegaTableClass::getEntradaById($objbodega->$entrabode) ?>
                <?php foreach ($datos as $data): ?>
                  <tr>
                    <td><?php echo $data->empleado ?></td>
                    <td><?php echo $data->conductor ?></td>
                    <td><?php echo ($data->fecha) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($data->fecha))) : 'No Registrada' ?></td>
                    <td><?php echo $data->remision ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Fecha de Vencimiento</h4>
                <p class="list-group-item-text"><?php echo ($objbodega->$fechaven) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objbodega->$fechaven))) : 'No Registrada' ?></p>
            </div>
        </div>

        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Cantida en Bodega</h4>
                <p class="list-group-item-text"><?php echo $objbodega->$cantida ?></p>
            </div>
        </div>

        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading"><?php echo i18nClass::__('activado') ?></h4>
                <p class="list-group-item-text"><?php echo ($objbodega->$actived) ? i18nClass::__('si') : i18nClass::__('no') ?></p>
            </div>
        </div>

    </fieldset>
    <div class="text-right">
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodega', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodega', 'edit', array($id => $objbodega->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
    </div>
</div>