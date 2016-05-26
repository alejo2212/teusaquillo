<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of requisiciondetalleTableClass
 *
 * @author Jhonny Alejandro <jhonny2212@hotmail.com>
 */
class requisiciondetalleTableClass extends requisiciondetalleBaseTableClass {

  public static function getCountPages($id) {
    try {
      // SELECT COUNT(id) FROM requisiciondetalle
      $sql = 'SELECT COUNT(' . requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::ID) . ') AS cantidad'
              . ' FROM ' . requisiciondetalleTableClass::getNameTable()
              . ' WHERE ' . requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::DELETED_AT) . ' IS NULL'
              . ' AND '. requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::REQUISICION_ID) . ' = :id';
      $params = array(
          ':id' => $id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid());
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getdetalleRequisicion($id) {
    try {
      $sql = 'SELECT 
              ' . requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::ID) . ',
              ' . requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::REQUISICION_ID) . ',
              ' . requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::BODEGA_ID) . ',
              ' . requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::CANTIDAD) . ',
              ' . requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::FECHA_NECESIDAD) . ',
              ' . requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::DELETED_AT) . '
              FROM ' . requisiciondetalleTableClass::getNameTable() . '
              WHERE ' . requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::ID) . ' = :id 
              AND ' . requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::DELETED_AT) . ' IS NULL';
      $params = array(
          ':id' => $id
      );
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
                    "public".bodega."id",
                    "public".bodega_clasificacion.nombre
                   
                    FROM
                    "public".bodega
                    INNER JOIN "public".bodega_clasificacion ON "public".bodega.bodega_clasificacion_id = "public".bodega_clasificacion."id"
                    ORDER BY
                     "public".bodega_clasificacion.nombre ASC, "public".bodega.id ASC';

//      echo $sql;
//      exit();
            $params = array();
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);

            return (count($answer) === 0) ? false : $answer;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    public static function getInsumosByIdRequisicion($id) {
        try {
            $sql = 'SELECT
                    "public".insumo.nombre,
                    "public".requisicion_detalle.cantidad
                    FROM
                    "public".requisicion_detalle
                    INNER JOIN "public".insumo ON "public".requisicion_detalle.insumo_id = "public".insumo."id"
                    WHERE
                    "public".requisicion_detalle.requisicion_id = :id
                    ORDER BY
                    "public".insumo.nombre ASC,
                    "public".requisicion_detalle.cantidad ASC';

//      echo $sql;
//      exit();
            $params = array(':id' => $id);
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);

            return (count($answer) === 0) ? false : $answer;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    public static function getIdInsumosByIdRequisicion($id) {
        try {
            $sql = 'SELECT
"public".requisicion_detalle.insumo_id
FROM
"public".requisicion_detalle
WHERE
"public".requisicion_detalle.requisicion_id = :id AND
"public".requisicion_detalle.deleted_at IS NULL
GROUP BY
"public".requisicion_detalle.insumo_id';

//      echo $sql;
//      exit();
            $params = array(':id' => $id);
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);

            return (count($answer) === 0) ? false : $answer;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
}
