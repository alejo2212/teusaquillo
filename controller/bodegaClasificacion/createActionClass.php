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
class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $nombre = request::getInstance()->getPost(bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::NOMBRE, true));
                


                $post = array(
                    bodegaClasificacionTableClass::NOMBRE => $nombre,
                    
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
                if (strlen($nombre) > bodegaClasificacionTableClass::NOMBRE_LENGTH ) {
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
                $data = array(
                    bodegaClasificacionTableClass::NOMBRE => $nombre,
                    
                );
                bodegaClasificacionTableClass::insert($data);
                session::getInstance()->setSuccess('Registro exitoso');

                routing::getInstance()->redirect('bodegaClasificacion', 'index');
            } else {
                routing::getInstance()->redirect('bodegaClasificacion', 'index');
            }
            session::getInstance()->deleteAttribute('form');
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('La  Clasificacion bodega que intenta registar ya existe en la base de datos');
                    break;
                case '22P02':
                    session::getInstance()->setWarning('La  Clasificacion bodega solamente admiten caracteres numericos');
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
            routing::getInstance()->redirect('bodegaClasificacion', 'new');
            //routing::getInstance()->forward('security', 'new');
        }
    }

}
