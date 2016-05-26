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
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $salidaIn = request::getInstance()->getPost(salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID, true));
        $bodegaId = request::getInstance()->getPost(salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::BODEGA_ID, true));
        $cantidad = request::getInstance()->getPost(salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::CANTIDAD, true));
        $idInsumo = request::getInstance()->getPost(salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::INSUMO_ID, true));
        $observacion = request::getInstance()->getPost(salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::OBSERVACION, true));
        $anulado = 't';
        
        $this->Validations($bodegaId, $cantidad, $salidaIn, $observacion, $idInsumo);

        $cantInsuRequi = salidaInsumoDetalleTableClass::getCantiInsumoOfRequisicion($salidaIn, $idInsumo);
        $cantInsuSalDetalle = salidaInsumoDetalleTableClass::getCantiInsumoOfSaliDetalle($salidaIn, $idInsumo);
//        exit();
        if ($cantidad > $cantInsuRequi || ($cantInsuSalDetalle + $cantidad) > $cantInsuRequi) {
          if ($cantInsuSalDetalle == '') {
            $cantInsuSalDetalle = 0;
          }
          session::getInstance()->setWarning('La cantidad ingresada supera la cantidad solicitada en la requicicion. Cantidad solicitada (' . $cantInsuRequi . ') Disponible: (' . ($cantInsuRequi - $cantInsuSalDetalle) . ')');
          routing::getInstance()->redirect('salidaInsumoDetalle', 'new', array(salidaInsumoTableClass::ID => $salidaIn));
        } else {

          $newLeng = strlen($bodegaId);
          $clasibo = substr($bodegaId, $newLeng - 1, $newLeng);
          $lote = substr($bodegaId, 0, -1);
//        Array ( [0] => stdClass Object ( [id_bodega] => 12 [insumo] => Alimento Hembras [boclasi] => Teusaquillo 
//        [id_lote] => 2 [id_insumo] => 3 [fecha_vencimiento] => 2015-01-02 14:00:00 ) )
          $objIdBodega = bodegaTableClass::getIdBodega($lote, $clasibo, $idInsumo);
          foreach ($objIdBodega as $dataL):
            $idBodega = $dataL->id_bodega;
          endforeach;
//        exit();

          $post = array(
              salidaInsumoDetalleTableClass::BODEGA_ID => $idBodega,
              salidaInsumoDetalleTableClass::CANTIDAD => $cantidad,
              salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID => $salidaIn,
              salidaInsumoDetalleTableClass::INSUMO_ID => $idInsumo,
              salidaInsumoDetalleTableClass::OBSERVACION => $observacion
          );
          session::getInstance()->setAttribute('form', $post);

          session::getInstance()->setAttribute(salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::OBSERVACION, true), $observacion);

          $data = array(
              salidaInsumoDetalleTableClass::BODEGA_ID => $idBodega,
              salidaInsumoDetalleTableClass::CANTIDAD => $cantidad,
              salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID => $salidaIn,
              salidaInsumoDetalleTableClass::INSUMO_ID => $idInsumo,
              salidaInsumoDetalleTableClass::OBSERVACION => $observacion,
              salidaInsumoDetalleTableClass::ANULADO => $anulado
          );
          salidaInsumoDetalleTableClass::insert($data);
          
//          ACTUALIZAR EL INVENTARIO DE INSUMO EN LA TABLA BODEGA EN EL CAMPO CANTIDAD
          $idsBo = array(
              bodegaTableClass::ID => $idBodega
          );
          $can = bodegaTableClass::getCantidadInsumoById($idBodega);
          $can = $can - $cantidad;
          $dataBo = array(
              bodegaTableClass::CANTIDAD => $can
          );
          bodegaTableClass::update($idsBo, $dataBo);
          
//          ACTUALIZAR EL INVENTARIO DE INSUMO EN LA TABLA INSUMO EN EL CAMPO INVENTARIO_BODEGA
          $idsinsu = array(
              insumoTableClass::ID => $idInsumo
          );
          $canIn = insumoTableClass::getCantidadInsumoById($idInsumo);
          $canIn = $canIn - $cantidad;
          $dataInsu = array(
              insumoTableClass::INVENTARIO_BODEGA => $canIn
          );
          insumoTableClass::update($idsinsu, $dataInsu);
//          exit();
          session::getInstance()->setSuccess('Registro exitoso');

          routing::getInstance()->redirect('salidaInsumo', 'detail', array(salidaInsumoTableClass::ID => $salidaIn));
        }
      } else {
        routing::getInstance()->redirect('salidaInsumo', 'detail', array(salidaInsumoTableClass::ID => $salidaIn));
      }
      session::getInstance()->deleteAttribute('form');
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El Salida insumo detalle que Intenta Registar ya Existe en la Base de Datos');
          break;
        case 00006:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case 00008:
          session::getInstance()->setWarning($exc->getMessage());
          break;
//                case '22P02':
//                    session::getInstance()->setWarning('Ingresar datos validos');
//                    break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('salidaInsumoDetalle', 'new', array(salidaInsumoTableClass::ID => $salidaIn));
//routing::getInstance()->forward('security', 'new');
    }
  }

  private function Validations($bodegaId, $cantidad, $salidaIn, $observacion, $idInsumo) {
    if (!is_numeric($bodegaId)) {
      throw new PDOException('El Campo Bodega solo admite Datos Numericos', 00006);
    }
    if ($bodegaId === "") {
      throw new PDOException('El Campo Bodega no puede ir Vacio', 00007);
    }
    if (!is_numeric($idInsumo)) {
      throw new PDOException('El Campo Insumo solo admite Datos Numericos', 00006);
    }
    if ($idInsumo === "") {
      throw new PDOException('El Campo Insumo no puede ir Vacio', 00007);
    }
    
    if (!is_numeric($salidaIn)) {
      throw new PDOException('El Campo Salida Insumo Detalle solo admite Datos Numericos', 00006);
    }
    if ($salidaIn === "") {
      throw new PDOException('El Campo Salida Insumo Detalle no puede ir Vacio', 00007);
    }
    if (strlen($observacion) > salidaInsumoDetalleTableClass:: OBSERVACION_LENGTH) {
      throw new PDOException('La observacion  no pude ser mayor a ' . salidaInsumoDetalleTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
    }
    if (!is_numeric($cantidad)) {
      throw new PDOException('El Campo Cantidad  solo Admite Datos Numericos', 00006);
    }
    if ($cantidad === "") {
      throw new PDOException('El Campo Cantidad no puede ir Vacio', 00007);
    }
  }

}
