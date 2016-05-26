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
          ambienteInsumoTableClass::ID,
          ambienteInsumoTableClass::AMBIENTE_ID,
          ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID,
          ambienteInsumoTableClass::FECHA_ASIGNACION,
          ambienteInsumoTableClass::FECHA_RETIRO,
          ambienteInsumoTableClass::DELETED_AT
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

      $this->countPages = ambienteInsumoTableClass::getCountPagesByWhere($where);
//      $this->countPages = ambienteInsumoTableClass::getCountPages();
      $this->objAmbienteinsumo = ambienteInsumoTableClass::getAll($fields, true, array(ambienteInsumoTableClass::AMBIENTE_ID), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);

      $fieldsAmbiente = array(
          ambienteTableClass::ID,
          ambienteTableClass::NOMBRE
      );
      $this->objAmbiente = ambienteTableClass::getAll($fieldsAmbiente, true, array(ambienteTableClass::NOMBRE), 'ASC');



      $this->defineView('index', 'ambienteInsumo', session::getInstance()->getFormatOutput());
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
      routing::getInstance()->redirect('ambienteInsumo', 'index');
//routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::AMBIENTE_ID, true))
            and
            request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::AMBIENTE_ID, true)) !== ''
    ) {
      $where[ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::AMBIENTE_ID)] = request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::AMBIENTE_ID, true));
    }
    if (
            request::getInstance()->hasPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID, true))
            and
            request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID, true)) !== ''
    ) {
      $where[ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID)] = request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID, true));
    }
    if (
            (
            request::getInstance()->hasPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) . '_ini')
            and
            request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) . '_fin')
            and
            request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) . '_fin') !== ''
            )
    ) {
      $where[ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION)] = array(
          request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) . '_ini'),
          request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) . '_fin'),
      );
    }
    if (
            (
            request::getInstance()->hasPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) . '_ini')
            and
            request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) . '_fin')
            and
            request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) . '_fin') !== ''
            )
    ) {
      $where[ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO)] = array(
          request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) . '_ini'),
          request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) . '_fin'),
      );
    }

    return $where;
  }

}
