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

                $nombre = request::getInstance()->getPost(unidadMedidaTableClass::getNameField(unidadMedidaTableClass::NOMBRE, true));
                $sigla = request::getInstance()->getPost(unidadMedidaTableClass::getNameField(unidadMedidaTableClass::SIGLA, true));
                $observacion = request::getInstance()->getPost(unidadMedidaTableClass::getNameField(unidadMedidaTableClass::OBSERVACION, true));

                $post = array(
                    unidadMedidaTableClass::NOMBRE => $nombre,
                    unidadMedidaTableClass::SIGLA => $sigla,
                    unidadMedidaTableClass::OBSERVACION => $observacion
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
                if (strlen($nombre) > unidadMedidaTableClass::NOMBRE_LENGTH) {
                    throw new PDOException('El nombre  no pude ser mayor a ' . unidadMedidaTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
                }
                if ($nombre === "") {
                    throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
                    echo "entro";
                }

//                if (!ereg("^[A-Za-z_]*$", $nombre)) {
//                    throw new PDOException('no pueden llevar el Nombre campos numericos', 00008);
//                    echo "entro";
//                }
                
                
                if (strlen($sigla) > unidadMedidaTableClass::SIGLA_LENGTH) {
                    throw new PDOException('El campo sigla  no pude ser mayor a ' . unidadMedidaTableClass::SIGLA_LENGTH . ' caracteres', 00006);
                }
                if ($sigla === "") {
                    throw new PDOException('El campo sigla no puede ir Vacio', 00007);
                    echo "entro";
                }

//                if (!ereg("^[A-Za-z_]*$", $sigla)) {
//                    throw new PDOException('no pueden llevar sigla campos numericos', 00008);
//                    echo "entro";
//                }
                
                
                if (strlen($observacion) >  unidadMedidaTableClass::OBSERVACION_LENGTH) {
                    throw new PDOException('La observacion  no pude ser mayor a ' . unidadMedidaTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
                }
                /* ------------- */


                session::getInstance()->setAttribute(unidadMedidaTableClass::getNameField(unidadMedidaTableClass::NOMBRE, true), $nombre);

                $data = array(
                    unidadMedidaTableClass::NOMBRE => $nombre,
                    unidadMedidaTableClass::SIGLA => $sigla,
                    unidadMedidaTableClass::OBSERVACION => $observacion
                );
                unidadMedidaTableClass::insert($data);
                session::getInstance()->setSuccess('Registro exitoso');

                routing::getInstance()->redirect('unidadMedida', 'index');
            } else {
                routing::getInstance()->redirect('unidadMedida', 'index');
            }
            session::getInstance()->deleteAttribute('form');
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('La unidad de Medida que intenta registar ya existe en la base de datos');
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
            routing::getInstance()->redirect('unidadMedida', 'new');
            //routing::getInstance()->forward('security', 'new');
        }
    }

}
