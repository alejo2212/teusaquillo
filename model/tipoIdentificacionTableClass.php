<?php

use mvc\model\modelClass;
use mvc\config\configClass;
/**
 * Description of requisiciondetalleTableClass
 *
 * @author Jhonny Alejandro <jhonny2212@hotmail.com>
 */
class tipoIdentificacionTableClass extends tipoIdentificacionBaseTableClass {
  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM tipoid
      $sql = 'SELECT COUNT(' . tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ID) . ') AS cantidad'
              . ' FROM ' . tipoIdentificacionTableClass::getNameTable()
              . ' WHERE ' . tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ID) . ') AS cantidad'
              . ' FROM ' . tipoIdentificacionTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DELETED_AT) . ' IS NULL';
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
  
  public static function getAllTipoid($id) {
    try {
      $sql = 'SELECT 
              ' . tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ID) . ',
              ' . tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DESCRIPCION) . ',
              ' . tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ABREVIATURA) . '
              FROM ' . tipoIdentificacionTableClass::getNameTable() . '
              WHERE ' . tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ID) . ' = :id 
              AND ' . tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DELETED_AT) . ' IS NULL';
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
  
  public static function getTipoid($id) {
   try {
      $sql = 'SELECT '
              . tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DESCRIPCION) . '
              FROM '
              . tipoIdentificacionTableClass::getNameTable() . 
              ' WHERE ' . tipoIdentificacionTableClass::ID . ' = :id
              AND ' . tipoIdentificacionTableClass::DELETED_AT . ' IS NULL';
      //echo $sql;
      //exit();
      $params = array(
          ':id' => $id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return (count($answer) === 0) ? false : $answer[0]->descripcion;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
}
