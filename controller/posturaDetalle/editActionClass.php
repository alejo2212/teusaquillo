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
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet('id')) {
        $id = request::getInstance()->getGet('id');
        $this->objDetallePostu = posturaDetalleTableClass::getdetallePostura($id);
        
        $idPostura= $this->objDetallePostu->postura_id;
//        exit();
        $this->edit = true;
        $fieldsEmple = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
        );
        $this->objclasi = clasificacionPosturaTableClass::getClasificacionPostura();
        $this->objEmpleado = empleadoTableClass::getAll($fieldsEmple, true, array(empleadoTableClass::NOMBRE), 'ASC');

        
        $this->defineView('edit', 'posturaDetalle', session::getInstance()->getFormatOutput());
      } else {
        $idPostura = posturaTableClass::getIdPostura();
        routing::getInstance()->redirect('postura', 'detail', array(posturaTableClass::ID => $idPostura));
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      $idPostura = posturaTableClass::getIdPostura();
      routing::getInstance()->redirect('postura', 'detail', array(posturaTableClass::ID => $idPostura));
    }
  }

}
