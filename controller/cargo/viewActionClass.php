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
class viewActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('GET')) {

        $id = request::getInstance()->getGet(cargoTableClass::getNameField(cargoTableClass::ID, true));
        
        $data = array(
            cargoTableClass::ID => $id
        );

        $this->objCargo = cargoTableClass::getCargo($data);
        $this->defineView('view', 'cargo', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('cargo', 'index');
      }
    } catch (Exception $exc) {
      echo $exc->getMessage();
    }
  }
}
