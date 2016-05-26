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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::ID, true));
                $nombre = request::getInstance()->getPost(tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::NOMBRE, true));
                $observacion = request::getInstance()->getPost(tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::OBSERVACION, true));

                /**
                 * VALIDACIONES
                 */
                // usuarioTableClass::USER_LENGTH
                //
                $this->Validations($nombre, $observacion);
                /* ------------- */

                $ids = array(
                    tipoDesinfeccionTableClass::ID => $id
                );

                $data = array(
                    tipoDesinfeccionTableClass::NOMBRE => $nombre,
                    tipoDesinfeccionTableClass::OBSERVACION => $observacion
                );
                tipoDesinfeccionTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Actualización exitosa');

                routing::getInstance()->redirect('tipoDesinfeccion', 'index');
            } else {
                routing::getInstance()->redirect('tipoDesinfeccion', 'index');
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El cargo que intenta registar ya existe en la base de datos');
                    break;
                case 00006:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                case '22P02':
                    session::getInstance()->setWarning('Ingresar datos validos');
                    break;
                default:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
            }
            routing::getInstance()->redirect('tipoDesinfeccion', 'edit', array(tipoDesinfeccionTableClass::ID => $id));
            //routing::getInstance()->forward('security', 'new');
        }
    }

    private function Validations($nombre, $observacion) {
        if (strlen($nombre) > 4) {
            throw new PDOException('El nombre  no puede ser mayor a ' . tipoDesinfeccionTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
        }

        if ($nombre === "") {
            throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
        }

//        if (!ereg("^[A-Za-z_]*$", $nombre)) {
//            throw new PDOException('El campo Nombre no puede contener caracteres numericos', 00008);
//        }

        if (strlen($observacion) > 4) {
            throw new PDOException('Las observaciones  no pueden ser mayor a ' . tipoDesinfeccionTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
        }
    }

}
