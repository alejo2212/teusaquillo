<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of tipo_insumoTableClass
 *
 * @author jhon fernando hoyos <jhonfernandohoyosdiaz@gmail.com>
 */
class unidadMedidaTableClass extends unidadMedidaBaseTableClass {
    
    public static function getNombreById($id) {
        try {
            // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
            $sql = 'SELECT ' . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::NOMBRE) . ' AS nombre'
                    . ' FROM ' . unidadMedidaTableClass::getNameTable()
                    . ' WHERE ' . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::ID) . ' = :id';
            $params = array(
                ':id' => $id
            );
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->nombre;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    public static function getCountPagesByWhere($where) {
    try {
      // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
      $sql = 'SELECT COUNT(' . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::ID) . ') AS cantidad'
              . ' FROM ' . unidadMedidaTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::DELETED_AT) . ' IS NULL';
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
      // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
      $sql = 'SELECT COUNT(' . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::ID) . ') AS cantidad'
              . ' FROM ' . unidadMedidaTableClass::getNameTable()
              . ' WHERE ' . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::DELETED_AT) . ' IS NULL';
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid()); // divide por el numero de grillas que definimos en config.php(2)
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
    

  public static function getUnidadMedidaById($id) {
    try {
      $sql = 'SELECT '
              . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::ID) . ', '
              . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::NOMBRE) . ', '
              . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::SIGLA) . ', '
              . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::OBSERVACION) . ', '
              . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::DELETED_AT) . ' '
              . ' FROM ' . unidadMedidaTableClass::getNameTable()
              . ' WHERE id = :id';
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



