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
          devolucionIncubadoraTableClass::ID,
          devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID,
          devolucionIncubadoraTableClass::CANTIDAD_LLEGADA,
          devolucionIncubadoraTableClass::CANTIDAD_FALTANTE,
          devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION,
          devolucionIncubadoraTableClass::FECHA,
          devolucionIncubadoraTableClass::EMPLEADO
      );

      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//      $this->countPages = devolucionIncubadoraTableClass::getCountPages();
//      exit();
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
      
      $this->countPages = devolucionIncubadoraTableClass::getCountPagesByWhere($where);
      
      $fieldsEmple = array(
          empleadoTableClass::ID,
          empleadoTableClass::NOMBRE
      );
      $this->objEmpleado = empleadoTableClass::getAll($fieldsEmple, true, array(empleadoTableClass::NOMBRE), 'ASC');


      $this->objdevolucion = devolucionIncubadoraTableClass::getAll($fields, true, array(devolucionIncubadoraTableClass::FECHA), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->defineView('index', 'devolucionIncubadora', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La Devolucion que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('devolucionIncubadora', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID, true))
            and
            request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID, true)) !== ''
    ) {
      $where[devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID)] = request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID, true));
    }
    if (
            request::getInstance()->hasPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_LLEGADA, true))
            and
            request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_LLEGADA, true)) !== ''
    ) {
      $where[devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_LLEGADA)] = request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_LLEGADA, true));
    }
    if (
            request::getInstance()->hasPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_FALTANTE, true))
            and
            request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_FALTANTE, true)) !== ''
    ) {
      $where[devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_FALTANTE)] = request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_FALTANTE, true));
    }
    if (
            request::getInstance()->hasPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION, true))
            and
            request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION, true)) !== ''
    ) {
      $where[devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION)] = request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION, true));
    }
    if (
            request::getInstance()->hasPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::EMPLEADO, true))
            and
            request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::EMPLEADO, true)) !== ''
    ) {
      $where[devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::EMPLEADO)] = request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::EMPLEADO, true));
    }
    
    if (
            (
            request::getInstance()->hasPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::FECHA, true) . '_ini')
            and
            request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::FECHA, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::FECHA, true) . '_fin')
            and
            request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::FECHA, true) . '_fin') !== ''
            )
    ) {
      $where[devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::FECHA)] = array(
          request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::FECHA, true) . '_ini'),
          request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::FECHA, true) . '_fin'),
      );
    }
    return $where;
  }

}
