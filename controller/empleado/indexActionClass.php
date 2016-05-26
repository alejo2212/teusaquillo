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
          empleadoTableClass::FOTO,
          empleadoTableClass::DELETED_AT
      );
      $fieldsid = array(
        tipoIdentificacionTableClass::ID,
        tipoIdentificacionTableClass::DESCRIPCION
     );
      $fieldscargo = array(
        cargoTableClass::ID,
        cargoTableClass::NOMBRE
     );
      
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//      $this->countPages = empleadoTableClass::getCountPages();
      
      $where = $this->filters();
      
      if (request::getInstance()->hasGet('r') == 'true') {
        session::getInstance()->deleteAttribute('where');
      }
      if (session::getInstance()->hasAttribute('where')) {
        $where = session::getInstance()->getAttribute('where');
//        session::getInstance()->setFlash('where', $where);
//        echo 'hay atributo';
      } else {
        if ($where != null) {
          session::getInstance()->setAttribute('where', $where);
//          echo 'creo atributo';
        }
      }
      
      $this->countPages = empleadoTableClass::getCountPagesByWhere($where);
      
      $this->objEmpleado = empleadoTableClass::getAll($fields, true, array(empleadoTableClass::NOMBRE), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()),$where);
//      exit();
      $this->objTipoid = tipoIdentificacionTableClass::getAll($fieldsid, true, array(tipoIdentificacionTableClass::DESCRIPCION), 'ASC');
      $this->objCargo = cargoTableClass::getAll($fieldscargo, true, array(cargoTableClass::NOMBRE), 'ASC');
      $this->defineView('index', 'empleado', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El cargo que intenta registar ya existe en la base de datos');
          break;
        case 00006:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case '22P02':
          session::getInstance()->setWarning('Ingresar datos validos');
          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('empleado', 'index');
      //routing::getInstance()->forward('security', 'new');
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
