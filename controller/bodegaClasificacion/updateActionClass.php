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


                $id = request::getInstance()->getPost(bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::ID, true));
                $nombre = request::getInstance()->getPost(bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::NOMBRE, true));
                $activado = (request::getInstance()->hasPost(bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::ACTIVO, true))) ? request::getInstance()->getPost(bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::ACTIVO, true)) : 'f';

                $ids = array(
                    bodegaClasificacionTableClass::ID => $id
                );

                $data = array(
                    bodegaClasificacionTableClass::NOMBRE => $nombre,
                    bodegaClasificacionTableClass::ACTIVO => $activado
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
                if (strlen($nombre) > bodegaClasificacionTableClass::NOMBRE_LENGTH) {
                    throw new PDOException('El nombre  no pude ser mayor a ' . bodegaClasificacionTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
                }
                if ($nombre === "") {
                    throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
                    echo "entro";
                }

//                if (!ereg("^[A-Za-z_]*$", $nombre)) {
//                    throw new PDOException('no pueden llevar el Nombre campos numericos', 00008);
//                    echo "entro";
//                }
                
                /* ------------- */


                session::getInstance()->setAttribute(bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::NOMBRE, true), $nombre);


                //exit();


                bodegaClasificacionTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Actualización exitosa');

                routing::getInstance()->redirect('bodegaClasificacion', 'index');
            } else {
                routing::getInstance()->redirect('bodegaClasificacion', 'index');
                session::getInstance()->deleteAttribute('form');
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('La clasifiacion de bodega que intenta registar ya existe en la base de datos');
                    break;
//                case '22P02':
//                    session::getInstance()->setWarning('El campo cantidad en bodega solamente admiten caracteres numericos mayores o iguales a (0)');
//                    break;
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
            routing::getInstance()->redirect('bodegaClasificacion', 'edit', array(bodegaClasificacionTableClass::ID => $id));
            //routing::getInstance()->forward('security', 'new');
        }
    }

}
