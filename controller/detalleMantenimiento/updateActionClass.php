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
        
        $id = request::getInstance()->getPost(detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::ID, true));
        $manteid = request::getInstance()->getPost(detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::MANTENIMIENTO_ID, true));
        $descripcion = request::getInstance()->getPost(detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::DESCRIPCION, true));
        $valor = request::getInstance()->getPost(detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::VALOR, true));
        $observacion = request::getInstance()->getPost(detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::OBSERVACION, true));
        
        $ids = array(
            detalleMantenimientoTableClass::ID => $id
        );
        
        $data = array(
            detalleMantenimientoTableClass::MANTENIMIENTO_ID => $manteid,
            detalleMantenimientoTableClass::DESCRIPCION => $descripcion,
            detalleMantenimientoTableClass::VALOR => $valor
        );
        if($observacion != '') {
            $data[detalleMantenimientoTableClass::OBSERVACION] = $observacion;
        }
        
        detalleMantenimientoTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Actualización exitosa');
        
        routing::getInstance()->redirect('mantenimiento', 'detail', array(mantenimientoTableClass::ID => $manteid));
      } else {
        routing::getInstance()->redirect('mantenimiento', 'detail', array(mantenimientoTableClass::ID => $manteid));
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('mantenimiento', 'detail', array(mantenimientoTableClass::ID => $manteid));
    }
  }

}
