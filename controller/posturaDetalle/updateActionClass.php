<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of indexActionClass
 *
 * @author Jhonny Alejandro Diaz <Jhonny2212@hotmail.com>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(posturaDetalleTableClass::getNameField(posturaDetalleTableClass::ID, true));
                $posturaid = request::getInstance()->getPost(posturaDetalleTableClass::getNameField(posturaDetalleTableClass::POSTURA_ID, true));
                $clasiid = request::getInstance()->getPost(posturaDetalleTableClass::getNameField(posturaDetalleTableClass::CLASIFICACION_POSTURA_ID, true));
                $empleid = request::getInstance()->getPost(posturaDetalleTableClass::getNameField(posturaDetalleTableClass::EMPLEADO_ID, true));
//                $fecha = request::getInstance()->getPost(posturaDetalleTableClass::getNameField(posturaDetalleTableClass::FECHA_REALIZACION, true));
                $cantidad = request::getInstance()->getPost(posturaDetalleTableClass::getNameField(posturaDetalleTableClass::CANTIDAD, true));
                $venta = request::getInstance()->getPost(posturaDetalleTableClass::getNameField(posturaDetalleTableClass::INGRESO_VENTA, true));

                /**
                 * VALIDACIONES
                 */
                $this->Validations($posturaid, $clasiid, $empleid, $cantidad, $venta);
                /* ------------- */

                $ids = array(
                    posturaDetalleTableClass::ID => $id
                );

                $data = array(
                    posturaDetalleTableClass::POSTURA_ID => $posturaid,
                    posturaDetalleTableClass::CLASIFICACION_POSTURA_ID => $clasiid,
                    posturaDetalleTableClass::EMPLEADO_ID => $empleid,
//                    posturaDetalleTableClass::FECHA_REALIZACION => $fecha,
                    posturaDetalleTableClass::CANTIDAD => $cantidad
                );
                if ($venta != '') {
                    $data[posturaDetalleTableClass::INGRESO_VENTA] = $venta;
                }

//                $canttot = posturaTableClass::getPostura($posturaid);
//                echo $res = $canttot->cantidad - posturaDetalleTableClass::getSumHuevos($posturaid);
//
//                if ($res >= $cantidad) {
                    
                    posturaDetalleTableClass::update($ids, $data);
                    session::getInstance()->setSuccess('Actualización exitosa');

                    routing::getInstance()->redirect('postura', 'detail', array(posturaTableClass::ID => $posturaid));
//                } else {
//                    
//                    session::getInstance()->setWarning('Tiene disponibles: ' . $res);
//                    
//                    routing::getInstance()->redirect('posturaDetalle', 'edit', array(posturaTableClass::ID => $id));
//                }
            } else {
                routing::getInstance()->redirect('postura', 'detail', array(posturaTableClass::ID => $id));
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El codigo del Detalle de Postura que intenta registar ya existe en la base de datos');
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
                case 00009:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                case 00010:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                default:
                    session::getInstance()->setError($exc->getMessage());
                    break;
            }
            routing::getInstance()->redirect('posturaDetalle', 'edit', array(posturaTableClass::ID => $posturaid));
            //routing::getInstance()->forward('security', 'new');
        }
    }

    public function Validations($posturaid, $clasiid, $empleid, $cantidad, $venta) {
        if (!is_numeric($posturaid) || $posturaid === "") {
            throw new PDOException('No se encuentra el Numero de Postura para completar el registro', 00010);
        }
        if (!is_numeric($clasiid) || $clasiid === "") {
            throw new PDOException('Seleccione una Clasificacion de Postura valida', 00010);
        }
        if (!is_numeric($empleid) || $empleid === "") {
            throw new PDOException('Seleccione un Empleado valido', 00010);
        }
        if (!is_numeric($cantidad)) {
            throw new PDOException('La cantidad solo admite caracteres numericos', 00008);
        }
        if ($cantidad === "") {
            throw new PDOException('La cantidad no puede ir Vacio', 00007);
        }
        if (!is_numeric($venta)) {
            throw new PDOException('El ingreso por Venta  solo admite caracteres numericos', 00008);
        }
    }

}
