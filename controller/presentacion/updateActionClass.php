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
@author jhon fernando hoyos diaz <aprendiz.jhonfernandohoyosdiaz@gmail.com> */
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(presentacionTableClass::getNameField(presentacionTableClass::ID, true));
                $nombre = request::getInstance()->getPost(presentacionTableClass::getNameField(presentacionTableClass::NOMBRE, true));
                $observacion = request::getInstance()->getPost(presentacionTableClass::getNameField(presentacionTableClass::OBSERVACION, true));
                $ids = array(
                    presentacionTableClass::ID => $id
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
                if (strlen($nombre) > presentacionTableClass::NOMBRE_LENGTH) {
                    throw new PDOException('El nombre  no pude ser mayor a ' . presentacionTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
                }
                if ($nombre === "") {
                    throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
                    echo "entro";
                }

//                if (!ereg("^[A-Za-z_]*$", $nombre)) {
//                    throw new PDOException('no pueden llevar el Nombre campos numericos', 00008);
//                    echo "entro";
//                }

                if (strlen($observacion) > presentacionTableClass::OBSERVACION_LENGTH) {
                    throw new PDOException('La observacion  no pude ser mayor a ' . presentacionTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
                }
                /* ------------- */


                session::getInstance()->setAttribute(presentacionTableClass::getNameField(presentacionTableClass::NOMBRE, true), $nombre);

                
                $data = array(
                    presentacionTableClass::NOMBRE => $nombre,
                    presentacionTableClass::OBSERVACION=> $observacion
                );
                presentacionTableClass::update($ids, $data);
                session::getInstance()->setSuccess('presentacion exitosa');

                routing::getInstance()->redirect('presentacion', 'index');
            } else {
                routing::getInstance()->redirect('presentacion', 'index');
            }
         session::getInstance()->deleteAttribute('form');
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('La Presentacion que intenta registar ya existe en la base de datos');
                    break;
                case 00006:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                case 00007:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                case 00008:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                default:
                    session::getInstance()->setError($exc->getMessage());
                    break;
            }
            routing::getInstance()->redirect('presentacion', 'edit', array(presentacionTableClass::ID => $id));
            //routing::getInstance()->forward('security', 'new');
        }
    }

}
