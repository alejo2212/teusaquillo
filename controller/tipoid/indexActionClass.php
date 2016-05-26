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
          tipoIdentificacionTableClass::ID,
          tipoIdentificacionTableClass::DESCRIPCION,
          tipoIdentificacionTableClass::ABREVIATURA,
          tipoIdentificacionTableClass::DELETED_AT
      );
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//      $this->countPages = tipoIdentificacionTableClass::getCountPages();

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
      
      $this->countPages = tipoIdentificacionTableClass::getCountPagesByWhere($where);
      $this->objTipoid = tipoIdentificacionTableClass::getAll($fields, true, array(tipoIdentificacionTableClass::DESCRIPCION), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->defineView('index', 'tipoid', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('cargo', 'index');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DESCRIPCION, true))
            and
            request::getInstance()->getPost(tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DESCRIPCION, true)) !== ''
    ) {
      $where[tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DESCRIPCION)] = request::getInstance()->getPost(tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DESCRIPCION, true));
    }

    if (
            request::getInstance()->hasPost(tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ABREVIATURA, true))
            and
            request::getInstance()->getPost(tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ABREVIATURA, true)) !== ''
    ) {
      $where[tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ABREVIATURA)] = request::getInstance()->getPost(tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ABREVIATURA, true));
    }
    return $where;
  }

}
