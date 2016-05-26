<?php use mvc\translator\translatorClass AS translator ?>
<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <?php $idEmp = empleadoTableClass::ID ?>
    <?php $nombreEmp = empleadoTableClass::NOMBRE ?>
    <?php $id = devolucionIncubadoraTableClass::ID ?>
    <?php $salidain = devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID ?>
    <?php $llegada = devolucionIncubadoraTableClass::CANTIDAD_LLEGADA ?>
    <?php $faltante = devolucionIncubadoraTableClass::CANTIDAD_FALTANTE ?>
    <?php $devolucion = devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION ?>
    <?php $fecha = devolucionIncubadoraTableClass::FECHA ?>
    <?php $empleado = devolucionIncubadoraTableClass::EMPLEADO ?>
    <legend><h1><i class="fa fa-bookmark"></i> Devolucion Incubadora </h1></legend>
<!--    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Numero de Salida</h4>
        <p class="list-group-item-text"><?php echo $objdevolucion->$salidain ?></p>
      </div>
    </div>-->
    <div class="panel-group" id="accordion">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
              <b><i class="fa fa-angle-double-down"> </i> Ver Salida de Incubadora numero <?php echo $objdevolucion->$salidain ?></b>
            </a>
          </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
          <div class="panel-body">
            <table class="table">
              <tr>
                <th>Cantidad</th>
                <th style="width: 50%;">Descripcion</th>
                <th>Tipo de Empaque</th>
                <th>Cantidad de Empaque</th>
              </tr>
              <tbody>
                <?php $datos = salidaDetalleIncubadoraTableClass::getDetalleByIdSalidaIncubadora($objdevolucion->$salidain) ?>
                <?php foreach ($datos as $data): ?>
                  <tr>
                    <td><?php echo $data->cantidad ?></td>
                    <td><?php echo $data->descripcion ?></td>
                    <td><?php echo $data->empaque ?></td>
                    <td><?php echo $data->cantidad_empaque ?></td>
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
        <h4 class="list-group-item-heading">Empleado</h4>
        <p class="list-group-item-text"><?php echo empleadoTableClass::getEmpleadoById($objdevolucion->$empleado) ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Cantidad de Devolucion Total</h4>
        <p class="list-group-item-text"><?php echo $objdevolucion->$devolucion ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Cantidad de Llegada</h4>
        <p class="list-group-item-text"><?php echo $objdevolucion->$llegada ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Cantidad Faltante</h4>
        <p class="list-group-item-text"><?php echo $objdevolucion->$faltante ?></p>
      </div>
    </div>
    <div class="list-group">
      <div class="list-group-item">
        <h4 class="list-group-item-heading">Fecha de la Devolucion</h4>
        <p class="list-group-item-text"><?php echo translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objdevolucion->$fecha))) ?></p>
      </div>
    </div>
    
  </fieldset>
  <div class="text-right">
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('devolucionIncubadora', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
    <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('devolucionIncubadora', 'edit', array($id => $objdevolucion->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
  </div>
</div>