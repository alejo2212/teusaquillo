<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of newActionClass
 *
 * @author Jhonny Alejandro Diaz <Jhonny2212@hotmail.com>
 */
class newActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    if (session::getInstance()->hasAttribute('form')) {
      $detalleRequisicion = session::getInstance()->getAttribute('form');
      session::getInstance()->setFlash('detalleRequisicion', $detalleRequisicion);
    }
    $fields = array(
        insumoTableClass::ID,
        insumoTableClass::NOMBRE
    );
    $this->objInsumo = insumoTableClass::getAll($fields, true, array(insumoTableClass::NOMBRE), 'ASC');
    $this->idRequisicion = request::getInstance()->getRequest('idRequisicion');
    $this->defineView('new', 'detalleRequisicion', session::getInstance()->getFormatOutput());
  }

}
