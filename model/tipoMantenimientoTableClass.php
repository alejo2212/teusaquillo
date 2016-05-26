<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of tipoMantenimientoTableClass
 *
 * @author liliana carolina moreno <lilianacarol6@hotmail.com>
 */
class tipoMantenimientoTableClass extends tipoMantenimientoBaseTableClass {
  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM cargo
      $sql = 'SELECT COUNT(' . tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . tipoMantenimientoTableClass::getNameTable()
              . ' WHERE ' . tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . tipoMantenimientoTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::DELETED_AT) . ' IS NULL';
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
  
  public static function gettipoMante($id) {
    try {
      $sql = 'SELECT 
              '. tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::ID) . ',
              ' . tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::NOMBRE) . ',
              ' . tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::DESCRIPCION) . ' 
              FROM '
              . tipoMantenimientoTableClass::getNameTable().
              ' WHERE ' . tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::ID) . ' = :id
              AND ' . tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::DELETED_AT) . ' IS NULL';
//      echo $sql;
//      exit();
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
  
  public static function getTipoManteById($id) {
    try {
      $sql = 'SELECT '
              . tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::NOMBRE) . '
              FROM '
              . tipoMantenimientoTableClass::getNameTable() . 
              ' WHERE ' . tipoMantenimientoTableClass::ID . ' = :id
              AND ' . tipoMantenimientoTableClass::DELETED_AT . ' IS NULL';
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
