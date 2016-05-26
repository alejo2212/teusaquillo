<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<?php use mvc\config\configClass as config ?>
<?php

use mvc\i18n\i18nClass ?>
<?php
use mvc\translator\translatorClass AS translator ?>

<?php $id = empleadoTableClass::ID ?>
<?php $fechaingre = empleadoTableClass::FEHCA_INGRESO ?>
<?php $tipoid = empleadoTableClass::TIPO_ID ?>
<?php $idCiudad = empleadoTableClass::LOCALIZACION_ID ?>
<?php $idCargo = empleadoTableClass::CARGO ?>
<?php $nomUser = empleadoTableClass::USUARIO_ID ?>
<?php $documento = empleadoTableClass::DOCUMENTO ?>
<?php $nom = empleadoTableClass::NOMBRE ?>
<?php $ape = empleadoTableClass::APELLIDO ?>
<?php $tel = empleadoTableClass::TELEFONO ?>
<?php $dir = empleadoTableClass::DIRECCION ?>
<?php $correo = empleadoTableClass::CORREO ?>
<?php $genero = empleadoTableClass::GENERO ?>
<?php $activado = empleadoTableClass::ACTIVO ?>
<?php $foto = empleadoTableClass::FOTO ?>
<div class="container container-fluid">
    <fieldset>
        <legend><h1><i class="fa fa-bookmark"></i> <?php echo i18nClass::__('empleado') ?> "<?php echo $objEmpleado->$nom ?>"</h1></legend>
        <div class="row">
            <div class="col-sm-6 col-md-2">
                <a href="#" class="thumbnail">
                    <img class="img-responsive img-thumbnail" style="width: 70px; height: 90px" src="<?php echo config::getUrlBase() . 'upload/' . $objEmpleado->$foto ?>" alt="...">
                </a>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Fecha de Ingreso</h4>
                <p class="list-group-item-text"><?php echo ($objEmpleado->$fechaingre) ? translator::translateDate(date('l j \d\e F \d\e Y \a \l\a\s h:i:s a', strtotime($objEmpleado->$fechaingre))) : 'No Registrada' ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Apellido</h4>
                <p class="list-group-item-text"><?php echo $objEmpleado->$ape ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Tipo de Identificacion</h4>
                <p class="list-group-item-text"><?php echo tipoIdentificacionTableClass::getTipoid($objEmpleado->$tipoid) ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Numero de Documento</h4>
                <p class="list-group-item-text"><?php echo $objEmpleado->$documento ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Genero</h4>
                <p class="list-group-item-text"><?php echo ($objEmpleado->$genero == 'F') ? 'Femenino' : 'Masculino' ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Telefono</h4>
                <p class="list-group-item-text"><?php echo $objEmpleado->$tel ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Direccion</h4>
                <p class="list-group-item-text"><?php echo $objEmpleado->$dir ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Correo</h4>
                <p class="list-group-item-text"><?php echo ($objEmpleado->$correo) ? $objEmpleado->$correo : '*** No Tiene Correo Electronico ***' ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Cargo</h4>
                <p class="list-group-item-text"><?php echo cargoTableClass::getCargoById($objEmpleado->$idCargo) ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Ciudad de Residencia</h4>
                <p class="list-group-item-text"><?php echo localidadTableClass::getLocalidadById($objEmpleado->$idCiudad) ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Tipo de Usuario</h4>
                <p class="list-group-item-text"><?php echo usuarioTableClass::getUserNameById($objEmpleado->$nomUser) ?></p>
            </div>
        </div>
        <div class="list-group">
            <div class="list-group-item">
                <h4 class="list-group-item-heading">Estado</h4>
                <p class="list-group-item-text"><?php echo ($objEmpleado->$activado) ? 'Activo' : 'Inactivo' ?></p>
            </div>
        </div>
    </fieldset>
    <div class="text-right">
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
        <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'edit', array($id => $objEmpleado->$id)) ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Editar</a>
    </div>
</div>