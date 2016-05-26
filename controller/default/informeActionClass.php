<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of defaultClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class informeActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    
    try {
      $this->mensaje='hola';
      session::getInstance()->deleteAttribute('form');
      $fields = array(
          cargoTableClass::ID,
          cargoTableClass::NOMBRE,
          cargoTableClass::DESCRIPCION,
          cargoTableClass::DELETED_AT
      );
//
      $this->objCargo = cargoTableClass::getAll($fields, true, array(cargoTableClass::NOMBRE), 'ASC');
      $this->defineView('informe', 'default', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('cargo', 'index');
    }
  }

}
