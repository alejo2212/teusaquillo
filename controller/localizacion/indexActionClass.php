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
        localidadTableClass::ID,
        localidadTableClass::NOMBRE,
        localidadTableClass::LOCALIDAD_ID,
        localidadTableClass::DELETED_AT
    );
    $this->objLocalidad = localidadTableClass::getAll($fields, true, array(localidadTableClass::NOMBRE), 'ASC');
    $this->defineView('index', 'localizacion', session::getInstance()->getFormatOutput());
  }

}
