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
class viewActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet('id')) {
        $id = request::getInstance()->getGet('id');
        $this->idSalida = request::getInstance()->getRequest('id');
        $this->objDetalleSalida = salidaDetalleIncubadoraTableClass::getDetalleIncubadora($id);
        
        $this->defineView('view', 'salidaDetalleIncubadora', session::getInstance()->getFormatOutput());
      } else {
        $idSalida = salidaincubadoraTableClass::getIdSalida();
        routing::getInstance()->redirect('salidaIncubadora', 'detail', array(salidaincubadoraTableClass::ID => $idSalida));
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      $idSalida = salidaincubadoraTableClass::getIdSalida();
      routing::getInstance()->redirect('salidaIncubadora', 'detail', array(salidaincubadoraTableClass::ID => $idSalida));
    }
  }
}
