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
class deleteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {
        $id = request::getInstance()->getPost('id');
        $ids = array(
            salidaInsumoDetalleTableClass::ID => $id
        );
        salidaInsumoDetalleTableClass::delete($ids, true);// se cambio a true para borrar logicamente no aparece en la rejilla pero en BD si esta.
        $this->answer = array(
            'code' => 200
        );

        $res = salidaInsumoDetalleTableClass::getBodegIdInsumoIdCantidadByIdDetalleSalida($id);
//      
        foreach ($res as $data):
          $bodegaId = $data->bodega_id;
          $insumoId = $data->insumo_id;
          $cantidad = $data->cantidad;
        endforeach;
//          ACTUALIZAR EL INVENTARIO DE INSUMO EN LA TABLA BODEGA EN EL CAMPO CANTIDAD
          $idsBo = array(
              bodegaTableClass::ID => $bodegaId
          );
          $can = bodegaTableClass::getCantidadInsumoById($bodegaId);
          $can = $can + $cantidad;
          $dataBo = array(
              bodegaTableClass::CANTIDAD => $can
          );
          bodegaTableClass::update($idsBo, $dataBo);
//          ACTUALIZAR EL INVENTARIO DE INSUMO EN LA TABLA INSUMO EN EL CAMPO INVENTARIO_BODEGA
          $idsinsu = array(
              insumoTableClass::ID => $insumoId
          );
          $canIn = insumoTableClass::getCantidadInsumoById($insumoId);
          $canIn = $canIn + $cantidad;
          $dataInsu = array(
              insumoTableClass::INVENTARIO_BODEGA => $canIn
          );
          insumoTableClass::update($idsinsu, $dataInsu);

        session::getInstance()->setSuccess('El registro fue eliminado satisfactoriamente');
        $this->defineView('delete', 'salidaInsumoDetalle', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('salidaInsumoDetalle', 'index');
      }
    } catch (PDOException $exc) {
      //session::getInstance()->setError($exc->getMessage());
      $this->answer = array(
          'code' => 500,
          'error' => $exc->getMessage()
      );
      //routing::getInstance()->redirect('security', 'index');
    }
  }

}
