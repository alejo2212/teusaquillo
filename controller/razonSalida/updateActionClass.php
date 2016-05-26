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
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(razonSalidaTableClass::getNameField(razonSalidaTableClass::ID, true));
                $razon = request::getInstance()->getPost(razonSalidaTableClass::getNameField(razonSalidaTableClass::RAZON, true));
                $observacion = request::getInstance()->getPost(razonSalidaTableClass::getNameField(razonSalidaTableClass::OBSERVACION, true));

                /**
                 * VALIDACIONES
                 */
                // usuarioTableClass::USER_LENGTH
                $this->Validations($razon, $observacion);
                /* ------------- */

                $ids = array(
                    razonSalidaTableClass::ID => $id
                );

                $data = array(
                    razonSalidaTableClass::RAZON => $razon,
                    razonSalidaTableClass::OBSERVACION => $observacion
                );
                razonSalidaTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Actualización exitosa');

                routing::getInstance()->redirect('razonSalida', 'index');
            } else {
                routing::getInstance()->redirect('razonSalida', 'index');
            }
            session::getInstance()->deleteAttribute('form');
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
                    session::getInstance()->setError($exc->getMessage());
                    break;
            }
            routing::getInstance()->redirect('razonSalida', 'edit', array(razonSalidaTableClass::ID => $id));
            //routing::getInstance()->forward('security', 'new');
        }
    }

    private function Validations($razon, $observacion) {
        if (strlen($razon > razonSalidaTableClass::RAZON_LENGTH)) {
            throw new PDOException('El nombre  no pude ser mayor a ' . razonSalidaTableClass::RAZON_LENGTH . ' caracteres', 00006);
//                    Esto 3 if para validar varchar
        }
        if ($razon === "") {
            throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
        }

        if (strlen($observacion > razonSalidaTableClass::OBSERVACION_LENGTH)) {
            throw new PDOException('La observacion  no pude ser mayor a ' . razonSalidaTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
        }
        if ($razon === "") {
            throw new PDOException('El campo Razon  no puede ir Vacio', 00007);
        }
    }

}
