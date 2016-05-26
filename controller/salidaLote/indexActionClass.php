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
      session::getInstance()->deleteAttribute('id');
      $fields = array(
          salidaLoteTableClass::ID,
          salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID,
          salidaLoteTableClass::RAZON_SALIDA_ID,
          salidaLoteTableClass::CANTIDAD_TOTAL,
          salidaLoteTableClass::CANTIDAD_MACHOS,
          salidaLoteTableClass::CANTIDAD_HEMBRAS,
          salidaLoteTableClass::EMPLEADO_ID,
          salidaLoteTableClass::DELETED_AT
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

      $this->countPages = salidaLoteTableClass::getCountPagesByWhere($where);

      $fieldslote = array(
          loteTableClass::ID,
          loteTableClass::LOTE
      );
//      $this->countPages = salidaLoteTableClass::getCountPages();
      $this->objSalidalote = salidaLoteTableClass::getAll($fields, true, array(salidaLoteTableClass::ID), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $fieldsRazonSalida = array(
          razonSalidaTableClass::ID,
          razonSalidaTableClass::RAZON
      );
      $this->objRazonSalida = razonSalidaTableClass::getAll($fieldsRazonSalida, true, array(razonSalidaTableClass::RAZON), 'ASC');

      $fieldsEmpleado = array(
          empleadoTableClass::ID,
          empleadoTableClass::NOMBRE
      );
      $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado, true, array(empleadoTableClass::NOMBRE), 'ASC');
      $this->objlote = loteTableClass::getAll($fieldslote, true, array(loteTableClass::LOTE), 'DESC');
      $this->defineView('index', 'salidaLote', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El cargo que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('salidaLote', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true))
            and
            request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true)) !== ''
    ) {
      $where[salidaLoteTableClass::getNameField(salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID)] = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true));
    }
    if (
            request::getInstance()->hasPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::RAZON_SALIDA_ID, true))
            and
            request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::RAZON_SALIDA_ID, true)) !== ''
    ) {
      $where[salidaLoteTableClass::getNameField(salidaLoteTableClass::RAZON_SALIDA_ID)] = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::RAZON_SALIDA_ID, true));
    }
    if (
            request::getInstance()->hasPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_TOTAL, true))
            and
            request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_TOTAL, true)) !== ''
    ) {
      $where[salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_TOTAL)] = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_TOTAL, true));
    }
    if (
            request::getInstance()->hasPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_MACHOS, true))
            and
            request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_MACHOS, true)) !== ''
    ) {
      $where[salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_MACHOS)] = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_MACHOS, true));
    }
    if (
            request::getInstance()->hasPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_HEMBRAS, true))
            and
            request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_HEMBRAS, true)) !== ''
    ) {
      $where[salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_HEMBRAS)] = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_HEMBRAS, true));
    }
    if (
            request::getInstance()->hasPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::EMPLEADO_ID, true))
            and
            request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::EMPLEADO_ID, true)) !== ''
    ) {
      $where[salidaLoteTableClass::getNameField(salidaLoteTableClass::EMPLEADO_ID)] = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::EMPLEADO_ID, true));
    }


//        if (
//                (
//                request::getInstance()->hasPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_ini')
//                and
//                request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_ini') !== ''
//                )
//                and (
//                request::getInstance()->hasPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_fin')
//                and
//                request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_fin') !== ''
//                )
//        ) {
//            $where[usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT)] = array(
//                request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_ini'),
//                request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_fin'),
//            );
//        }


    return $where;
  }

}
