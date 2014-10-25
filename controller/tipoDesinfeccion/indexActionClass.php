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
 * @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    $fields = array(
    tipoDesinfeccionTableClass::ID,
    tipoDesinfeccionTableClass::NOMBRE,
    tipoDesinfeccionTableClass::OBSERVACION,
    tipoDesinfeccionTableClass::DELETED_AT
    );
    $this->objtipoDesinfeccion=tipoDesinfeccionTableClass::getAll($fields, true, array(tipoDesinfeccionTableClass::NOMBRE), 'ASC');
    $this->defineView('index', 'tipoDesinfeccion', session::getInstance()->getFormatOutput());
  }

}
