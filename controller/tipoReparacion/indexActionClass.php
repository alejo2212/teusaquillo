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
          tipoReparacionTableClass::ID,
          tipoReparacionTableClass::NOMBRE,
          tipoReparacionTableClass::OBSERVACION,
          tipoReparacionTableClass::DELETED_AT
      );

      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//            $this->countPages = tipoReparacionTableClass::getCountPages();

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

      $this->countPages = tipoReparacionTableClass::getCountPagesByWhere($where);

      $this->objtipoReparacion = tipoReparacionTableClass::getAll($fields, true, array(tipoReparacionTableClass::NOMBRE), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where); // no olvidemos borrar la variable where
      $this->defineView('index', 'tipoReparacion', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('tipoReparacion', 'index');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(tipoReparacionTableClass::getNameField(tipoReparacionTableClass::NOMBRE, true))
            and
            request::getInstance()->getPost(tipoReparacionTableClass::getNameField(tipoReparacionTableClass::NOMBRE, true)) !== ''
    ) {
      $where[tipoReparacionTableClass::getNameField(tipoReparacionTableClass::NOMBRE)] = request::getInstance()->getPost(tipoReparacionTableClass::getNameField(tipoReparacionTableClass::NOMBRE, true));
    }
    return $where;
  }

}
