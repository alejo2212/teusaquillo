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

                $id = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::ID, true));
                $admin = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::ID, true));
                $vete = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true));
                $respon = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::ID, true));
                $fechare = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true));
                $insumo = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID, true));
                $solucion = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::SOLUCION, true));
                $formapli = request::getInstance()->getPost(formaAplicacionTableClass::getNameField(formaAplicacionTableClass::ID, true));
                $aretrata = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::AREA_TRATADA, true));
                $observacion = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::OBSERVACION, true));
                
                /**
                 * VALIDACIONES
                 */
                // usuarioTableClass::USER_LENGTH
                //
                $this->Validations($fechare, $insumo, $solucion, $formapli, $aretrata, $observacion);
                /* ------------- */
               
                $ids = array(
                    controlCucarronTableClass::ID => $id
                );

                $data = array(
                    controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR => $admin,
                    controlCucarronTableClass::EMPLEADO_ID_VETERINARIO => $vete,
                    controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE => $respon,
                    controlCucarronTableClass::FECHA_REALIZACION => $fechare,
                    controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID => $insumo,
                    controlCucarronTableClass::SOLUCION => $solucion,
                    controlCucarronTableClass::FORMA_APLICACION_ID => $formapli,
                    controlCucarronTableClass::AREA_TRATADA => $aretrata,
                    controlCucarronTableClass::OBSERVACION => $observacion
                );

                controlCucarronTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Actualización exitosa');

                routing::getInstance()->redirect('controlCucarron', 'index');
            } else {
                routing::getInstance()->redirect('controlCucarron', 'index');
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El cargo que intenta registar ya existe en la base de datos');
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
            routing::getInstance()->redirect('controlCucarron', 'edit', array(controlCucarronTableClass::ID => $id));
            //routing::getInstance()->forward('security', 'new');
        }
    }

    private function Validations($fechare, $insumo, $solucion, $formapli, $aretrata, $observacion) {
         if (strtotime($fechare) > strtotime(date('Y-m-d H:i:s'))) {
            throw new PDOException('FECHA MAYOR');
        }
        if (!is_numeric($insumo)) {
            throw new PDOException('El campo Numero De Salida solo puede contener caracteres numericos', 00008);
        }
        if ($insumo === "") {
            throw new PDOException('El campo Numero De Salida no puede ir Vacio', 00006);
        }
        if (strlen($solucion) > 4) {
            throw new PDOException('La Solucion  no puede ser mayor a ' . controlCucarronTableClass::SOLUCION_LENGTH . ' caracteres', 00006);
        }

        if ($solucion === "") {
            throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
        }
        if ($formapli === "") {
            throw new PDOException('El campo Forma De Aplicacion no puede ir Vacio', 00008);
        }
        if (!is_numeric($aretrata)) {
            throw new PDOException('El campo Area Tratada solo puede contener caracteres numericos', 00006);
        }
        if ($aretrata === "") {
            throw new PDOException('El campo Area Tratada no puede ir Vacio', 00007);
        }
        if (strlen($observacion) > 4) {
            throw new PDOException('Las observaciones  no pueden ser mayor a ' . controlCucarronTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
        }
    }

}
