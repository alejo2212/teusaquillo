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
 * @author Jhonny Alejandro Diaz <Jhonny2212@hotmail.com>
 */
class newActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    if (session::getInstance()->hasAttribute('form')) {
      $registroAlistamiento = session::getInstance()->getAttribute('form');
      session::getInstance()->setFlash('registroAlistamiento', $registroAlistamiento);
    }
    $fieldsEmple = array(
        empleadoTableClass::ID,
        empleadoTableClass::NOMBRE
    );
    $fieldsLote = array(
        loteTableClass::ID,
        loteTableClass::LOTE
    );
    $this->objEmpleado = empleadoTableClass::getAll($fieldsEmple, true, array(empleadoTableClass::NOMBRE), 'ASC');
    $this->objlote = loteTableClass::getAll($fieldsLote, true, array(loteTableClass::LOTE), 'ASC');

    $this->defineView('new', 'registroAlistamiento', session::getInstance()->getFormatOutput());
  }

}