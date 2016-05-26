<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of clasificacionPosturaTableClass
 *
 * @author paola y scarpetta <paocas1794@hotmail.com>
 */
class clasificacionPosturaTableClass extends clasificacionPosturaBaseTableClass {

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM localizacion
      $sql = 'SELECT COUNT(' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::ID) . ') AS cantidad'
              . ' FROM ' . clasificacionPosturaTableClass::getNameTable()
              . ' WHERE ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::DELETED_AT) . ' IS NULL' . ' ';
//      echo $sql;
//      exit();
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
      $sql = 'SELECT COUNT(' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::ID) . ') AS cantidad'
              . ' FROM ' . clasificacionPosturaTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::DELETED_AT) . ' IS NULL';
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

  public static function getClasificacionPostura() {
    try {
      $sql = 'SELECT
      ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::ID) . ',
      ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::NOMBRE) . ',
      ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::DESCRIPCION) . ',
      ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::OBSERVACION) . ',
      ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::DELETED_AT) . '
      FROM ' . clasificacionPosturaTableClass::getNameTable() . '
      WHERE ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::DELETED_AT) . ' IS NULL'
              . ' ORDER BY ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::NOMBRE) . ' DESC';
      $params = array(
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer === 0 ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

//  public static function getClasificaciones() {
//    try {
//      $sql = 'SELECT
//      ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::ID) . ',
//      ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::NOMBRE) . '
//      FROM ' . clasificacionPosturaTableClass::getNameTable() . '
//      WHERE ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::DELETED_AT) . ' IS NULL'
//              . ' AND ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::CLASIFICACION_POSTURA_ID) . ' IS NULL '
//              . ' ORDER BY ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::NOMBRE) . ' ASC';
////      echo $sql;
////      exit();
//      $params = array(
//      );
//      $answer = modelClass::getInstance()->prepare($sql);
//      $answer->execute($params);
//      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//      return $answer === 0 ? false : $answer;
//    } catch (PDOException $exc) {
//      throw $exc;
//    }
//  }

  public static function getClasificacionPosturaById($id) {
    try {
      $sql = 'SELECT 
              ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::ID) . ',
              ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::NOMBRE) . ',
              ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::DESCRIPCION) . ',
              ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::OBSERVACION) . ',
              ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::DELETED_AT) . '
              FROM '
              . clasificacionPosturaTableClass::getNameTable() .
              ' WHERE ' . clasificacionPosturaTableClass::ID . ' = :id
              AND ' . clasificacionPosturaTableClass::DELETED_AT . ' IS NULL';
//      echo $sql;
//      exit();
      $params = array(
          ':id' => $id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer === 0 ? false : $answer[0];
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getClasificacionById($id) {
    try {
      $sql = 'SELECT 
              ' . clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::NOMBRE) . '
              
              FROM '
              . clasificacionPosturaTableClass::getNameTable() .
              ' WHERE ' . clasificacionPosturaTableClass::ID . ' = :id
              AND ' . clasificacionPosturaTableClass::DELETED_AT . ' IS NULL';
      //echo $sql;
      //exit();
      $params = array(
          ':id' => $id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return (count($answer) === 0) ? false : $answer[0]->nombre;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
