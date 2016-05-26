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
  @author jhon fernando hoyos diaz <aprendiz.jhonfernandohoyosdiaz@gmail.com> */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      session::getInstance()->deleteAttribute('form');
      $fields = array(
          ambienteHistorialLoteTableClass::ID,
          ambienteHistorialLoteTableClass::AMBIENTE_ID,
          ambienteHistorialLoteTableClass::LOTE_ID,
          ambienteHistorialLoteTableClass::NO_CASETA,
          ambienteHistorialLoteTableClass::CANTIDAD_HEMBRAS,
          ambienteHistorialLoteTableClass::CANTIDAD_MACHOS
      );
//            echo 'entro';
//            exit();
      $fieldsambiente = array(
          ambienteTableClass::ID,
          ambienteTableClass::NOMBRE
      );
      $fieldslote = array(
          loteTableClass::ID,
          loteTableClass::LOTE
      );

      $this->objambiente = ambienteTableClass::getAll($fieldsambiente, true, array(ambienteTableClass::NOMBRE), 'ASC');
      $this->objlote = loteTableClass::getAll($fieldslote, true, array(loteTableClass::LOTE), 'ASC');

      $where = $this->filters();
//      exit();
//      $where = session::getInstance()->getFlash('where');
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
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }
//            echo 'asdf';
//            exit();
//            $this->countPages = ambienteHistorialLoteTableClass::getCountPages();

      $this->countPages = ambienteHistorialLoteTableClass::getCountPagesByWhere($where);

      $this->objambienteHistorialLote = ambienteHistorialLoteTableClass::getAll($fields, true, array(ambienteHistorialLoteTableClass::LOTE_ID), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where); // no olvidemos borrar la variable where

      $this->defineView('index', 'ambienteHistorialLote', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('ambienteHistorialLote', 'index');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::AMBIENTE_ID, true))
            and
            request::getInstance()->getPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::AMBIENTE_ID, true)) !== ''
    ) {
      $where[ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::AMBIENTE_ID)] = request::getInstance()->getPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::AMBIENTE_ID, true));
    }
    if (
            request::getInstance()->hasPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::LOTE_ID, true))
            and
            request::getInstance()->getPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::LOTE_ID, true)) !== ''
    ) {
      $where[ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::LOTE_ID)] = request::getInstance()->getPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::LOTE_ID, true));
    }

    if (
            request::getInstance()->hasPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::NO_CASETA, true))
            and
            request::getInstance()->getPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::NO_CASETA, true)) !== ''
    ) {
      $where[ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::NO_CASETA)] = request::getInstance()->getPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::NO_CASETA, true));
    }

    return $where;
  }

}
