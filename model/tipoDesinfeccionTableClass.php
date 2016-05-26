<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of tipoDesinfeccionTableClass
 *
 * @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com>
 */
class tipoDesinfeccionTableClass extends tipoDesinfeccionBaseTableClass {
    
    
    public static function getNombreById($id) {
        try {
            // SELECT COUNT(id) as cantidad FROM tipoDesinfeccion= contar todos los registros de una tabla
            $sql = 'SELECT ' . tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::NOMBRE) . ' AS nom '
                    . ' FROM ' . tipoDesinfeccionTableClass::getNameTable()
                    . ' WHERE ' . tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::ID) . ' = :id';
            $params = array(
                ':id' => $id
            );
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->nom;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    public static function getCountPagesByWhere($where) {
    try {
      // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
      $sql = 'SELECT COUNT(' . tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::ID) . ') AS cantidad'
              . ' FROM ' . tipoDesinfeccionTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::DELETED_AT) . ' IS NULL';
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
    
    public static function getCountPages() {
    try {
      // SELECT COUNT(id) as cantidad FROM tipoDesinfeccion WHERE deleted_at is null = contar todos los registros de una tabla
      $sql = 'SELECT COUNT(' . tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::ID) . ') AS cantidad'
              . ' FROM ' . tipoDesinfeccionTableClass::getNameTable()
              . ' WHERE ' . tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::DELETED_AT) . ' IS NULL';
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid());
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
    
    

  public static function getTipoDesinfeccionById($id) {
    try {
      $sql = 'SELECT '
              . tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionBaseTableClass::ID) . ', '
              . tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::NOMBRE) . ', '
              . tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::OBSERVACION) . ', '
              . tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::DELETED_AT) . ' '
              . ' FROM ' . tipoDesinfeccionTableClass::getNameTable()
              . ' WHERE ' . tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::ID) . '= :id';
      $params = array(':id' => $id);
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer[0];
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
}