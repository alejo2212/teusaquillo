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


                $id = request::getInstance()->getPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::ID, true));
                $registoali = request::getInstance()->getPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID, true));
                $tiporepa = request::getInstance()->getPost(tipoReparacionTableClass::getNameField(tipoReparacionTableClass::NOMBRE, true));
                $fechaini = request::getInstance()->getPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_INICIO, true));
                $fechafin = request::getInstance()->getPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_FIN, true));
                $ids = array(
                    alistamientoReparacionTableClass::ID => $id
                );

                $data = array(
                    alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID => $registoali,
                    alistamientoReparacionTableClass::TIPO_REPARACION_ID => $tiporepa,
                    alistamientoReparacionTableClass::FECHA_INICIO => $fechaini,
                    alistamientoReparacionTableClass::FECHA_FIN => $fechafin,
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
                if ($registoali === "") {
                    throw new PDOException('El campo registro alistamiento  no puede ir Vacio', 00007);
                }
                if ($registoali <= -1) {
                    throw new PDOException('El campo registro alistamiento solamente admiten caracteres numericos mayores o iguales a (0)', 00011);
                }
                if (!is_numeric($registoali)) {
                    throw new PDOException('El campo registro alistamiento  no puede contener letras', 00010);
                }

                if ($tiporepa === "") {
                    throw new PDOException('El campo tipo reparacion  no puede ir Vacio', 00007);
                }

                if (strtotime($fechaini) > strtotime($fechafin)) {
                    throw new PDOException('La fecha de inicio no puede ser mayor a  la fecha de finalizacion');
                }

                /* ------------- */


//                session::getInstance()->setAttribute(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE, true), $nombre);
                //exit();


                alistamientoReparacionTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Actualización exitosa');

                routing::getInstance()->redirect('alistamientoReparacion', 'index');
            } else {
                routing::getInstance()->redirect('alistamientoReparacion', 'index');
                session::getInstance()->deleteAttribute('form');
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El alistamiento Reparacion que intenta registar ya existe en la base de datos');
                    break;
                case '22P02':
                    session::getInstance()->setWarning('El campo remision solamente admiten caracteres numericos mayores o iguales a (0)');
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
                case 00010:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                case 00011:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                default:
                    session::getInstance()->setError($exc->getMessage());
                    break;
            }
            routing::getInstance()->redirect('alistamientoReparacion', 'edit', array(alistamientoReparacionTableClass::ID => $id));
            //routing::getInstance()->forward('security', 'new');
        }
    }

}
