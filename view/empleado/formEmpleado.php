<?php

use mvc\i18n\i18nClass ?>
<?php
use mvc\session\sessionClass as session ?>
<?php
use mvc\config\configClass as config ?>
<?php $empleadoForm = session::getInstance()->getFlash('empleado') ?>
<?php $id = tipoIdentificacionTableClass::ID ?>
<?php $nombre = tipoIdentificacionTableClass::DESCRIPCION ?>
<?php $idCiudad = localidadTableClass::ID ?>
<?php $ciudadId = localidadTableClass::LOCALIDAD_ID ?>
<?php $nombreCiudad = localidadTableClass::NOMBRE ?>
<?php $cargoId = cargoTableClass::ID ?>
<?php $cargoNombre = cargoTableClass::NOMBRE ?>
<?php $idUser = usuarioTableClass::ID ?>
<?php $nomUser = usuarioTableClass::USER ?>
<?php $idem = empleadoTableClass::ID ?>
<?php $fechaingre = empleadoTableClass::FEHCA_INGRESO ?>
<?php $tipoid = empleadoTableClass::TIPO_ID ?>
<?php $ciudad = empleadoTableClass::LOCALIZACION_ID ?>
<?php $cargo = empleadoTableClass::CARGO ?>
<?php $usuario = empleadoTableClass::USUARIO_ID ?>
<?php $documento = empleadoTableClass::DOCUMENTO ?>
<?php $nom = empleadoTableClass::NOMBRE ?>
<?php $ape = empleadoTableClass::APELLIDO ?>
<?php $tel = empleadoTableClass::TELEFONO ?>
<?php $dir = empleadoTableClass::DIRECCION ?>
<?php $correo = empleadoTableClass::CORREO ?>
<?php $genero = empleadoTableClass::GENERO ?>
<?php $activado = empleadoTableClass::ACTIVO ?>
<?php $foto = empleadoTableClass::FOTO ?>

