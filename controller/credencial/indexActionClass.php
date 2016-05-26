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
 * @author Jhonny Alejandro Diaz <jhonny2212@hotmail.com>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      session::getInstance()->deleteAttribute('form');
      $fields = array(
          credencialTableClass::ID,
          credencialTableClass::CREATED_AT,
          credencialTableClass::UPDATE_AT,
          credencialTableClass::NOMBRE,
      );
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//      $this->countPages = credencialTableClass::getCountPages();

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

      $this->countPages = credencialTableClass::getCountPagesByWhere($where);

      $this->objCredencial = credencialTableClass::getAll($fields, true, array(credencialTableClass::NOMBRE), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->defineView('index', 'credencial', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('credencial', 'index');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true))
            and
            request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true)) !== ''
    ) {
      $where[credencialTableClass::getNameField(credencialTableClass::NOMBRE)] = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true));
    }
    return $where;
  }

}
