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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      session::getInstance()->deleteAttribute('form');
      
      $fields = array(
        usuarioTableClass::ID,
        usuarioTableClass::USER,
        usuarioTableClass::ACTIVED,
        usuarioTableClass::LAST_LOGIN_AT
      );

      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//      $this->countPages = usuarioTableClass::getCountPages();
      
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
      
      $this->countPages = usuarioTableClass::getCountPagesByWhere($where);

      $this->objUsuarios = usuarioTableClass::getAll($fields, false, array(usuarioTableClass::USER), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->defineView('index', 'security', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
//      echo $exc->getMessage();
//      exit();
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('security', 'index');
    }
  }
  
  private function filters() {
    $where = array();
    
    if (
            request::getInstance()->hasPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true))
            and 
            request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true)) !== ''
       ) {
      $where[usuarioTableClass::getNameField(usuarioTableClass::USER)] = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true));
    }
    
    if (
            (
              request::getInstance()->hasPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_ini')
              and 
              request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_ini') !== ''
            )
            and
            (
              request::getInstance()->hasPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_fin')
              and
              request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_fin') !== ''
            )
       ) {
      $where[usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT)] = array(
          request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_ini'),
          request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_fin'),
      );
    }
    
    
    return $where;
  }

}
