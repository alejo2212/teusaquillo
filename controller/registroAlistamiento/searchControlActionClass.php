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
class searchControlActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

          $id = request::getInstance()->getPost('idControl');
          $this->data = salidaInsumoDetalleTableClass::getInsumosByIdSalidaInsumo($id);
          $this->defineView('searchControl', 'registroAlistamiento', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('registroAlistamiento', 'index');
      }
    } catch (Exception $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('Registro duplicado');
          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('registroAlistamiento', 'index');
    }
  }

}
