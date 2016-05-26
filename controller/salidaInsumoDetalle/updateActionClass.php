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
 * @author Aleyda Mina Caicedo <aleminac@gmail.com>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      if (request::getInstance()->isMethod('POST')) {

        $id = request::getInstance()->getPost(salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::ID, true));
        $salidaIn = request::getInstance()->getPost(salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID, true));
        $bodegaId = request::getInstance()->getPost(salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::BODEGA_ID, true));
        $cantidad = request::getInstance()->getPost(salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::CANTIDAD, true));
        $idInsumo = request::getInstance()->getPost(salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::INSUMO_ID, true));
        $observacion = request::getInstance()->getPost(salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::OBSERVACION, true));
        $anulado = (request::getInstance()->hasPost(salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::ANULADO, true))) ? request::getInstance()->getPost(salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::ANULADO, true)) : 'f';
//        echo '<br><br>';
//        exit();
        /**
         * VALIDACIONES
         */
        $this->Validations($bodegaId, $cantidad, $salidaIn, $observacion, $idInsumo);

        /* ------------- */
        $newLeng = strlen($bodegaId);
        $clasibo = substr($bodegaId, $newLeng - 1, $newLeng);
        $lote = substr($bodegaId, 0, -1);
//        Array ( [0] => stdClass Object ( [id_bodega] => 12 [insumo] => Alimento Hembras [boclasi] => Teusaquillo 
//        [id_lote] => 2 [id_insumo] => 3 [fecha_vencimiento] => 2015-01-02 14:00:00 ) )
        $objIdBodega = bodegaTableClass::getIdBodega($lote, $clasibo, $idInsumo);
        foreach ($objIdBodega as $dataL):
          $bodegaId = $dataL->id_bodega;
        endforeach;

        $cantIB = salidaInsumoDetalleTableClass::getCantBodegCantInsumoByIdDetalleSalida($id);
//      
        foreach ($cantIB as $dataIB):
          $cantbodega = $dataIB->cantinsumo;
          $cantinsumo = $dataIB->cantbodega;
          $cantdetalle = $dataIB->cantdetalle;
        endforeach;

        echo $Cdetalle = $cantdetalle - $cantidad . '<br>';
        if ($Cdetalle > 0) {
//          echo 'mayor=' . $Cdetalle;
//          ACTUALIZAR EL INVENTARIO DE INSUMO EN LA TABLA BODEGA EN EL CAMPO CANTIDAD          
          $idsBo = array(
              bodegaTableClass::ID => $bodegaId
          );
          $can = bodegaTableClass::getCantidadInsumoById($bodegaId);
          $can = $can + $Cdetalle;
          $dataBo = array(
              bodegaTableClass::CANTIDAD => $can
          );
          bodegaTableClass::update($idsBo, $dataBo);
//          ACTUALIZAR EL INVENTARIO DE INSUMO EN LA TABLA INSUMO EN EL CAMPO INVENTARIO_BODEGA
          $idsinsu = array(
              insumoTableClass::ID => $idInsumo
          );
          $canIn = insumoTableClass::getCantidadInsumoById($idInsumo);
          $canIn = $canIn + $Cdetalle;
          $dataInsu = array(
              insumoTableClass::INVENTARIO_BODEGA => $canIn
          );
          insumoTableClass::update($idsinsu, $dataInsu);
        } else {
          if ($Cdetalle < 0) {
//            echo 'menor=' . $Cdetalle;
//          ACTUALIZAR EL INVENTARIO DE INSUMO EN LA TABLA BODEGA EN EL CAMPO CANTIDAD
            $idsBo = array(
                bodegaTableClass::ID => $bodegaId
            );
            $can = bodegaTableClass::getCantidadInsumoById($bodegaId);
            $can = $can + $Cdetalle;
            $dataBo = array(
                bodegaTableClass::CANTIDAD => $can
            );
            bodegaTableClass::update($idsBo, $dataBo);
//          ACTUALIZAR EL INVENTARIO DE INSUMO EN LA TABLA INSUMO EN EL CAMPO INVENTARIO_BODEGA
            $idsinsu = array(
                insumoTableClass::ID => $idInsumo
            );
            $canIn = insumoTableClass::getCantidadInsumoById($idInsumo);
            $canIn = $canIn + $Cdetalle;
            $dataInsu = array(
                insumoTableClass::INVENTARIO_BODEGA => $canIn
            );
            insumoTableClass::update($idsinsu, $dataInsu);
          }
        }

//        exit();
        $ids = array(
            salidaInsumoDetalleTableClass::ID => $id
        );

        $data = array(
            salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID => $salidaIn,
            salidaInsumoDetalleTableClass::BODEGA_ID => $bodegaId,
            salidaInsumoDetalleTableClass::CANTIDAD => $cantidad,
            salidaInsumoDetalleTableClass::INSUMO_ID => $idInsumo,
            salidaInsumoDetalleTableClass::OBSERVACION => $observacion,
            salidaInsumoDetalleTableClass::ANULADO => $anulado
        );
        salidaInsumoDetalleTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Actualización exitosa');

        routing::getInstance()->redirect('salidaInsumo', 'detail', array(salidaInsumoDetalleTableClass::ID => $salidaIn));
      } else {
        routing::getInstance()->redirect('salidaInsumo', 'detail', array(salidaInsumoDetalleTableClass::ID => $salidaIn));
      }
      session::getInstance()->deleteAttribute('form');
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La Salida Insumo  que intenta registar ya existe en la base de datos');
          break;
        case 00006:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case '22P02':
          session::getInstance()->setWarning('Ingresar Datos Validos');
          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('salidaInsumoDetalle', 'edit', array(salidaInsumoDetalleTableClass::ID => $id));
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
      throw new PDOException('El Campo Salida Insumo Detalle Solo admite datos Numericos', 00006);
    }
    if ($salidaIn === "") {
      throw new PDOException('El Campo Salida Insumo Detalle no puede ir Vacio', 00007);
    }

    if (strlen($observacion) > salidaInsumoDetalleTableClass::OBSERVACION_LENGTH) {
      throw new PDOException('La observacion  no pude ser mayor a ' . salidaInsumoDetalleTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
    }

    if (!is_numeric($cantidad)) {
      throw new PDOException('El Campo Cantidad  Solo admite Datos Numericos', 00006);
    }
    if ($cantidad === "") {
      throw new PDOException('El Campo Cantidad no puede ir Vacio', 00007);
    }
  }

}
