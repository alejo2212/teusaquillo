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
      $empleado = session::getInstance()->getAttribute('form');
      session::getInstance()->setFlash('empleado', $empleado);
    }
    $fields = array(
        tipoIdentificacionTableClass::ID,
        tipoIdentificacionTableClass::DESCRIPCION
     );
    $fieldsCiu = array(
        localidadTableClass::ID,
        localidadTableClass::LOCALIDAD_ID,
        localidadTableClass::NOMBRE
     );
    $fieldscargo = array(
        cargoTableClass::ID,
        cargoTableClass::NOMBRE
     );
    $fieldsusuario = array(
        usuarioTableClass::ID,
        usuarioTableClass::USER
     );
    $this->objDeptos = localidadTableClass::getLocalidades();
    $this->objUsuario = usuarioTableClass::getAll($fieldsusuario, true, array(usuarioTableClass::ID), 'ASC');
    $this->objTipoid = tipoIdentificacionTableClass::getAll($fields, true, array(tipoIdentificacionTableClass::DESCRIPCION), 'ASC');
    $this->objCiudad = localidadTableClass::getAll($fieldsCiu, true, array(localidadTableClass::NOMBRE), 'ASC');
    $this->objCargo = cargoTableClass::getAll($fieldscargo, true, array(cargoTableClass::NOMBRE), 'ASC');
    $this->defineView('new', 'empleado', session::getInstance()->getFormatOutput());
  }

}
