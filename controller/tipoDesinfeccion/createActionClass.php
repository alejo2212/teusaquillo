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
 * @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com>
 */
class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $nombre = request::getInstance()->getPost(tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::NOMBRE, true));
                $observacion = request::getInstance()->getPost(tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::OBSERVACION, true));

                $post = array(
                    tipoDesinfeccionTableClass::NOMBRE => $nombre,
                    tipoDesinfeccionTableClass::OBSERVACION => $observacion
                );
                session::getInstance()->setAttribute('form', $post);
               
                /**
                 * VALIDACIONES
                 */
                // usuarioTableClass::USER_LENGTH
                //
                $this->Validations($nombre, $observacion);
                /* ------------- */


                session::getInstance()->setAttribute(tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::NOMBRE, true), $nombre);


                $data = array(
                    tipoDesinfeccionTableClass::NOMBRE => $nombre,
                    tipoDesinfeccionTableClass::OBSERVACION => $observacion
                );
                tipoDesinfeccionTableClass::insert($data);
                session::getInstance()->setSuccess('Registro exitoso');

                routing::getInstance()->redirect('tipoDesinfeccion', 'index');
            } else {
                routing::getInstance()->redirect('tipoDesinfeccion', 'index');
            }
            session::getInstance()->deleteAttribute('form');
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El tipo Desinfeccion que intenta registar ya existe en la base de datos');
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
            routing::getInstance()->redirect('tipoDesinfeccion', 'new');
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
