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
class createdActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = request::getInstance()->getPost(cargoTableClass::getNameField(cargoTableClass::NOMBRE, true));
        $descripcion = request::getInstance()->getPost(cargoTableClass::getNameField(cargoTableClass::DESCRIPCION, true));
        
        $data = array(
            cargoTableClass::NOMBRE => $nombre,
            cargoTableClass::DESCRIPCION => $descripcion
        );
        cargoTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');
        
        routing::getInstance()->redirect('cargo', 'index');
      } else {
        routing::getInstance()->redirect('cargo', 'index');
      }
    } catch (Exception $exc) {
      echo $exc->getMessage();
    }
  }

}
