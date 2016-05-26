<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of newActionClass
 *
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class newActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    if (session::getInstance()->hasAttribute('form')) {
      $lote = session::getInstance()->getAttribute('form');
      session::getInstance()->setFlash('lote', $lote);
    }
    $fieldsRaza = array(
        razaTableClass::ID,
        razaTableClass::NOMBRE
    );
    $this->objRaza = razaTableClass::getAll($fieldsRaza, true, array(razaTableClass::NOMBRE), 'ASC');

    $fieldsEmpleado = array(
        empleadoTableClass::ID,
        empleadoTableClass::NOMBRE
    );
    $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado, true, array(empleadoTableClass::NOMBRE), 'ASC');

    $this->defineView('new', 'lote', session::getInstance()->getFormatOutput());
  }

}
