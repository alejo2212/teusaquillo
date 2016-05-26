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
          requisicionTableClass::ID,
          requisicionTableClass::EMPLEADO_ID,
          requisicionTableClass::FECHA_REALIZACION,
          requisicionTableClass::ANULADO,
          requisicionTableClass::DELETED_AT
      );
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }
      $fieldsResponsable = array(
          empleadoTableClass::ID,
          empleadoTableClass::NOMBRE
      );
      $this->objEmpleado = empleadoTableClass::getAll($fieldsResponsable, true, array(empleadoTableClass::NOMBRE), 'ASC');

//      $this->countPages = requisicionTableClass::getCountPages();
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
      
      $this->countPages = requisicionTableClass::getCountPagesByWhere($where);

      $this->objRequisicion = requisicionTableClass::getAll($fields, true, array(requisicionTableClass::FECHA_REALIZACION), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->defineView('index', 'requisicion', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La Requisicion que intenta registar ya existe en la base de datos');
          break;
        case 00006:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case 00007:
          session::getInstance()->setWarning($exc->getMessage());
          break;
//        case '22P02':
//          session::getInstance()->setWarning('Ingresar datos validos');
//          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('cargo', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(requisicionTableClass::getNameField(requisicionTableClass::EMPLEADO_ID, true))
            and
            request::getInstance()->getPost(requisicionTableClass::getNameField(requisicionTableClass::EMPLEADO_ID, true)) !== ''
    ) {
      $where[requisicionTableClass::getNameField(requisicionTableClass::EMPLEADO_ID)] = request::getInstance()->getPost(requisicionTableClass::getNameField(requisicionTableClass::EMPLEADO_ID, true));
    }
    if (
            (
            request::getInstance()->hasPost(requisicionTableClass::getNameField(requisicionTableClass::FECHA_REALIZACION, true) . '_ini')
            and
            request::getInstance()->getPost(requisicionTableClass::getNameField(requisicionTableClass::FECHA_REALIZACION, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(requisicionTableClass::getNameField(requisicionTableClass::FECHA_REALIZACION, true) . '_fin')
            and
            request::getInstance()->getPost(requisicionTableClass::getNameField(requisicionTableClass::FECHA_REALIZACION, true) . '_fin') !== ''
            )
    ) {
      $where[requisicionTableClass::getNameField(requisicionTableClass::FECHA_REALIZACION)] = array(
          request::getInstance()->getPost(requisicionTableClass::getNameField(requisicionTableClass::FECHA_REALIZACION, true) . '_ini'),
          request::getInstance()->getPost(requisicionTableClass::getNameField(requisicionTableClass::FECHA_REALIZACION, true) . '_fin'),
      );
    }
    return $where;
  }

}
