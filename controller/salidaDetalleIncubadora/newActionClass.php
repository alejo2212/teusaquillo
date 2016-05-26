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
      $detalleIncu = session::getInstance()->getAttribute('form');
      session::getInstance()->setFlash('detalleIncu', $detalleIncu);
    }
    $fields = array(
        tipoEmpaqueTableClass::ID,
        tipoEmpaqueTableClass::NOMBRE
    );

    $this->objEmpaque = tipoEmpaqueTableClass::getAll($fields, true, array(tipoEmpaqueTableClass::NOMBRE), 'ASC');
    
    $this->idSalida = request::getInstance()->getRequest('idSalida');
    $fields = array(
        incubadoraTableClass::ID,
        incubadoraTableClass::NOMBRE
    );
    $this->objincubadora = incubadoraTableClass::getAll($fields, true, array(incubadoraTableClass::NOMBRE), 'ASC');

    $this->defineView('new', 'salidaDetalleIncubadora', session::getInstance()->getFormatOutput());
  }

}
