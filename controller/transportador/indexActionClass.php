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
          transportadorTableClass::ID,
          transportadorTableClass::NOMBRE,
          transportadorTableClass::PLACA_VAHICULO,
          transportadorTableClass::OBSERVACION,
          transportadorTableClass::DELETED_AT
      );

      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//      $this->countPages = transportadorTableClass::getCountPages();

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

      $this->countPages = transportadorTableClass::getCountPagesByWhere($where);

      $this->objtransportador = transportadorTableClass::getAll($fields, true, array(transportadorTableClass::NOMBRE), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where); // no olvidemos borrar la variable where
      $this->defineView('index', 'transportador', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('transportador', 'index');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(transportadorTableClass::getNameField(transportadorTableClass::NOMBRE, true))
            and
            request::getInstance()->getPost(transportadorTableClass::getNameField(transportadorTableClass::NOMBRE, true)) !== ''
    ) {
      $where[transportadorTableClass::getNameField(transportadorTableClass::NOMBRE)] = request::getInstance()->getPost(transportadorTableClass::getNameField(transportadorTableClass::NOMBRE, true));
    }
    return $where;
  }

}
