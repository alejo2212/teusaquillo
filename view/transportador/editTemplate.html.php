<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\i18n\i18nClass ?>
<div class="container container-fluid">
                <?php \mvc\view\viewClass::includeHandlerMessage() ?><!-- esto los mensajes de error,exitos,y demas operaciones-->
    <fieldset>
        <legend><h1><i class="fa fa-edit"></i><?php echo i18nClass::__('EditarTransportador') ?></h1></legend>
<?php \mvc\view\viewClass::includePartial('transportador/formtransportador', array('edit' => $edit, 'objtransportador' => $objtransportador)) ?>
    </fieldset>
</div>