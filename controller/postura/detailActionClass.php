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
        $this->idPostura = $id = request::getInstance()->getRequest('id');
        $fields = array(
            posturaDetalleTableClass::ID,
            posturaDetalleTableClass::POSTURA_ID,
            posturaDetalleTableClass::CLASIFICACION_POSTURA_ID,
            posturaDetalleTableClass::EMPLEADO_ID,
            posturaDetalleTableClass::CANTIDAD,
            posturaDetalleTableClass::INGRESO_VENTA
        );

        $this->page = 0;

        if (request::getInstance()->hasGet('page')) {
          $this->page = (request::getInstance()->getGet('page') - 1);
        }

        $this->countPages = posturaDetalleTableClass::getCountPages();

        $where = array(
            posturaDetalleTableClass::getNameField(posturaDetalleTableClass::POSTURA_ID) => $id
        );

        $this->objDetallePostu = posturaDetalleTableClass::getAll($fields, true, array(posturaDetalleTableClass::CLASIFICACION_POSTURA_ID), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
        $this->defineView('index', 'posturaDetalle', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('postura', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('postura', 'index');
    }
  }

}
