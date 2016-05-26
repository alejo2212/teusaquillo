<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of transporatdorTableClass
 *
 * @author jhon fernando hoyos <jhonfernandohoyosdiaz@gmail.com>
 */
class transportadorTableClass extends transportadorBaseTableClass {

    public static function getNombreById($id) {
        try {
            // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
            $sql = 'SELECT ' . transportadorTableClass::getNameField(transportadorTableClass::NOMBRE) . ' AS nombre'
                    . ' FROM ' . transportadorTableClass::getNameTable()
                    . ' WHERE ' . transportadorTableClass::getNameField(transportadorTableClass::ID) . ' = :id';
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
      $sql = 'SELECT COUNT(' . transportadorTableClass::getNameField(transportadorTableClass::ID) . ') AS cantidad'
              . ' FROM ' . transportadorTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . transportadorTableClass::getNameField(transportadorTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . transportadorTableClass::getNameField(transportadorTableClass::DELETED_AT) . ' IS NULL';
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
            $sql = 'SELECT COUNT(' . transportadorTableClass::getNameField(transportadorTableClass::ID) . ') AS cantidad'
                    . ' FROM ' . transportadorTableClass::getNameTable()
                    . ' WHERE ' . transportadorTableClass::getNameField(transportadorTableClass::DELETED_AT) . ' IS NULL';
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return ceil($answer[0]->cantidad / configClass::getRowGrid()); // divide por el numero de grillas que definimos en config.php(2)
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    public static function getTransportadorById($id) {
        try {
            $sql = 'SELECT '
                    . transportadorTableClass::getNameField(transportadorTableClass::ID) . ', '
                    . transportadorTableClass::getNameField(transportadorTableClass::NOMBRE) . ', '
                    . transportadorTableClass::getNameField(transportadorTableClass::OBSERVACION) . ', '
                    . transportadorTableClass::getNameField(transportadorTableClass::PLACA_VAHICULO) . ', '
                    . transportadorTableClass::getNameField(transportadorTableClass::DELETED_AT) . ' '
                    . ' FROM ' . transportadorTableClass::getNameTable()
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
