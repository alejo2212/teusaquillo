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
          registroAlistamientoTableClass::ID,
          registroAlistamientoTableClass::EMPLEADO_ID,
          registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID,
          registroAlistamientoTableClass::FECHA_INICIO,
          registroAlistamientoTableClass::FECHA_FIN,
          registroAlistamientoTableClass::LOTE_ID,
          registroAlistamientoTableClass::FECHA_INICIO_CORTINA,
          registroAlistamientoTableClass::FECHA_FIN_CORTINA,
          registroAlistamientoTableClass::FECHA_ENTRADA_CAMA,
          registroAlistamientoTableClass::FECHA_TERMINO_CAMA,
          registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO
      );

      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//      $this->countPages = registroAlistamientoTableClass::getCountPages();

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
      
      $this->countPages = registroAlistamientoTableClass::getCountPagesByWhere($where);
      $fieldsEmple = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
        );
        $fieldsLote = array(
            loteTableClass::ID,
            loteTableClass::LOTE
        );
        $this->objEmpleado = empleadoTableClass::getAll($fieldsEmple, true, array(empleadoTableClass::NOMBRE), 'ASC');
        $this->objlote = loteTableClass::getAll($fieldsLote, true, array(loteTableClass::LOTE), 'ASC');
        
      $this->objregistroAlistamiento = registroAlistamientoTableClass::getAll($fields, true, array(registroAlistamientoTableClass::ID), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->defineView('index', 'registroAlistamiento', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El registro de Alistamiento que intenta registar ya existe en la base de datos');
          break;
        case 00006:
          session::getInstance()->setWarning($exc->getMessage());
          break;
//        case '22P02':
//          session::getInstance()->setWarning('Ingresar datos validos');
//          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('registroAlistamiento', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();
    if (
            request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::EMPLEADO_ID, true))
            and
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::EMPLEADO_ID, true)) !== ''
    ) {
      $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::EMPLEADO_ID)] = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::EMPLEADO_ID, true));
    }
    if (
            request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID, true))
            and
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID, true)) !== ''
    ) {
      $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID)] = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID, true));
    }
    if (
            request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::LOTE_ID, true))
            and
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::LOTE_ID, true)) !== ''
    ) {
      $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::LOTE_ID)] = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::LOTE_ID, true));
    }


    if (
            (
            request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) . '_ini')
            and
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) . '_fin')
            and
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) . '_fin') !== ''
            )
    ) {
      $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO)] = array(
          request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) . '_ini'),
          request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) . '_fin'),
      );
    }
    if (
            (
            request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) . '_ini')
            and
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) . '_fin')
            and
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) . '_fin') !== ''
            )
    ) {
      $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN)] = array(
          request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) . '_ini'),
          request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) . '_fin'),
      );
    }
    if (
            (
            request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) . '_ini')
            and
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) . '_fin')
            and
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) . '_fin') !== ''
            )
    ) {
      $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA)] = array(
          request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) . '_ini'),
          request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) . '_fin'),
      );
    }
    if (
            (
            request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) . '_ini')
            and
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) . '_fin')
            and
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) . '_fin') !== ''
            )
    ) {
      $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA)] = array(
          request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) . '_ini'),
          request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) . '_fin'),
      );
    }
    if (
            (
            request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) . '_ini')
            and
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) . '_fin')
            and
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) . '_fin') !== ''
            )
    ) {
      $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA)] = array(
          request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) . '_ini'),
          request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) . '_fin'),
      );
    }
    if (
            (
            request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) . '_ini')
            and
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) . '_fin')
            and
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) . '_fin') !== ''
            )
    ) {
      $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA)] = array(
          request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) . '_ini'),
          request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) . '_fin'),
      );
    }
    if (
            (
            request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) . '_ini')
            and
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) . '_fin')
            and
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) . '_fin') !== ''
            )
    ) {
      $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO)] = array(
          request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) . '_ini'),
          request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) . '_fin'),
      );
    }
    return $where;
  }

}
