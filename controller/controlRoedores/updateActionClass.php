<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
  @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com> */
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::ID, true));
                $admin = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::ID, true));
                $vete = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true));
                $respon = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::ID, true));
                $fechare = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true));
                $insumo = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID, true));
                $pellets = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::PELLETS, true));
                $bloques = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::BLOQUES, true));
                $eviconsu = (request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EVIDENCIA_CONSUMO, true))) ? request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EVIDENCIA_CONSUMO, true)) : 'f' ;
                $lugar = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::LUGAR, true));
                $observacion = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::OBSERVACION, true));

                 /**
                 * VALIDACIONES
                 */
                // usuarioTableClass::USER_LENGTH
                //
                $this->Validations($fechare, $insumo, $pellets, $bloques, $eviconsu, $lugar, $observacion);
                /* ------------- */
                
                $ids = array(
                    controlRoedoresTableClass::ID => $id
                );

                $data = array(
                    controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR => $admin,
                    controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO => $vete,
                    controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE => $respon,
                    controlRoedoresTableClass::FECHA_REALIZACION => $fechare,
                    controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID => $insumo,
                    controlRoedoresTableClass::PELLETS => $pellets,
                    controlRoedoresTableClass::BLOQUES => $bloques,
                    controlRoedoresTableClass::EVIDENCIA_CONSUMO => $eviconsu,
                    controlRoedoresTableClass::LUGAR => $lugar,
                    controlRoedoresTableClass::OBSERVACION => $observacion
                );

                controlRoedoresTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Actualización exitosa');

                routing::getInstance()->redirect('controlRoedores', 'index');
            } else {
                routing::getInstance()->redirect('controlRoedores', 'index');
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El control Roedores que intenta registar ya existe en la base de datos');
                    break;
                case 00006:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
//                case '22P02':
//                    session::getInstance()->setWarning('Ingresar datos validos');
//                    break;
                default:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
            }
            routing::getInstance()->redirect('controlRoedores', 'edit', array(controlRoedoresTableClass::ID => $id));
            //routing::getInstance()->forward('security', 'new');
        }
    }

    private function Validations($fechare, $insumo, $pellets, $bloques, $eviconsu, $lugar, $observacion) {
        
        if (strtotime($fechare) > strtotime(date('Y-m-d H:i:s'))) {
            throw new PDOException('FECHA MAYOR');
        }
        if (!is_numeric($insumo)) {
            throw new PDOException('El campo Numero De Salida solo puede contener caracteres numericos', 00008);
        }
        if ($insumo === "") {
            throw new PDOException('El campo Numero De Salida no puede ir Vacio', 00006);
        }
        if (!is_numeric($pellets)) {
            throw new PDOException('El campo Pellets solo puede contener caracteres numericos', 00006);
        }
        if ($pellets === "") {
            throw new PDOException('El campo Pellets no puede ir Vacio', 00008);
        }
        if (!is_numeric($bloques)) {
            throw new PDOException('El campo Bloques solo puede contener caracteres numericos', 00006);
        }
        if ($bloques === "") {
            throw new PDOException('El campo Bloques no puede ir Vacio', 00008);
        }
        if ($eviconsu === "") {
            throw new PDOException('El campo Evidencia De Consumo no puede ir Vacio', 00007);
        }
        if (strlen($lugar) > controlRoedoresTableClass::LUGAR_LENGTH) {
            throw new PDOException('El Lugar  no puede ser mayor a ' . controlRoedoresTableClass::LUGAR_LENGTH . ' caracteres', 00006);
        }

        if ($lugar === "") {
            throw new PDOException('El campo Lugar no puede ir Vacio', 00007);
        }
        if (strlen($observacion) > controlRoedoresTableClass::OBSERVACION_LENGTH) {
            throw new PDOException('Las observaciones  no pueden ser mayor a ' . controlRoedoresTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
        }
    }

}
