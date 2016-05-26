<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of defaultClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class informeActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {

    try {
      session::getInstance()->deleteAttribute('form');
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

      $where = $this->filters();
//
      $this->objEmpleado = empleadoTableClass::getAll($fields, true, array(empleadoTableClass::NOMBRE), 'ASC', null, null, $where);
      $this->defineView('informe', 'empleado', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('empleado', 'index');
    }
  }

  private function filters() {
    $where = array();
    if (
            request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true))
            and
            request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true)) !== ''
    ) {
      $where[empleadoTableClass::getNameField(empleadoTableClass::NOMBRE)] = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true));
    }

    if (
            request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true))
            and
            request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true)) !== ''
    ) {
      $where[empleadoTableClass::getNameField(empleadoTableClass::APELLIDO)] = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true));
    }
    if (
            request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true))
            and
            request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true)) !== ''
    ) {
      $where[empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO)] = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true));
    }
    if (
            request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::GENERO, true))
            and
            request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::GENERO, true)) !== ''
    ) {
      $where[empleadoTableClass::getNameField(empleadoTableClass::GENERO)] = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::GENERO, true));
    }
    if (
            request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID, true))
            and
            request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID, true)) !== ''
    ) {
      $where[empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID)] = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID, true));
    }
    if (
            request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::CARGO, true))
            and
            request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::CARGO, true)) !== ''
    ) {
      $where[empleadoTableClass::getNameField(empleadoTableClass::CARGO)] = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::CARGO, true));
    }
    return $where;
  }

}
