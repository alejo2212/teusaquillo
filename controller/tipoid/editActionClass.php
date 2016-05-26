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
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet('id')) {
        $id = request::getInstance()->getGet('id');
        $this->objTipoid = tipoIdentificacionTableClass::getAllTipoid($id);
        $this->edit = true;
        $this->defineView('edit', 'tipoid', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('tipoid', 'index');
      }
    } catch (PDOException $exc) {
      //session::getInstance()->setError($exc->getMessage());
//      $this->answer = array(
//        'code' => 500,
//        'error' => $exc->getMessage()
//      );
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('Registro duplicado');
          break;
        case 22001:
          session::getInstance()->setError('La abreviatura solo puede contener maximo 5 caracteres');
          
          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('tipoid', 'index');
    }
  }

}
