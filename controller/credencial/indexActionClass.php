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
 * @author Jhonny Alejandro Diaz <jhonny2212@hotmail.com>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    $fields = array(
        credencialTableClass::ID,
        credencialTableClass::CREATED_AT,
        credencialTableClass::UPDATE_AT,
        credencialTableClass::NOMBRE,
    );
    $this->objCredencial = credencialTableClass::getAll($fields, true, array(credencialTableClass::NOMBRE), 'ASC');
    $this->defineView('index', 'credencial', session::getInstance()->getFormatOutput());
  }

}
