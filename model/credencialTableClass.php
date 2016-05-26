<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of credencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class credencialTableClass extends credencialBaseTableClass {

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM cargo
      $sql = 'SELECT COUNT(' . credencialTableClass::getNameField(credencialTableClass::ID) . ') AS cantidad'
              . ' FROM ' . credencialTableClass::getNameTable()
              . ' WHERE ' . credencialTableClass::getNameField(credencialTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . credencialTableClass::getNameField(credencialTableClass::ID) . ') AS cantidad'
              . ' FROM ' . credencialTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . credencialTableClass::getNameField(credencialTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . credencialTableClass::getNameField(credencialTableClass::DELETED_AT) . ' IS NULL';
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

  public static function getCredencial($id) {
    try {
      $sql = 'SELECT
      ' . credencialTableClass::getNameField(credencialTableClass::ID) . ',
      ' . credencialTableClass::getNameField(credencialTableClass::NOMBRE) . ',
      ' . credencialTableClass::getNameField(credencialTableClass::CREATED_AT) . ',
      ' . credencialTableClass::getNameField(credencialTableClass::UPDATE_AT) . ',
      ' . credencialTableClass::getNameField(credencialTableClass::DELETED_AT) . '
      FROM ' . credencialTableClass::getNameTable() . '
      WHERE id = :id';
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

}
