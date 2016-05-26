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
 * @author Aleyda Mina  <aleminac@gmail.com>
 */
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet('id')) {
        $id = request::getInstance()->getGet('id');
        $this->SalidainsumoDetalle = salidaInsumoDetalleTableClass::getSalidaInsumoDetalleById($id);
        $this->edit = true;
        $fieldsInsumo = array(
            insumoTableClass::ID,
            insumoTableClass::NOMBRE
        );
        
        $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true, array(insumoTableClass::NOMBRE), 'ASC');

//    funciones para traer las bodegas que contengan x insumos unicamente mediante el numero
//    de la requisicion que se ingreso en la salida insumo
        $idSalidaInsu = salidaInsumoTableClass::getIdSalidaInsumoById($id);
        
        $idRequisicion = salidaInsumoTableClass::getSalidaInsumoById($idSalidaInsu);
        $idRequisicion->requisicion_id;

        $idInsumos = requisiciondetalleTableClass::getIdInsumosByIdRequisicion($idRequisicion->requisicion_id);
        $idinsu = array();
        $i = 0;
        foreach ($idInsumos as $field) {
          $idinsu[bodegaTableClass::INSUMO_ID . $i] = $field->insumo_id;
          $i++;
        }
//    print_r($idinsu);
//    exit();
        $this->objBodegas = bodegaTableClass::getBodegasByInsumos($idinsu);
//    exit();
//    funciones para traer las bodegas que contengan x insumos unicamente
//    de la requisicion que se ingreso en la salida insumo

        $this->defineView('edit', 'salidaInsumoDetalle', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('salidaInsumoDetalle', 'index');
      }
      session::getInstance()->deleteAttribute('form');
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La Salida Insumo Detalle que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('salidaInsumoDetalle', 'edit');
      //routing::getInstance()->forward('security', 'new');
    }
  }

}