<?php
$fechahoy = strftime('%Y-%m-%dT%H:%M:%S', strtotime(date(config::getFormatTimestamp())));
$newLeng = strlen($fechahoy) - 3;
$fechahoy = substr($fechahoy, 0, $newLeng);
?>
<?php // print_r($objDeptos) ?>
<form enctype="multipart/form-data" class="form-horizontal" role="form" action="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', (isset($edit) === true and $edit === true) ? 'update' : 'create') ?>" method="post">
    <div class="form-group">
        <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::FEHCA_INGRESO, true) ?>" class="col-sm-3 control-label">Fecha de Ingreso</label>
        <div class="col-sm-9">
            <input type="datetime-local" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::FEHCA_INGRESO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::FEHCA_INGRESO, true) ?>" value="<?php echo (isset($edit) and $edit) ? ($objEmpleado->$fechaingre) ? strftime('%Y-%m-%dT%H:%M:%S', strtotime($objEmpleado->$fechaingre)) : $fechahoy : ((isset($empleadoForm[$fechaingre])) ? $empleadoForm[$fechaingre] : $fechahoy) ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="<?php echo tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DESCRIPCION, true) ?>" class="col-sm-3 control-label">Tipo de Identificacion</label>
        <div class="col-sm-9">
            <select class="form-control" name="<?php echo tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ID, true) ?>" id="<?php echo tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objTipoid as $data): ?>

                    <option <?php echo (((isset($edit) and $edit) and ( $objEmpleado->$tipoid == $data->$id)) ? 'selected ' : ((isset($empleadoForm[$tipoid]) and ( $empleadoForm[$tipoid] == $data->$id)) ? 'selected ' : '')) ?>value="<?php echo $data->$id ?>"><?php echo $data->$nombre ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true) ?>" class="col-sm-3 control-label">Numero de Documento</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objEmpleado->$documento : ((isset($empleadoForm[$documento])) ? $empleadoForm[$documento] : '') ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID, true) ?>" class="col-sm-3 control-label">Departamento</label>
        <div class="col-sm-9">
            <select onchange="traerCiudades('<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'ajaxTraerCiudades') ?>', this)" class="form-control" name="<?php echo localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID, true) ?>" id="<?php echo localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID, true) ?>">
                <option value="0">Seleccione</option>
                <?php foreach ($objDeptos as $dataDepto): ?>
                    <?php if ($dataDepto->$ciudadId === null): ?>
                        <option data-iddepto="<?php echo $dataDepto->$idCiudad ?>" value="<?php echo $dataDepto->$idCiudad ?>"><?php echo $dataDepto->$nombreCiudad ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo localidadTableClass::getNameField(localidadTableClass::ID, true) ?>" class="col-sm-3 control-label">Ciudad</label>
        <div class="col-sm-9">
            <select name="<?php echo localidadTableClass::getNameField(localidadTableClass::ID, true) ?>" id="<?php echo localidadTableClass::getNameField(localidadTableClass::ID, true) ?>" class="form-control ajaxLoad disabled" disabled>
                <option value="0">Seleccione un Departamento</option>

                <?php // foreach ($objCiudad as $dataciu): ?>
                <?php // if ($dataciu->$ciudadId != null): ?>
    <!--<option <?php echo (((isset($edit) and $edit) and ( $objEmpleado->$ciudad == $dataciu->$idCiudad)) ? 'selected ' : ((isset($empleadoForm[$ciudad]) and ( $empleadoForm[$ciudad] == $dataciu->$idCiudad)) ? 'selected ' : '')) ?>value="<?php echo $dataciu->$idCiudad ?>"><?php echo $dataciu->$nombreCiudad ?></option>-->
                <?php // endif; ?>
                <?php // endforeach; ?>

            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo cargoTableClass::getNameField(cargoTableClass::ID, true) ?>" class="col-sm-3 control-label">Cargo</label>
        <div class="col-sm-9">
            <select class="form-control" name="<?php echo cargoTableClass::getNameField(cargoTableClass::ID, true) ?>" id="<?php echo cargoTableClass::getNameField(cargoTableClass::ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objCargo as $datacargo): ?>
                    <option <?php echo (((isset($edit) and $edit) and ( $objEmpleado->$cargo == $datacargo->$cargoId )) ? 'selected ' : ((isset($empleadoForm[$cargo]) and ( $empleadoForm[$cargo] == $datacargo->$cargoId)) ? 'selected ' : '')) ?>value="<?php echo $datacargo->$cargoId ?>"><?php echo $datacargo->$cargoNombre ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>" class="col-sm-3 control-label">Nombre</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objEmpleado->$nom : ((isset($empleadoForm[$nom])) ? $empleadoForm[$nom] : ((isset($empleadoForm[$nom])) ? $empleadoForm[$nom] : '')) ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" class="col-sm-3 control-label">Apellido</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objEmpleado->$ape : ((isset($empleadoForm[$ape])) ? $empleadoForm[$ape] : ((isset($empleadoForm[$ape])) ? $empleadoForm[$ape] : '')) ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true) ?>" class="col-sm-3 control-label">Telefono</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objEmpleado->$tel : ((isset($empleadoForm[$tel])) ? $empleadoForm[$tel] : ((isset($empleadoForm[$tel])) ? $empleadoForm[$tel] : '')) ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true) ?>" class="col-sm-3 control-label">Direccion</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true) ?>" required value="<?php echo (isset($edit) and $edit) ? $objEmpleado->$dir : ((isset($empleadoForm[$dir])) ? $empleadoForm[$dir] : ((isset($empleadoForm[$dir])) ? $empleadoForm[$dir] : '')) ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) ?>" class="col-sm-3 control-label">E-Mail</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::CORREO, true) ?>" value="<?php echo (isset($edit) and $edit) ? $objEmpleado->$correo : ((isset($empleadoForm[$correo])) ? $empleadoForm[$correo] : ((isset($empleadoForm[$correo])) ? $empleadoForm[$correo] : '')) ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::GENERO, true) ?>" class="col-sm-3 control-label">Genero</label>
        <div class="col-sm-9">
            <label class="radio-inline"><input type="radio" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::GENERO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::GENERO, true) ?>" value="M" <?php echo (isset($objEmpleado) and $objEmpleado->$genero == 'M') ? 'checked' : ((isset($empleadoForm[$genero]) and $empleadoForm[$genero] == 'M' ) ? 'checked' : '') ?>>Masculino</label>

            <label class="radio-inline"><input type="radio" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::GENERO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::GENERO, true) ?>" value="F" <?php echo (isset($objEmpleado) and $objEmpleado->$genero == 'F') ? 'checked' : ((isset($empleadoForm[$genero]) and $empleadoForm[$genero] == 'F') ? 'checked' : '') ?>>Femenino</label>
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::FOTO, true) ?>" class="col-sm-3 control-label"><?php echo i18nClass::__('foto') ?></label>
        <div class="col-sm-9">
            <input type="file" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::FOTO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::FOTO, true) ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID, true) ?>" class="col-sm-3 control-label">Tipo de Usuario</label>
        <div class="col-sm-9">
            <select class="form-control" name="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID, true) ?>" id="<?php echo usuarioTableClass::getNameField(usuarioTableClass::ID, true) ?>">
                <option value="">Seleccione</option>
                <?php foreach ($objUsuario as $datausu): ?>
                    <option <?php echo (((isset($edit) and $edit) and ( $objEmpleado->$usuario == $datausu->$idUser)) ? 'selected ' : ((isset($empleadoForm[$usuario]) and ( $empleadoForm[$usuario] == $datausu->$idUser)) ? 'selected ' : '')) ?>value="<?php echo $datausu->$idUser ?>" ><?php echo $datausu->$nomUser ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <?php if (isset($edit) and $edit): ?>
        <div class="form-group">
            <label for="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ACTIVO, true) ?>" class="col-sm-3 control-label"><?php echo i18nClass::__('activado') ?></label>
            <div class="col-sm-9 checkboxFlow">
                <input type="checkbox" class="form-control" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ACTIVO, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ACTIVO, true) ?>" value="t" <?php echo ($objEmpleado->$activado) ? 'checked' : '' ?>>
            </div>
        </div>
    <?php endif ?>
    <input type="hidden" id="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>" name="<?php echo empleadoTableClass::getNameField(empleadoTableClass::ID, true) ?>" value="<?php echo (isset($edit) and $edit) ? $objEmpleado->$idem : '' ?>">
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10 text-right">
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'index') ?>" class="btn btn-default btn-sm"><i class="fa fa-table fa-fw"></i> Volver</a>
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Registrar</button>
            <a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'index') ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
        </div>
    </div>
</form>
<script>
    function traerCiudades(url, select) {
//        alert('&Depto=' + $(select).find('option:selected').data('iddepto'));
        if ($(select).val() == 0) {
            $('.ajaxLoad').children().remove().end().append('<option selected value="0">Seleccione un Departamento aa</option>');
            $('.ajaxLoad').addClass('disabled').attr('disabled', 'true');
        }
        else {
            $.ajax({
                url: url,
                data: 'id=' + $(select).find('option:selected').data('iddepto'),
                dataType: 'json',
                type: 'POST',
                success: function (data) {
//                    data = {
//                        datos: [
//                            {id: 1, insumo: 'Julian'},
//                            {id: 2, insumo: 'Jhonny'}
//                        ]
//                    };
                    $('.ajaxLoad').children().remove().end().append('<option selected value="0">Seleccione</option>');
                    $(data.datos).each(function (index, value) {
                        $('.ajaxLoad').append('<option value="' + value.id + '">' + value.ciudad + '</option>');
                    });
                    $('.ajaxLoad').removeClass('disabled').removeAttr('disabled');
                }
            });
        }
    }
</script>