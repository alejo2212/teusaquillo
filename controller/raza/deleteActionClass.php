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
class deleteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {
        $id = request::getInstance()->getPost('id');
        $ids = array(
          razaTableClass::ID => $id
        );
        razaTableClass::delete($ids,TRUE);// se cambio a true para borrar logicamente no aparece en la rejilla pero en BD si esta.
        $this->answer = array(
          'code' => 200
        );
        session::getInstance()->setSuccess('El registro fue eliminado satisfactoriamente');
        $this->defineView('delete', 'raza', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('raza', 'index');
      }
    } catch (PDOException $exc) {
      //session::getInstance()->setError($exc->getMessage());
      $this->answer = array(
        'code' => 500,
        'error' => $exc->getMessage()
      );
      //routing::getInstance()->redirect('security', 'index');
    }
  }

}
