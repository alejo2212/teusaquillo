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
        $this->idManteni = $id = request::getInstance()->getRequest('id');
        $fields = array(
            detalleMantenimientoTableClass::ID,
            detalleMantenimientoTableClass::MANTENIMIENTO_ID,
            detalleMantenimientoTableClass::DESCRIPCION,
            detalleMantenimientoTableClass::OBSERVACION,
            detalleMantenimientoTableClass::VALOR
        );

        $this->page = 0;

        if (request::getInstance()->hasGet('page')) {
          $this->page = (request::getInstance()->getGet('page') - 1);
        }

        $this->countPages = detalleMantenimientoTableClass::getCountPages();

        $where = array(
            detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::MANTENIMIENTO_ID) => $id
        );

        $this->objDetalleMante = detalleMantenimientoTableClass::getAll($fields, true, array(detalleMantenimientoTableClass::ID), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
        $this->defineView('index', 'detalleMantenimiento', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('mantenimiento', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('mantenimiento', 'index');
    }
  }

}
