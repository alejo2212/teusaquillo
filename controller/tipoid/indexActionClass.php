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
    $fields = array(
        tipoIdentificacionTableClass::ID,
        tipoIdentificacionTableClass::DESCRIPCION,
        tipoIdentificacionTableClass::DELETED_AT
    );
    $this->objTipoid = tipoIdentificacionTableClass::getAll($fields, true, array(tipoIdentificacionTableClass::DESCRIPCION), 'ASC');
    $this->defineView('index', 'tipoid', session::getInstance()->getFormatOutput());
  }

}
