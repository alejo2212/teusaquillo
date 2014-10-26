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
@author jhon fernando hoyos diaz <aprendiz.jhonfernandohoyosdiaz@gmail.com> */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    $fields = array(
    presentacionTableClass::ID,
    presentacionTableClass::NOMBRE,
    presentacionTableClass::OBSERVACION,
    presentacionTableClass::DELETED_AT
    );
    $this->objpresentacion=presentacionTableClass::getAll($fields, true, array(presentacionTableClass::NOMBRE), 'ASC');
    $this->defineView('index', 'presentacion', session::getInstance()->getFormatOutput());
  }

}
