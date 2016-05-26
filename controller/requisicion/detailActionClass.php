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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class detailActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasRequest('id')) {
        $this->idRequisicion = $id = request::getInstance()->getRequest('id');
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

        $this->countPages = requisiciondetalleTableClass::getCountPages($id);

        $where = array(
            requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::REQUISICION_ID) => $id
        );

        $this->objDetalleRequi = requisiciondetalleTableClass::getAll($fields, true, array(requisiciondetalleTableClass::FECHA_NECESIDAD), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
        $this->defineView('index', 'detalleRequisicion', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('requisicion', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('requisicion', 'index');
    }
  }

}
