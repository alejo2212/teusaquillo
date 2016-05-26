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
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet('id')) {
        $id = request::getInstance()->getGet('id');
        $this->objEmpleado = empleadoTableClass::getEmpleado($id);
        $this->edit = true;
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
    $this->objUsuario = usuarioTableClass::getAll($fieldsusuario, true, array(usuarioTableClass::USER), 'ASC');
    $this->objTipoid = tipoIdentificacionTableClass::getAll($fields, true, array(tipoIdentificacionTableClass::DESCRIPCION), 'ASC');
    $this->objCiudad = localidadTableClass::getAll($fieldsCiu, true, array(localidadTableClass::NOMBRE), 'ASC');
    $this->objCargo = cargoTableClass::getAll($fieldscargo, true, array(cargoTableClass::NOMBRE), 'ASC');    
    $this->defineView('edit', 'empleado', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('empleado', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('empleado', 'index');
    }
  }

}
