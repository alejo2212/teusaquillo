<?php

use mvc\model\modelClass;
use mvc\config\configClass;
/**
 * Description of requisicionTableClass
 *
 * @author Jhonny Alejandro <jhonny2212@hotmail.com>
 */
class requisicionTableClass extends requisicionBaseTableClass {

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM cargo
      $sql = 'SELECT COUNT(' . requisicionTableClass::getNameField(requisicionTableClass::ID) . ') AS cantidad'
              . ' FROM ' . requisicionTableClass::getNameTable()
              . ' WHERE ' . requisicionTableClass::getNameField(requisicionTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . requisicionTableClass::getNameField(requisicionTableClass::ID) . ') AS cantidad'
              . ' FROM ' . requisicionTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . requisicionTableClass::getNameField(requisicionTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . requisicionTableClass::getNameField(requisicionTableClass::DELETED_AT) . ' IS NULL';
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

  public static function getRequisicion($id) {
    try {
      $sql = 'SELECT 
              ' . requisicionTableClass::getNameField(requisicionTableClass::ID) . ',
              ' . requisicionTableClass::getNameField(requisicionTableClass::EMPLEADO_ID) . ',
              ' . requisicionTableClass::getNameField(requisicionTableClass::FECHA_REALIZACION) . ',
              ' . requisicionTableClass::getNameField(requisicionTableClass::ANULADO) . '
              FROM ' . requisicionTableClass::getNameTable() . ' INNER JOIN ' . empleadoTableClass::getNameTable() . ' ON ' . requisicionTableClass::getNameField(requisicionTableClass::EMPLEADO_ID) . '=' . empleadoTableClass::getNameField(empleadoTableClass::ID) . '
              WHERE ' . requisicionTableClass::getNameField(requisicionTableClass::ID) . ' = :id 
              AND ' . requisicionTableClass::getNameField(requisicionTableClass::DELETED_AT) . ' IS NULL';
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
  
  public static function getIdRequisicion() {
    try {
      $sql = 'SELECT 
              MAX(' . requisicionTableClass::getNameField(requisicionTableClass::ID) . ') AS maximo
              FROM ' . requisicionTableClass::getNameTable();
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

}
