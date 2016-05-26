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
//    try {
//      session::getInstance()->deleteAttribute('form');
//      $fields = array(
//          posturaDetalleTableClass::ID,
//          posturaDetalleTableClass::POSTURA_ID,
//          posturaDetalleTableClass::CLASIFICACION_POSTURA_ID,
//          posturaDetalleTableClass::EMPLEADO_ID,
//          posturaDetalleTableClass::CANTIDAD,
//          posturaDetalleTableClass::INGRESO_VENTA
//      );
//      $this->page = 0;
//      $idPostura = posturaTableClass::getIdPostura();
//      if (request::getInstance()->hasGet('page')) {
//        $this->page = (request::getInstance()->getGet('page') - 1);
//      }
//
//      $this->countPages = posturaDetalleTableClass::getCountPages();
//
//      $this->objDetallePostu = posturaDetalleTableClass::getAll($fields, true, array(posturaDetalleTableClass::FECHA_REALIZACION), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()));
//      $this->defineView('index', 'posturaDetalle', session::getInstance()->getFormatOutput());
//    } catch (PDOException $exc) {
//      session::getInstance()->setError($exc->getMessage());
//      routing::getInstance()->redirect('postura', 'detail',array('id'=>$idPostura));
//    }
  }

}
