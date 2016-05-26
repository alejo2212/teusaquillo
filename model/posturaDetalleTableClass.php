<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of posturaDetalleTableClass
 *
 * @author paola y scarpetta <paocas1794@hotmail.com>
 */
class posturaDetalleTableClass extends posturaDetalleBaseTableClass {

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM requisiciondetalle
      $sql = 'SELECT COUNT(' . posturaDetalleTableClass::getNameField(posturaDetalleTableClass::ID) . ') AS cantidad'
              . ' FROM ' . posturaDetalleTableClass::getNameTable()
              . ' WHERE ' . posturaDetalleTableClass::getNameField(posturaDetalleTableClass::DELETED_AT) . ' IS NULL';
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid());
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getdetallePostura($id) {
    try {
      $sql = 'SELECT 
              ' . posturaDetalleTableClass::getNameField(posturaDetalleTableClass::ID) . ',
              ' . posturaDetalleTableClass::getNameField(posturaDetalleTableClass::POSTURA_ID) . ',
              ' . posturaDetalleTableClass::getNameField(posturaDetalleTableClass::CLASIFICACION_POSTURA_ID) . ',
              ' . posturaDetalleTableClass::getNameField(posturaDetalleTableClass::EMPLEADO_ID) . ',
              ' . posturaDetalleTableClass::getNameField(posturaDetalleTableClass::CANTIDAD) . ',
              ' . posturaDetalleTableClass::getNameField(posturaDetalleTableClass::INGRESO_VENTA) . ',
              ' . posturaDetalleTableClass::getNameField(posturaDetalleTableClass::DELETED_AT) . '
              FROM ' . posturaDetalleTableClass::getNameTable() . '
              WHERE ' . posturaDetalleTableClass::getNameField(posturaDetalleTableClass::ID) . ' = :id 
              AND ' . posturaDetalleTableClass::getNameField(posturaDetalleTableClass::DELETED_AT) . ' IS NULL';
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
                    WHERE ' . posturaDetalleTableClass::getNameField(posturaDetalleTableClass::DELETED_AT) . ' IS NULL 
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
  
  public static function getPosturaIncuConsumoById($idpostu, $idcla) {
    try {
      $sql = 'SELECT
"public".postura_detalle.clasificacion_postura_id AS "id",
"public".clasificacion_postura.nombre,
"public".postura_detalle.cantidad
FROM
"public".postura_detalle
INNER JOIN "public".clasificacion_postura ON "public".clasificacion_postura."id" = "public".postura_detalle.clasificacion_postura_id
WHERE
"public".postura_detalle.postura_id = :id AND
"public".postura_detalle.deleted_at IS NULL AND
"public".clasificacion_postura.deleted_at IS NULL AND
"public".postura_detalle.clasificacion_postura_id = :idcla';

//      echo $sql;
//      exit();
      $params = array(
          ':id' => $idpostu,
          ':idcla' => $idcla
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return (count($answer) === 0) ? false : $answer[0]->cantidad;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getSumHuevos($id) {
    try {
      $sql = 'SELECT
Sum("public".postura_detalle.cantidad) AS cantidad
FROM
"public".postura_detalle
WHERE
"public".postura_detalle.postura_id = :id AND '
 . posturaDetalleTableClass::getNameField(posturaDetalleTableClass::DELETED_AT) . ' IS NULL';
      $params = array(
          ':id' => $id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->cantidad;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getNumeroClasificaciones($id) {
    try {
      $sql = 'SELECT
"public".postura_detalle.clasificacion_postura_id as clasificacion
FROM
"public".postura_detalle
WHERE
"public".postura_detalle.postura_id = :id AND
"public".postura_detalle.deleted_at IS NULL';
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
  
  public static function getNumeroClasi($id, $postu) {
    try {
      $sql = 'SELECT
"public".postura_detalle.clasificacion_postura_id as clasificacion
FROM
"public".postura_detalle
WHERE
"public".postura_detalle.clasificacion_postura_id = :id AND
"public".postura_detalle.deleted_at IS NULL AND
"public".postura_detalle.postura_id = :postu
GROUP BY
"public".postura_detalle.clasificacion_postura_id';
      $params = array(
          ':id' => $id,
          ':postu' => $postu
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer[0]->clasificacion;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
