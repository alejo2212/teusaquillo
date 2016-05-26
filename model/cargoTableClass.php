<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of requisicionTableClass
 *
 * @author Jhonny Alejandro <jhonny2212@hotmail.com>
 */
class cargoTableClass extends cargoBaseTableClass {

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM cargo
      $sql = 'SELECT COUNT(' . cargoTableClass::getNameField(cargoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . cargoTableClass::getNameTable()
              . ' WHERE ' . cargoTableClass::getNameField(cargoTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . cargoTableClass::getNameField(cargoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . cargoTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . cargoTableClass::getNameField(cargoTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . cargoTableClass::getNameField(cargoTableClass::DELETED_AT) . ' IS NULL';
      }
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid()); // divide por el numero de grillas que definimos en config.php(2)
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getCargo($id) {
    try {
      $sql = 'SELECT 
              ' . cargoTableClass::getNameField(cargoTableClass::ID) . ',
              ' . cargoTableClass::getNameField(cargoTableClass::NOMBRE) . ',
              ' . cargoTableClass::getNameField(cargoTableClass::DESCRIPCION) . '
              FROM ' . cargoTableClass::getNameTable() . '
              WHERE ' . cargoTableClass::getNameField(cargoTableClass::ID) . ' = :id 
              AND ' . cargoTableClass::getNameField(cargoTableClass::DELETED_AT) . ' IS NULL';
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

  public static function getCargoById($id) {
    try {
      $sql = 'SELECT '
              . cargoTableClass::getNameField(cargoTableClass::NOMBRE) . '
              FROM '
              . cargoTableClass::getNameTable() .
              ' WHERE ' . cargoTableClass::ID . ' = :id
              AND ' . cargoTableClass::DELETED_AT . ' IS NULL';
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
