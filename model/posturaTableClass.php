<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of posturaTableClass
 *
 * @author paola y scarpetta <paocas1794@hotmail.com>
 */
class posturaTableClass extends posturaBaseTableClass {

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM cargo
      $sql = 'SELECT COUNT(' . posturaTableClass::getNameField(posturaTableClass::ID) . ') AS cantidad'
              . ' FROM ' . posturaTableClass::getNameTable()
              . ' WHERE ' . posturaTableClass::getNameField(posturaTableClass::DELETED_AT) . ' IS NULL';
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid());
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getCountPagesByWhere($where) {
    try {
      // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
      $sql = 'SELECT COUNT(' . posturaTableClass::getNameField(posturaTableClass::ID) . ') AS cantidad'
              . ' FROM ' . posturaTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . posturaTableClass::getNameField(posturaTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . posturaTableClass::getNameField(posturaTableClass::DELETED_AT) . ' IS NULL';
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

  public static function getPostura($id) {
    try {
      $sql = 'SELECT 
              ' . posturaTableClass::getNameField(posturaTableClass::ID) . ',
              ' . posturaTableClass::getNameField(posturaTableClass::AMBIENTE_ID) . ',
              ' . posturaTableClass::getNameField(posturaTableClass::LOTE_ID) . ',
              ' . posturaTableClass::getNameField(posturaTableClass::FECHA) . '
              FROM ' . posturaTableClass::getNameTable() . '
              WHERE ' . posturaTableClass::getNameField(posturaTableClass::ID) . ' = :id 
              AND ' . posturaTableClass::getNameField(posturaTableClass::DELETED_AT) . ' IS NULL';
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

  public static function getIdPostura() {
    try {
      $sql = 'SELECT 
              MAX(' . posturaTableClass::getNameField(posturaTableClass::ID) . ') AS maximo
              FROM ' . posturaTableClass::getNameTable();
      $params = array(
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->maximo;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getPostuIncuConsu($fIni, $fFin, $lote) {
    try {
      $sql = 'SELECT
Sum("public".postura_detalle.cantidad) AS postura,
(SELECT
Sum("public".postura_detalle.cantidad)
FROM
"public".postura_detalle
INNER JOIN "public".postura ON "public".postura_detalle.postura_id = "public".postura."id"
WHERE
"public".postura_detalle.clasificacion_postura_id = 2 AND
"public".postura.fecha BETWEEN :fIni AND :fFin AND
"public".postura_detalle.deleted_at IS NULL AND
"public".postura.deleted_at IS NULL AND
"public".postura.lote_id = :lote
) AS incubacion,
(SELECT
Sum("public".postura_detalle.cantidad)
FROM
"public".postura_detalle
INNER JOIN "public".postura ON "public".postura_detalle.postura_id = "public".postura."id"
WHERE
"public".postura_detalle.clasificacion_postura_id = 3 AND
"public".postura.fecha BETWEEN :fIni AND :fFin AND
"public".postura_detalle.deleted_at IS NULL AND
"public".postura.deleted_at IS NULL AND
"public".postura.lote_id = :lote
) AS consumo
FROM
"public".postura_detalle
INNER JOIN "public".postura ON "public".postura_detalle.postura_id = "public".postura."id"
WHERE
"public".postura_detalle.clasificacion_postura_id = 1 AND
"public".postura.fecha BETWEEN :fIni AND :fFin AND
"public".postura_detalle.deleted_at IS NULL AND
"public".postura.deleted_at IS NULL AND
"public".postura.lote_id = :lote';
//            echo $sql;
//            exit();
      $params = array(
          ':fIni' => $fIni,
          ':fFin' => $fFin,
          ':lote' => $lote
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//      print_r($answer);
//      exit();
      return (count($answer) === 0) ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
