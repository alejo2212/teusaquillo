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
        razaTableClass::ID,
        razaTableClass::NOMBRE,
        razaTableClass::DESCRIPCION,
        razaTableClass::FOTO,
        razaTableClass::DELETED_AT
    );
    $this->objRaza = razaTableClass::getAll($fields, true, array(razaTableClass::NOMBRE), 'ASC');
    $this->defineView('index', 'raza', session::getInstance()->getFormatOutput());
  }

}
