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
    try {
      session::getInstance()->deleteAttribute('form');
      $fields = array(
          requisiciondetalleTableClass::ID,
          requisiciondetalleTableClass::REQUISICION_ID,
          requisiciondetalleTableClass::BODEGA_ID,
          requisiciondetalleTableClass::CANTIDAD,
          requisiciondetalleTableClass::FECHA_NECESIDAD
      );
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

      $this->countPages = requisiciondetalleTableClass::getCountPages();

      $this->objDetalleRequi = requisiciondetalleTableClass::getAll($fields, true, array(requisiciondetalleTableClass::FECHA_NECESIDAD), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()));
      $this->defineView('index', 'detalleRequisicion', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('detalleRequisicion', 'index');
    }
  }

}
