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
class deletedActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('GET')) {

        //echo $id = request::getInstance()->getGet(cargoTableClass::getNameField(cargoTableClass::ID, true));
        $e = request::getInstance()->getGet(cargoTableClass::ID, true);
        
        //$ids = array(
          //  cargoTableClass::ID => $id
        //);
        cargoTableClass::delete($e);
        session::getInstance()->setSuccess('Eliminacion exitosa');

        routing::getInstance()->redirect('cargo', 'index');
      } else {
        routing::getInstance()->redirect('cargo', 'index');
      }
    } catch (Exception $exc) {
      echo $exc->getMessage();
    }
  }

}
