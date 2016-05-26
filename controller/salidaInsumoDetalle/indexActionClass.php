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
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      session::getInstance()->deleteAttribute('form');
      $fields = array(
          salidaInsumoDetalleTableClass::ID,
          salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID,
          salidaInsumoDetalleTableClass::BODEGA_ID,
          salidaInsumoDetalleTableClass:: CANTIDAD,
          salidaInsumoDetalleTableClass::OBSERVACION,
          salidaInsumoDetalleTableClass::ANULADO,
          salidaInsumoDetalleTableClass::INSUMO_ID,
          salidaInsumoDetalleTableClass::DELETED_AT
      );
//      $this->page = 0;
//
//      if (request::getInstance()->hasGet('page')) {
//        $this->page = (request::getInstance()->getGet('page') - 1);
//      }

      $this->countPages = salidaInsumoDetalleTableClass::getCountPages();
      $this->objSalidainsumoDetalle = salidaInsumoDetalleTableClass::getAll($fields, true, array(salidaInsumoDetalleTableClass::ID), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()));
      $this->defineView('index', 'salidaInsumoDetalle', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El cargo que intenta registar ya existe en la base de datos');
          break;
        case 00006:
          session::getInstance()->setWarning($exc->getMessage());
          break;
//        case '22P02':
//          session::getInstance()->setWarning('Ingresar datos validos');
//          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('salidaInsumoDetalle', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

}
