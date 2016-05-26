<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of incubadoraTableClass
 *
 * @author paula andrea lopez <palopez7317@misena.edu.co>
 */
class incubadoraTableClass extends incubadoraBaseTableClass {

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM cargo
      $sql = 'SELECT COUNT(' . incubadoraTableClass::getNameField(incubadoraTableClass::ID) . ') AS cantidad'
              . ' FROM ' . incubadoraTableClass::getNameTable()
              . ' WHERE ' . incubadoraTableClass::getNameField(incubadoraTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . incubadoraTableClass::getNameField(incubadoraTableClass::ID) . ') AS cantidad'
              . ' FROM ' . incubadoraTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . incubadoraTableClass::getNameField(incubadoraTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . incubadoraTableClass::getNameField(incubadoraTableClass::DELETED_AT) . ' IS NULL';
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
  
  public static function getIncubadora($id) {
    try {
      $sql = 'SELECT 
              '. incubadoraTableClass::getNameField(incubadoraTableClass::ID) . ',
              ' . incubadoraTableClass::getNameField(incubadoraTableClass::LOCALIZACION_ID) . ',
              ' . incubadoraTableClass::getNameField(incubadoraTableClass::NOMBRE) . ',
              ' . incubadoraTableClass::getNameField(incubadoraTableClass::DIRECCION) . ',
              ' . incubadoraTableClass::getNameField(incubadoraTableClass::OBSERVACION) . ' 
              FROM '
              . incubadoraTableClass::getNameTable().
              ' WHERE ' . incubadoraTableClass::getNameField(incubadoraTableClass::ID) . ' = :id
              AND ' . incubadoraTableClass::getNameField(incubadoraTableClass::DELETED_AT) . ' IS NULL';
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
  public static function getIncubadoraById($id) {
    try {
      $sql = 'SELECT '
              . incubadoraTableClass::getNameField(incubadoraTableClass::NOMBRE) . '
              FROM '
              . incubadoraTableClass::getNameTable() . 
              ' WHERE ' . incubadoraTableClass::ID . ' = :id
              AND ' . incubadoraTableClass::DELETED_AT . ' IS NULL';
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
