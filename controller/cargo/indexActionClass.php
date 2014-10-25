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
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    $fields = array(
        cargoTableClass::ID,
        cargoTableClass::NOMBRE,
        cargoTableClass::DESCRIPCION,
        cargoTableClass::DELETED_AT
    );
    $this->objCargo = cargoTableClass::getAll($fields, true, array(cargoTableClass::NOMBRE), 'ASC');
    $this->defineView('index', 'cargo', session::getInstance()->getFormatOutput());
  }

}
