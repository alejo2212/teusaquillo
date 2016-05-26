<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of tipoEmpaqueTableClass
 *
 * @author paola y scarpetta <paocas1794@hotmail.com>
 */
class tipoEmpaqueTableClass extends tipoEmpaqueBaseTableClass {

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM cargo
      $sql = 'SELECT COUNT(' . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::ID) . ') AS cantidad'
              . ' FROM ' . tipoEmpaqueTableClass::getNameTable()
              . ' WHERE ' . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::ID) . ') AS cantidad'
              . ' FROM ' . tipoEmpaqueTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::DELETED_AT) . ' IS NULL';
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

  public static function getTipoEmpaque($id) {
    try {
      $sql = 'SELECT 
              ' . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::ID) . ',
              ' . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::NOMBRE) . ',
              ' . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::CANTIDAD) . ',
              ' . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::DESCRIPCION) . '
              FROM ' . tipoEmpaqueTableClass::getNameTable() . '
              WHERE ' . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::ID) . ' = :id 
              AND ' . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::DELETED_AT) . ' IS NULL';
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

  public static function getTipoEmpaqueById($id) {
    try {
      $sql = 'SELECT '
              . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::NOMBRE) . '
              FROM '
              . tipoEmpaqueTableClass::getNameTable() .
              ' WHERE ' . tipoEmpaqueTableClass::ID . ' = :id
              AND ' . tipoEmpaqueTableClass::DELETED_AT . ' IS NULL';
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
