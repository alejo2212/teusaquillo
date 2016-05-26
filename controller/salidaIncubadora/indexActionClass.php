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
          salidaincubadoraTableClass::ID,
          salidaincubadoraTableClass::ID_ANUAL,
          salidaincubadoraTableClass::CANTIDAD,
          salidaincubadoraTableClass::FECHA,
          salidaincubadoraTableClass::NO_PEDIDO,
          salidaincubadoraTableClass::FECHA_LLEGADA,
          salidaincubadoraTableClass::FECHA_SALIDAD,
          salidaincubadoraTableClass::EMPLEADO_ID
      );
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//      $this->countPages = salidaincubadoraTableClass::getCountPages();
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
      
      $this->countPages = salidaincubadoraTableClass::getCountPagesByWhere($where);
      
      $fieldsResponsable = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
        );
        $this->objEmpleado = empleadoTableClass::getAll($fieldsResponsable, true, array(empleadoTableClass::NOMBRE), 'ASC');
//        $fieldsI = array(
//            incubadoraTableClass::ID,
//            incubadoraTableClass::NOMBRE
//        );
//        $this->objincubadora = incubadoraTableClass::getAll($fieldsI, true, array(incubadoraTableClass::NOMBRE), 'ASC');
//        
      $this->objSalida = salidaincubadoraTableClass::getAll($fields, true, array(salidaincubadoraTableClass::FECHA), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->defineView('index', 'salidaIncubadora', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La salida de Incubadora que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('salidaIncubadora', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::INCUBADORA_ID, true))
            and
            request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::INCUBADORA_ID, true)) !== ''
    ) {
      $where[salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::INCUBADORA_ID)] = request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::INCUBADORA_ID, true));
    }
    if (
            request::getInstance()->hasPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::EMPLEADO_ID, true))
            and
            request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::EMPLEADO_ID, true)) !== ''
    ) {
      $where[salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::EMPLEADO_ID)] = request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::EMPLEADO_ID, true));
    }
    if (
            request::getInstance()->hasPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::CANTIDAD, true))
            and
            request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::CANTIDAD, true)) !== ''
    ) {
      $where[salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::CANTIDAD)] = request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::CANTIDAD, true));
    }
    if (
            request::getInstance()->hasPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::NO_PEDIDO, true))
            and
            request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::NO_PEDIDO, true)) !== ''
    ) {
      $where[salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::NO_PEDIDO)] = request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::NO_PEDIDO, true));
    }
    
    if (
            (
            request::getInstance()->hasPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA, true) . '_ini')
            and
            request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA, true) . '_fin')
            and
            request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA, true) . '_fin') !== ''
            )
    ) {
      $where[salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA)] = array(
          request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA, true) . '_ini'),
          request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA, true) . '_fin'),
      );
    }
    if (
            (
            request::getInstance()->hasPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_LLEGADA, true) . '_ini')
            and
            request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_LLEGADA, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_LLEGADA, true) . '_fin')
            and
            request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_LLEGADA, true) . '_fin') !== ''
            )
    ) {
      $where[salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_LLEGADA)] = array(
          request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_LLEGADA, true) . '_ini'),
          request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_LLEGADA, true) . '_fin'),
      );
    }
    if (
            (
            request::getInstance()->hasPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_SALIDAD, true) . '_ini')
            and
            request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_SALIDAD, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_SALIDAD, true) . '_fin')
            and
            request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_SALIDAD, true) . '_fin') !== ''
            )
    ) {
      $where[salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_SALIDAD)] = array(
          request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_SALIDAD, true) . '_ini'),
          request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_SALIDAD, true) . '_fin'),
      );
    }
    return $where;
  }

}
