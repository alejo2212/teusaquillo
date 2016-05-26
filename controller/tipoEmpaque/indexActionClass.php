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
          tipoEmpaqueTableClass::ID,
          tipoEmpaqueTableClass::NOMBRE,
          tipoEmpaqueTableClass::DESCRIPCION,
          tipoEmpaqueTableClass::CANTIDAD,
          tipoEmpaqueTableClass::DELETED_AT
      );
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

      $this->countPages = tipoEmpaqueTableClass::getCountPages();
      
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
      
      $this->countPages = tipoEmpaqueTableClass::getCountPagesByWhere($where);

      $this->objtipoEmpaque = tipoEmpaqueTableClass::getAll($fields, true, array(tipoEmpaqueTableClass::NOMBRE), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->defineView('index', 'tipoEmpaque', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('tipoEmpaque', 'index');
    }
  }
  
  private function filters() {
    $where = array();
    
    if (
            request::getInstance()->hasPost(tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::NOMBRE, true))
            and 
            request::getInstance()->getPost(tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::NOMBRE, true)) !== ''
       ) {
      $where[tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::NOMBRE)] = request::getInstance()->getPost(tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::NOMBRE, true));
    }
    
    if (
            request::getInstance()->hasPost(tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::DESCRIPCION, true))
            and 
            request::getInstance()->getPost(tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::DESCRIPCION, true)) !== ''
       ) {
      $where[tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::DESCRIPCION)] = request::getInstance()->getPost(tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::DESCRIPCION, true));
    }
    
    if (
            request::getInstance()->hasPost(tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::CANTIDAD, true))
            and 
            request::getInstance()->getPost(tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::CANTIDAD, true)) !== ''
       ) {
      $where[tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::CANTIDAD)] = request::getInstance()->getPost(tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::CANTIDAD, true));
    }
    return $where;
  }

}
