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

                $nombre = request::getInstance()->getPost(formaAplicacionTableClass::getNameField(formaAplicacionTableClass::NOMBRE, true));
                $descripcion = request::getInstance()->getPost(formaAplicacionTableClass::getNameField(formaAplicacionTableClass::DESCRIPCION, true));

                $post = array(
                    formaAplicacionTableClass::NOMBRE => $nombre,
                    formaAplicacionTableClass::DESCRIPCION => $descripcion
                );
                session::getInstance()->setAttribute('form', $post);
     
                /**
                 * VALIDACIONES
                 */
                // usuarioTableClass::USER_LENGTH
                $this->validations($nombre, $descripcion);
                /* ------------- */


                session::getInstance()->setAttribute(formaAplicacionTableClass::getNameField(formaAplicacionTableClass::NOMBRE, true), $nombre);

                $data = array(
                    formaAplicacionTableClass::NOMBRE => $nombre,
                    formaAplicacionTableClass::DESCRIPCION => $descripcion
                );
                formaAplicacionTableClass::insert($data);
                session::getInstance()->setSuccess('Registro exitoso');

                routing::getInstance()->redirect('formaAplicacion', 'index');
            } else {
                routing::getInstance()->redirect('formaAplicacion', 'index');
            }
            session::getInstance()->deleteAttribute('form');
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('La forma de Aplicacion que intenta registar ya existe en la base de datos');
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
            routing::getInstance()->redirect('formaAplicacion', 'new');
            //routing::getInstance()->forward('security', 'new');
        }
    }

    private function validations($nombre, $descripcion) {
        if (strlen($nombre) > 4) {
            throw new PDOException('El nombre  no puede ser mayor a ' . formaAplicacionTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
        }

        if ($nombre === "") {
            throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
        }

//        if (!ereg("^[A-Za-z_]*$", $nombre)) {
//            throw new PDOException('El campo Nombre no puede contener caracteres numericos', 00008);
//        }

        if (strlen($descripcion) > 4) {
            throw new PDOException('La descripcion  no puede ser mayor a ' . formaAplicacionTableClass::DESCRIPCION_LENGTH . ' caracteres', 00006);
        }

        if ($descripcion === "") {
            throw new PDOException('El campo Descripcion no puede ir Vacio', 00007);
        }
    }

}
