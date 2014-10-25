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
        empleadoTableClass::ID,
        empleadoTableClass::TIPO_ID,
        empleadoTableClass::DOCUMENTO,
        empleadoTableClass::GENERO,
        empleadoTableClass::NOMBRE,
        empleadoTableClass::APELLIDO,
        empleadoTableClass::TELEFONO,
        empleadoTableClass::DIRECCION,
        empleadoTableClass::CORREO,
        empleadoTableClass::CARGO,
        empleadoTableClass::LOCALIZACION_ID,
        empleadoTableClass::ACTIVO,
        empleadoTableClass::USUARIO_ID,
        empleadoTableClass::DELETED_AT
    );
    $this->objEmpleado = empleadoTableClass::getAll($fields, true, array(empleadoTableClass::NOMBRE), 'ASC');
    $this->defineView('index', 'empleado', session::getInstance()->getFormatOutput());
  }

}
