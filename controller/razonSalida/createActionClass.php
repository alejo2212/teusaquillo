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
class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $razon = request::getInstance()->getPost(razonSalidaTableClass::getNameField(razonSalidaTableClass::RAZON, true));
                $observacion = request::getInstance()->getPost(razonSalidaTableClass::getNameField(razonSalidaTableClass::OBSERVACION, true));

                $post = array(
                    razonSalidaTableClass::RAZON => $razon,
                    razonSalidaTableClass::OBSERVACION => $observacion
                );
                session::getInstance()->setAttribute('form', $post);
                //        if (filter_var($nombre, FILTER_VALIDATE_INT)) {
//          throw new PDOException('no pueden llevar el Nombre campos numericos', 00008);
//          echo "entro";
//        }
                /**
                 * VALIDACIONES
                 */
                // usuarioTableClass::USER_LENGTH
                $this->Validations($razon, $observacion);
                /* ------------- */

                session::getInstance()->setAttribute(razonSalidaTableClass::getNameField(razonSalidaTableClass::RAZON, true), $razon);


                $data = array(
                    razonSalidaTableClass::RAZON => $razon,
                    razonSalidaTableClass::OBSERVACION => $observacion
                );
                razonSalidaTableClass::insert($data);
                session::getInstance()->setSuccess('Registro exitoso');

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
            routing::getInstance()->redirect('razonSalida', 'new');
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
