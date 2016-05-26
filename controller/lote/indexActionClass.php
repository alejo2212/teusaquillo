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
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    session::getInstance()->deleteAttribute('form');
    try {

      $fields = array(
          loteTableClass::ID,
          loteTableClass::LOTE,
          loteTableClass::FECHA_ENTRADA_GRANJA,
          loteTableClass::FECHA_SALIDA_ESTIPULADA,
          loteTableClass::FECHA_SALIDA_REAL,
          loteTableClass::RAZA_ID,
          loteTableClass::PESO_PROMEDIO_MACHOS,
          loteTableClass::PESO_PROMEDIO_HEMBRAS,
          loteTableClass::CANTIDAD_MACHOS,
          loteTableClass::CANTIDAD_HEMBRAS,
          loteTableClass::CANTIDAD_TOTAL,
          loteTableClass::FECHA_ENTRA_PRODUCCION,
          loteTableClass::OBSERVACION,
          loteTableClass::EMPLEADO_ID,
          loteTableClass::DELETED_AT
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

      $this->countPages = loteTableClass::getCountPagesByWhere($where);
      
      $fieldsEmpleado = array(
          empleadoTableClass::ID,
          empleadoTableClass::NOMBRE
      );
      $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado, true, array(empleadoTableClass::NOMBRE), 'ASC');



//      $this->countPages = loteTableClass::getCountPages();
      $this->objLote = loteTableClass::getAll($fields, true, array(loteTableClass::ID), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);

      $fieldsRaza = array(
          razaTableClass::ID,
          razaTableClass::NOMBRE
      );
      $this->objRaza = razaTableClass::getAll($fieldsRaza, true, array(razaTableClass::NOMBRE), 'ASC');

//        $fieldsEmpleado = array(
//            empleadoTableClass::ID,
//            empleadoTableClass::NOMBRE
//        );
//        $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado, true, array(empleadoTableClass::NOMBRE), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
//        

      $this->defineView('index', 'lote', session::getInstance()->getFormatOutput());
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
      routing::getInstance()->redirect('lote', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::LOTE, true))
            and
            request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::LOTE, true)) !== ''
    ) {
      $where[loteTableClass::getNameField(loteTableClass::LOTE)] = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::LOTE, true));
    }

    if (
            request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::RAZA_ID, true))
            and
            request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::RAZA_ID, true)) !== ''
    ) {
      $where[loteTableClass::getNameField(loteTableClass::RAZA_ID)] = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::RAZA_ID, true));
    }
    if (
            request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::EMPLEADO_ID, true))
            and
            request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::EMPLEADO_ID, true)) !== ''
    ) {
      $where[loteTableClass::getNameField(loteTableClass::EMPLEADO_ID)] = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::EMPLEADO_ID, true));
    }
    if (
            request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::CANTIDAD_TOTAL, true))
            and
            request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::CANTIDAD_TOTAL, true)) !== ''
    ) {
      $where[loteTableClass::getNameField(loteTableClass::CANTIDAD_TOTAL)] = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::CANTIDAD_TOTAL, true));
    }
    if (
            (
            request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) . '_ini')
            and
            request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) . '_fin')
            and
            request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) . '_fin') !== ''
            )
    ) {
      $where[loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA)] = array(
          request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) . '_ini'),
          request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) . '_fin'),
      );
    }


    if (
            (
            request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) . '_ini')
            and
            request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) . '_fin')
            and
            request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) . '_fin') !== ''
            )
    ) {
      $where[loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL)] = array(
          request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) . '_ini'),
          request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) . '_fin'),
      );
    }

    if (
            (
            request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) . '_ini')
            and
            request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) . '_fin')
            and
            request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) . '_fin') !== ''
            )
    ) {
      $where[loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION)] = array(
          request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) . '_ini'),
          request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) . '_fin'),
      );
    }

    if (
            (
            request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) . '_ini')
            and
            request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) . '_fin')
            and
            request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) . '_fin') !== ''
            )
    ) {
      $where[loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA)] = array(
          request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) . '_ini'),
          request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) . '_fin'),
      );
    }

    return $where;
  }

}
