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
class newActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
      if (session::getInstance()->hasAttribute('form')) {
            $salidaInsumoDetalle = session::getInstance()->getAttribute('form');
            session::getInstance()->setFlash('salidaInsumoDetalle', $salidaInsumoDetalle);
        }
//        $fieldsBodegas = array(
//            bodegaClasificacionTableClass::ID,
//            bodegaClasificacionTableClass::NOMBRE
//        );
        $fieldsInsumo = array(
            insumoTableClass::ID,
            insumoTableClass::NOMBRE
        );
        $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true, array(insumoTableClass::NOMBRE), 'ASC');
        
    $this->id = request::getInstance()->getRequest('id');
    
//    funciones para traer las bodegas que contengan x insumos unicamente mediante el numero
//    de la requisicion que se ingreso en la salida insumo
    $idRequisicion = salidaInsumoTableClass::getSalidaInsumoById($this->id);
    $idRequisicion->requisicion_id;
    
    $idInsumos = requisiciondetalleTableClass::getIdInsumosByIdRequisicion($idRequisicion->requisicion_id);
    $idinsu=array();
    $i=0;
    foreach ($idInsumos as $field) {
      $idinsu[bodegaTableClass::INSUMO_ID.$i] = $field->insumo_id;
      $i++;
    }
//    print_r($idinsu);
//    exit();
    $this->objBodegas =  bodegaTableClass::getBodegasByInsumos($idinsu);
//    exit();
//    funciones para traer las bodegas que contengan x insumos unicamente
//    de la requisicion que se ingreso en la salida insumo
    
    $this->defineView('new', 'salidaInsumoDetalle', session::getInstance()->getFormatOutput());
  }

}
