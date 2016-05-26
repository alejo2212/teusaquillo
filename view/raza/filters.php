<!-- Modal -->
<?php use mvc\i18n\i18nClass ?>
<div class="modal fade" id="myModalFilter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo i18nClass::__('close') ?></span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Filtros <?php echo $countPages ?></h4>
      </div>
      <form method="post" action="<?php echo mvc\routing\routingClass::getInstance()->getUrlWeb('raza', 'index') ?>" class="form-horizontal" role="form">
        <div class="modal-body">

          <div class="form-group">
            <label for="<?php echo razaTableClass::getNameField(razaTableClass::NOMBRE, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('nombre') ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="<?php echo razaTableClass::getNameField(razaTableClass::NOMBRE, true) ?>" name="<?php echo razaTableClass::getNameField(razaTableClass::NOMBRE, true) ?>" placeholder="Raza a buscar">
            </div>
          </div>
          
            <div class="form-group">
            <label for="<?php echo razaTableClass::getNameField(razaTableClass::DESCRIPCION, true) ?>" class="col-sm-2 control-label"><?php echo i18nClass::__('descripcion') ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="<?php echo razaTableClass::getNameField(razaTableClass::NOMBRE, true) ?>" name="<?php echo razaTableClass::getNameField(razaTableClass::DESCRIPCION, true) ?>" placeholder=" Descripcion de Raza a buscar">
            </div>
          </div>
           </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18nClass::__('close') ?></button>
          <button type="submit" class="btn btn-primary"><?php echo i18nClass::__('filtrar') ?></button>
        </div>
      </form>
    </div>
  </div>
</div>