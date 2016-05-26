<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of insumoTableClass
 *
 * @author jhon fernando hoyos <jhonfernandohoyosdiaz@gmail.com>
 */
class bodegaTableClass extends bodegaBaseTableClass {

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
      $sql = 'SELECT COUNT(' . bodegaTableClass::getNameField(bodegaTableClass::ID) . ') AS cantidad'
              . ' FROM ' . bodegaTableClass::getNameTable()
              . ' WHERE ' . bodegaTableClass::getNameField(bodegaTableClass::DELETED_AT) . ' IS NULL';
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid()); // divide por el numero de grillas que definimos en config.php(2)
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getCountPagesByWhere($where) {
    try {
      // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
      $sql = 'SELECT COUNT(' . bodegaTableClass::getNameField(bodegaTableClass::ID) . ') AS cantidad'
              . ' FROM ' . bodegaTableClass::getNameTable();
      $flag = false;
      if (is_array($where) === true and $where != NULL) {
        foreach ($where as $field => $value) {
          if ($flag === false) {
            $sql = $sql . ' WHERE ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
            $flag = true;
          } else {
            $sql = $sql . ' AND ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
          }
        }
        $sql = $sql . ' AND ' . bodegaTableClass::getNameField(bodegaTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . bodegaTableClass::getNameField(bodegaTableClass::DELETED_AT) . ' IS NULL';
      }
//      echo $sql;
//      exit();
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid()); // divide por el numero de grillas que definimos en config.php(2)
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getBodegaById($id) {
    try {
      $sql = 'SELECT '
              . ' bo1.' . bodegaTableClass::ID . ', '
              . ' bo1.' . bodegaTableClass::LOTE_ID . ', '
              . ' bo1.' . bodegaTableClass::BODEGA_CLASIFICACION_ID . ', '
              . ' bo1.' . bodegaTableClass::INSUMO_ID . ', '
              . ' bo1.' . bodegaTableClass::ENTRADA_BODEGA_ID . ', '
              . ' bo1.' . bodegaTableClass::FECHA_VENCIMIENTO . ', '
              . ' bo1.' . bodegaTableClass::CANTIDAD . ', '
              . ' bo1.' . bodegaTableClass::ACTIVO . ' '
              . ' FROM ' . bodegaTableClass::getNameTable() . ' AS bo1 INNER JOIN ' . loteTableClass::getNameTable()
              . ' ON bo1.' . bodegaTableClass::LOTE_ID . ' = ' . loteTableClass::getNameField(loteTableClass::ID) . ', '
              . bodegaTableClass::getNameTable() . ' AS bo2 INNER JOIN ' . bodegaClasificacionTableClass::getNameTable()
              . ' ON bo2.' . bodegaTableClass::BODEGA_CLASIFICACION_ID . ' = ' . bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::ID) . ', '
              . bodegaTableClass::getNameTable() . ' AS bo3 INNER JOIN ' . insumoTableClass::getNameTable()
              . ' ON bo3.' . bodegaTableClass::INSUMO_ID . ' = ' . insumoTableClass::getNameField(insumoTableClass::ID) . ', '
              . bodegaTableClass::getNameTable() . ' AS bo4 INNER JOIN ' . entradaBodegaTableClass::getNameTable()
              . ' ON bo4.' . bodegaTableClass::ENTRADA_BODEGA_ID . ' = ' . entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID)
              . ' WHERE bo1.' . bodegaTableClass::ID . ' = :id'
              . ' AND bo1=bo2 '
              . ' AND bo1=bo3 '
              . ' AND bo3=bo2 '
              . ' AND bo4=bo1 '
              . ' AND bo4=bo2 '
              . ' AND bo4=bo3 ';
      // echo $sql;
      //exit();
      $params = array(':id' => $id);
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer[0];
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getBodegas() {
    try {
      $sql = 'SELECT
"public".lote.lote,
"public".bodega_clasificacion.nombre,
"public".bodega.bodega_clasificacion_id
FROM
"public".bodega
INNER JOIN "public".bodega_clasificacion ON "public".bodega.bodega_clasificacion_id = "public".bodega_clasificacion."id"
INNER JOIN "public".lote ON "public".bodega.lote_id = "public".lote."id"
GROUP BY
"public".lote.lote,
"public".bodega_clasificacion.nombre,
"public".bodega.bodega_clasificacion_id';
//      echo $sql;
//      exit();
      $params = array();
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getBodegasByInsumos($idInsumos) {
    try {
      $sql = 'SELECT
"public".lote.lote,
"public".bodega_clasificacion.nombre,
"public".bodega.bodega_clasificacion_id
FROM
"public".bodega
INNER JOIN "public".bodega_clasificacion ON "public".bodega.bodega_clasificacion_id = "public".bodega_clasificacion."id"
INNER JOIN "public".lote ON "public".bodega.lote_id = "public".lote."id"';
$flag = false;
      if (is_array($idInsumos) === true and $idInsumos != NULL) {
        foreach ($idInsumos as $field => $value) {
          if ($flag === false) {
            $newLeng = strlen($field) - 1;
            $field=substr($field, 0, $newLeng);
            $sql = $sql . ' WHERE ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
            $flag = true;
          } else {
            $newLeng = strlen($field) - 1;
            $field=substr($field, 0, $newLeng);
            $sql = $sql . ' OR ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
          }
        }
      }
$sql = $sql . ' GROUP BY
"public".lote.lote,
"public".bodega_clasificacion.nombre,
"public".bodega.bodega_clasificacion_id';
//      echo $sql;
//      exit();
      $params = array();
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
   public static function getCantidadInsumoById($id) {
        try {
            $sql = 'SELECT
"public".bodega.cantidad,
"public".bodega.insumo_id
FROM
"public".bodega
WHERE
"public".bodega."id" = :id AND
"public".bodega.activo = \'t\' AND
"public".bodega.deleted_at IS NULL';
           // echo $sql;
            //exit();
            $params = array(':id' => $id);
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer[0]->cantidad;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    public static function getIdBodega($lote, $clasibo, $idInsumo) {
    try {
      $sql = 'SELECT
MAX("public".bodega."id") AS id_bodega,
"public".insumo.nombre AS insumo,
"public".bodega_clasificacion.nombre AS boclasi,
"public".bodega.lote_id AS id_lote,
"public".insumo."id" AS id_insumo,
MIN("public".bodega.fecha_vencimiento) AS fecha_vencimiento
FROM
"public".insumo
INNER JOIN "public".bodega ON "public".bodega.insumo_id = "public".insumo."id"
INNER JOIN "public".bodega_clasificacion ON "public".bodega.bodega_clasificacion_id = "public".bodega_clasificacion."id"
WHERE
"public".bodega.lote_id = (SELECT "id" FROM lote WHERE lote.lote= :lote) AND
"public".bodega.bodega_clasificacion_id = :clasi AND
"public".insumo.deleted_at IS NULL AND
"public".insumo.activo = \'t\' AND
"public".bodega.deleted_at IS NULL AND
"public".bodega_clasificacion.deleted_at IS NULL AND 
insumo."id" = :insumo
GROUP BY "public".insumo.nombre, "public".bodega_clasificacion.nombre, "public".bodega.lote_id, "public".insumo."id"';
//      echo $sql;
//      exit();
      $params = array(
          'lote'=>$lote,
          'clasi'=>$clasibo,
          'insumo'=>$idInsumo
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getNombreBodegaById($id) {
        try {
            $sql = 'SELECT
"public".bodega_clasificacion.nombre
FROM
"public".bodega
INNER JOIN "public".bodega_clasificacion ON "public".bodega.bodega_clasificacion_id = "public".bodega_clasificacion."id"
WHERE
"public".bodega."id" = :id';
           // echo $sql;
            //exit();
            $params = array(':id' => $id);
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer[0]->nombre;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
}
