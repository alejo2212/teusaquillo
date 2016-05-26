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
class deleteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {
        $id = request::getInstance()->getPost('id');
        $ids = array(
            incubadoraTableClass::ID => $id
        );
        incubadoraTableClass::delete($ids, true);
        $this->answer = array(
          'code' => 200
        );
        session::getInstance()->setSuccess('El registro fue eliminado satisfactoriamente');
        $this->defineView('delete', 'incubadora', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('incubadora', 'index');
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
