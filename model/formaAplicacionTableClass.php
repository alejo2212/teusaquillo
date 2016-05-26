<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of formaAplicacionTableClass
 *
 * @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com>
 */
class formaAplicacionTableClass extends formaAplicacionBaseTableClass {
     
   
    public static function getCountPages() {
    try {
      // SELECT COUNT(id) as cantidad FROM formaAplicacion WHERE deleted_at is null = contar todos los registros de una tabla
      $sql = 'SELECT COUNT(' . formaAplicacionTableClass::getNameField(formaAplicacionTableClass::ID) . ') AS cantidad'
              . ' FROM ' . formaAplicacionTableClass::getNameTable()
              . ' WHERE ' . formaAplicacionTableClass::getNameField(formaAplicacionTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . formaAplicacionTableClass::getNameField(formaAplicacionTableClass::ID) . ') AS cantidad'
              . ' FROM ' . formaAplicacionTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . formaAplicacionTableClass::getNameField(formaAplicacionTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . formaAplicacionTableClass::getNameField(formaAplicacionTableClass::DELETED_AT) . ' IS NULL';
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
    
    public static function getFormaAplicacionById($id) {
    try {
      $sql = 'SELECT '
              . formaAplicacionTableClass::getNameField(formaAplicacionTableClass::ID) . ', '
              . formaAplicacionTableClass::getNameField(formaAplicacionTableClass::NOMBRE) . ', '
              . formaAplicacionTableClass::getNameField(formaAplicacionTableClass::DESCRIPCION) . ', '
              . formaAplicacionTableClass::getNameField(formaAplicacionTableClass::DELETED_AT) . ' '
              . ' FROM ' . formaAplicacionTableClass::getNameTable()
              . ' WHERE ' . formaAplicacionTableClass::getNameField(formaAplicacionTableClass::ID) . '= :id';
      $params = array(':id' => $id);
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer[0];
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getNombreById($id) {
    try {
      $sql = 'SELECT '
              . formaAplicacionTableClass::getNameField(formaAplicacionTableClass::NOMBRE)
              . ' FROM ' . formaAplicacionTableClass::getNameTable()
              . ' WHERE ' . formaAplicacionTableClass::getNameField(formaAplicacionTableClass::ID) . '= :id';
      $params = array(':id' => $id);
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer[0]->nombre;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
