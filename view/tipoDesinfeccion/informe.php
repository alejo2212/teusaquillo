<!-- Modal -->
<div class="modal fade" id="myModalInforme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Generar Informe por: <?php echo $countPages ?></h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('tipoDesinfeccion', 'informe') ?>" target="_blank" class="form-horizontal" role="form">
        <div class="modal-body">

          <div class="form-group">
              <label for="<?php echo tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="<?php echo tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::NOMBRE, true) ?>" name="<?php echo tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::NOMBRE, true) ?>" placeholder="Nombre De Tipo Desinfeccion A Buscar">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Generar</button>
        </div>
      </form>
    </div>
  </div>
</div>