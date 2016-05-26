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
          bodegaClasificacionTableClass::ID,
          bodegaClasificacionTableClass::NOMBRE,
          bodegaClasificacionTableClass::ACTIVO,
          bodegaClasificacionTableClass::DELETED_AT
      );

      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//            $this->countPages = bodegaClasificacionTableClass::getCountPages();

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

      $this->countPages = bodegaClasificacionTableClass::getCountPagesByWhere($where);

      $this->objbodegaClasificacion = bodegaClasificacionTableClass::getAll($fields, true, array(bodegaClasificacionTableClass::ID), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where); // no olvidemos borrar la variable where
      $this->defineView('index', 'bodegaClasificacion', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('bodegaClasificacion', 'index');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::NOMBRE, true))
            and
            request::getInstance()->getPost(bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::NOMBRE, true)) !== ''
    ) {
      $where[bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::NOMBRE)] = request::getInstance()->getPost(bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::NOMBRE, true));
    }

    return $where;
  }

}
