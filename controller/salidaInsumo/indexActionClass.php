<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      session::getInstance()->deleteAttribute('form');
      $fields = array(
          salidaInsumoTableClass::ID,
          salidaInsumoTableClass::EMPLEADO_ID_SALIDA,
          salidaInsumoTableClass::EMPLEADO_ID_RECEPCION,
          salidaInsumoTableClass::FECHA,
          salidaInsumoTableClass::OBSERVACION,
          salidaInsumoTableClass::ANULADO,
          salidaInsumoTableClass::REQUISICION_ID,
          salidaInsumoTableClass::DELETED_AT
      );
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

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

      $this->countPages = salidaInsumoTableClass::getCountPagesByWhere($where);

      $fieldsEmplSal = array(
          empleadoTableClass::ID,
          empleadoTableClass::NOMBRE
      );
      $this->objEmplSal = empleadoTableClass::getAll($fieldsEmplSal, true, array(empleadoTableClass::NOMBRE), 'ASC');
//      $this->countPages = salidaInsumoTableClass::getCountPages();

      $this->objSalidainsumo = salidaInsumoTableClass::getAll($fields, true, array(salidaInsumoTableClass::ID), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);



      $fieldsEmplRec = array(
          empleadoTableClass::ID,
          empleadoTableClass::NOMBRE
      );
      $this->objEmplRec = empleadoTableClass::getAll($fieldsEmplRec, true, array(empleadoTableClass::NOMBRE), 'ASC');

      $this->defineView('index', 'salidaInsumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El cargo que intenta registar ya existe en la base de datos');
          break;
        case 00006:
          session::getInstance()->setWarning($exc->getMessage());
          break;
//                case '22P02':
//                    session::getInstance()->setWarning('Ingresar datos validos');
//                    break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('salidaInsumo', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_SALIDA, true))
            and
            request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_SALIDA, true)) !== ''
    ) {
      $where[salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_SALIDA)] = request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_SALIDA, true));
    }
    if (
            request::getInstance()->hasPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_RECEPCION, true))
            and
            request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_RECEPCION, true)) !== ''
    ) {
      $where[salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_RECEPCION)] = request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_RECEPCION, true));
    }
    if (
            request::getInstance()->hasPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::REQUISICION_ID, true))
            and
            request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::REQUISICION_ID, true)) !== ''
    ) {
      $where[salidaInsumoTableClass::getNameField(salidaInsumoTableClass::REQUISICION_ID)] = request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::REQUISICION_ID, true));
    }
    if (
            (
            request::getInstance()->hasPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) . '_ini')
            and
            request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) . '_fin')
            and
            request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) . '_fin') !== ''
            )
    ) {
      $where[salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA)] = array(
          request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) . '_ini'),
          request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) . '_fin'),
      );
    }


    return $where;
  }

}
