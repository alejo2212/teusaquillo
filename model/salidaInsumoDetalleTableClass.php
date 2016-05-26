<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of salida_insumo_detalleTableClass
 *
 * @author Jhonny Alejandro <jhonny2212@hotmail.com>
 */
class salidaInsumoDetalleTableClass extends salidaInsumoDetalleBaseTableClass {

    public static function getCountPages() {
        try {
            // SELECT COUNT(id) AS cantidad FROM salidaInsumo where deleted_ad is null = contar todos los registros de una tabla
            $sql = 'SELECT COUNT(' . salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::ID) . ') AS cantidad'
                    . ' FROM ' . salidaInsumoDetalleTableClass::getNameTable()
                    . ' WHERE ' . salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::DELETED_AT) . ' IS NULL';
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return ceil($answer[0]->cantidad / configClass::getRowGrid());
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    public static function getSalidaInsumoDetalleById($id) {
        try {
            $sql = 'SELECT '
                    . salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::ID) . ', '
                    . salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID) . ', '
                    . salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::BODEGA_ID) . ', '
                    . salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::INSUMO_ID) . ', '
                    . salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::CANTIDAD) . ', '
                    . salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::OBSERVACION) . ', '
                    . salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::ANULADO) . ', '
                    . salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::DELETED_AT) . ' '
                    . ' FROM ' . salidaInsumoDetalleTableClass::getNameTable()
                    . ' WHERE id = :id';
            $params = array(':id' => $id);
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer[0];
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    public static function getInsumosByIdSalidaInsumo($id) {
        try {
            $sql = 'SELECT "public".insumo.nombre AS nombre, "public".salida_insumo_detalle.cantidad AS cantidad,
"public".salida_insumo_detalle.cantidad - (SELECT Sum("public".control_alimento.cantidad) as disponible 
FROM "public".control_alimento
WHERE "public".control_alimento.salida_insumo_detalle_id = :id) AS disponible
FROM "public".salida_insumo_detalle
INNER JOIN "public".insumo ON "public".salida_insumo_detalle.insumo_id = "public".insumo."id"
WHERE "public".salida_insumo_detalle.salida_insumo_id = :id
ORDER BY nombre ASC';
            $params = array(':id' => $id);
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    public static function getInsumosById($idBodega, $lote) {
        try {
            $sql = 'SELECT
"public".insumo."id" as id,
"public".insumo.nombre as insumo
FROM
"public".bodega
INNER JOIN "public".insumo ON "public".bodega.insumo_id = "public".insumo."id"
INNER JOIN "public".bodega_clasificacion ON "public".bodega.bodega_clasificacion_id = "public".bodega_clasificacion."id"
INNER JOIN "public".lote ON "public".lote."id" = "public".bodega.lote_id
WHERE
"public".insumo.deleted_at IS NULL AND
"public".bodega.deleted_at IS NULL AND
"public".bodega_clasificacion.deleted_at IS NULL AND
"public".bodega.activo = \'t\' AND
"public".insumo.activo = \'t\' AND
"public".bodega_clasificacion.activo = \'t\' AND
"public".bodega.bodega_clasificacion_id = :id AND
"public".lote.lote = :lote group by insumo.id';
            $params = array(
                ':id' => $idBodega,
                ':lote' => $lote
            );
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    public static function getCantInsumoById($idBodega, $lote, $idInsu, $idSalInsu) {
        try {
            $sql = 'SELECT
"public".insumo."id" as id,
"public".insumo.nombre as insumo,
"public".bodega."id" AS idbodega,
"public".bodega.cantidad,
"public".bodega.cantidad - (SELECT Sum("public".salida_insumo_detalle.cantidad) as disponible 
FROM "public".salida_insumo_detalle
WHERE "public".salida_insumo_detalle.salida_insumo_id = :idSalInsu 
AND "public".salida_insumo_detalle.insumo_id = :idInsu) AS disponible
FROM
"public".bodega
INNER JOIN "public".insumo ON "public".bodega.insumo_id = "public".insumo."id"
INNER JOIN "public".bodega_clasificacion ON "public".bodega.bodega_clasificacion_id = "public".bodega_clasificacion."id"
INNER JOIN "public".lote ON "public".lote."id" = "public".bodega.lote_id
WHERE
"public".insumo.deleted_at IS NULL AND
"public".bodega.deleted_at IS NULL AND
"public".bodega_clasificacion.deleted_at IS NULL AND
"public".bodega.activo = \'t\' AND
"public".insumo.activo = \'t\' AND
"public".bodega_clasificacion.activo = \'t\' AND
"public".insumo."id" = :idInsu AND
"public".bodega.bodega_clasificacion_id = :id AND
"public".lote.lote = :lote';
            $params = array(
                ':idSalInsu' => $idSalInsu,
                ':idInsu' => $idInsu,
                ':id' => $idBodega,
                ':lote' => $lote
            );
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    public static function getCantiInsumoOfRequisicion($salidaIn, $idInsumo) {
    try {
      $sql = 'SELECT
"public".requisicion_detalle.cantidad as cantidadrequi
FROM
"public".salida_insumo
INNER JOIN "public".requisicion ON "public".requisicion."id" = "public".salida_insumo.requisicion_id
INNER JOIN "public".requisicion_detalle ON "public".requisicion."id" = "public".requisicion_detalle.requisicion_id
WHERE
"public".salida_insumo."id" = :salidaIn AND
"public".requisicion_detalle.insumo_id = :idInsumo AND
"public".salida_insumo.deleted_at IS NULL AND
"public".requisicion.deleted_at IS NULL AND
"public".requisicion_detalle.deleted_at IS NULL AND
"public".salida_insumo.anulado = \'t\' AND
"public".requisicion.anulado = \'f\'';
      $params = array(
          ':salidaIn'=>$salidaIn,
          ':idInsumo'=>$idInsumo
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer[0]->cantidadrequi;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getCantiInsumoOfSaliDetalle($salidaIn, $idInsumo) {
    try {
      $sql = 'SELECT
Sum("public".salida_insumo_detalle.cantidad) AS cantidad
FROM
"public".salida_insumo_detalle
WHERE
"public".salida_insumo_detalle.salida_insumo_id = :salidaIn AND
"public".salida_insumo_detalle.insumo_id = :idInsumo AND
"public".salida_insumo_detalle.anulado = \'t\' AND
"public".salida_insumo_detalle.deleted_at IS NULL';
      $params = array(
          ':salidaIn'=>$salidaIn,
          ':idInsumo'=>$idInsumo
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer[0]->cantidad;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getBodegIdInsumoIdCantidadByIdDetalleSalida($id) {
        try {
            $sql = 'SELECT
"public".salida_insumo_detalle.bodega_id,
"public".salida_insumo_detalle.insumo_id,
"public".salida_insumo_detalle.cantidad
FROM
"public".salida_insumo_detalle
WHERE
"public".salida_insumo_detalle."id" = :id';
            $params = array(
                ':id' => $id
            );
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    public static function getCantBodegCantInsumoByIdDetalleSalida($id) {
        try {
            $sql = 'SELECT
"public".insumo.inventario_bodega AS cantinsumo,
"public".bodega.cantidad AS cantbodega,
"public".salida_insumo_detalle.cantidad AS cantdetalle
FROM
"public".salida_insumo_detalle
INNER JOIN "public".insumo ON "public".insumo."id" = "public".salida_insumo_detalle.insumo_id
INNER JOIN "public".bodega ON "public".bodega."id" = "public".salida_insumo_detalle.bodega_id
WHERE
"public".salida_insumo_detalle."id" = :id';
            $params = array(
                ':id' => $id
            );
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

}
