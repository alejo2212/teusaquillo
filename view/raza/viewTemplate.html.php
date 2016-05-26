<?php use mvc\config\configClass as config ?>
<?php use mvc\i18n\i18nClass ?>
<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
    <fieldset>

        <?php $id = razaTableClass::ID ?>
        <?php $nombre = razaTableClass::NOMBRE ?>
        <?php $des = razaTableClass::DESCRIPCION ?>
        <?php $foto = razaTableClass::FOTO ?>

        <legend><h1><i class="fa fa-user"></i><?php echo i18nClass::__('nombre') ?>"<?php echo $raza->$nombre ?>"</h1></legend>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading"><?php echo i18nClass::__('descripcion') ?>Descripcion</h4>
                <p class="list-group-item-text"><?php echo $raza->$des ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <a href="#" class="thumbnail">
                    <img class="img-responsive img-thumbnail" style="width: 400px; height: 250px;" src="<?php echo config::getUrlBase() . 'upload/' . $raza->$foto ?>" alt="...">
                </a>
            </div>
        </div>
    </fieldset>
    <div class="text-right">
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('raza', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i><?php echo i18nClass::__('volver') ?> </a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('raza', 'edit', array($id => $raza->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i><?php echo i18nClass::__('editar') ?> </a>
    </div>
</div>