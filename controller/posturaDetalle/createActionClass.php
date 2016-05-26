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
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $posturaid = request::getInstance()->getPost(posturaDetalleTableClass::getNameField(posturaDetalleTableClass::POSTURA_ID, true));
        $clasiid = request::getInstance()->getPost(posturaDetalleTableClass::getNameField(posturaDetalleTableClass::CLASIFICACION_POSTURA_ID, true));
        $empleid = request::getInstance()->getPost(posturaDetalleTableClass::getNameField(posturaDetalleTableClass::EMPLEADO_ID, true));
//        $fecha = request::getInstance()->getPost(posturaDetalleTableClass::getNameField(posturaDetalleTableClass::FECHA_REALIZACION, true));
        $cantidad = request::getInstance()->getPost(posturaDetalleTableClass::getNameField(posturaDetalleTableClass::CANTIDAD, true));
        $venta = request::getInstance()->getPost(posturaDetalleTableClass::getNameField(posturaDetalleTableClass::INGRESO_VENTA, true));
        
        $post = array(
            posturaDetalleTableClass::POSTURA_ID => $posturaid,
            posturaDetalleTableClass::CLASIFICACION_POSTURA_ID => $clasiid,
            posturaDetalleTableClass::EMPLEADO_ID => $empleid,
//            posturaDetalleTableClass::FECHA_REALIZACION => $fecha,
            posturaDetalleTableClass::CANTIDAD => $cantidad,
            posturaDetalleTableClass::INGRESO_VENTA => $venta
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        $this->Validations($posturaid, $clasiid, $empleid, $cantidad, $venta);
        /* ------------- */

        $data = array(
            posturaDetalleTableClass::POSTURA_ID => $posturaid,
            posturaDetalleTableClass::CLASIFICACION_POSTURA_ID => $clasiid,
            posturaDetalleTableClass::EMPLEADO_ID => $empleid,
//            posturaDetalleTableClass::FECHA_REALIZACION => $fecha,
            posturaDetalleTableClass::CANTIDAD => $cantidad
        );
        if($venta != '') {
            $data[posturaDetalleTableClass::INGRESO_VENTA] = $venta;
        }
//        $canttot=  posturaTableClass::getPostura($posturaid);
//        $res=$canttot->cantidad - posturaDetalleTableClass::getSumHuevos($posturaid);
//        if($res >= $cantidad){
          posturaDetalleTableClass::insert($data);
          session::getInstance()->setSuccess('Registro exitoso');
          routing::getInstance()->redirect('postura', 'detail', array(posturaTableClass::ID => $posturaid));
//        }else{
//          session::getInstance()->setWarning('Tiene disponibles: '.$res);
//          routing::getInstance()->redirect('posturaDetalle', 'new', array(posturaTableClass::ID.'Postura' => $posturaid));
//        }
//        exit();
        
      } else {
        routing::getInstance()->redirect('postura', 'detail', array(posturaTableClass::ID => $posturaid));
      }
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El codigo del Detalle Postura que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('posturaDetalle', 'new', array(posturaTableClass::ID.'Postura' => $posturaid));
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
    if (!is_numeric($venta) and $venta != '') {
      throw new PDOException('El ingreso por Venta  solo admite caracteres numericos', 00008);
    }
  }

}
