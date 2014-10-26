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
@author jhon fernando hoyos diaz <aprendiz.jhonfernandohoyosdiaz@gmail.com> */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    $fields = array(
    tipoInsumoTableClass::ID,
    tipoInsumoTableClass::NOMBRE,
    tipoInsumoTableClass::OBSERVACION,
    tipoInsumoTableClass::DELETED_AT
    );
    $this->objtipoInsumo=tipoInsumoTableClass::getAll($fields, true, array(tipoInsumoTableClass::NOMBRE), 'ASC');
    $this->defineView('index', 'tipoInsumo', session::getInstance()->getFormatOutput());
  }

}
