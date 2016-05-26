<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of tipo_insumoTableClass
 *
 * @author jhon fernando hoyos <jhonfernandohoyosdiaz@gmail.com>
 */
class tipoReparacionTableClass extends tipoReparacionBaseTableClass {

    public static function getNombreById($id) {
        try {
            // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
            $sql = 'SELECT ' . tipoReparacionTableClass::getNameField(tipoReparacionTableClass::NOMBRE) . ' AS nombre'
                    . ' FROM ' . tipoReparacionTableClass::getNameTable()
                    . ' WHERE ' . tipoReparacionTableClass::getNameField(tipoReparacionTableClass::ID) . ' = :id';
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
      $sql = 'SELECT COUNT(' . tipoReparacionTableClass::getNameField(tipoReparacionTableClass::ID) . ') AS cantidad'
              . ' FROM ' . tipoReparacionTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . tipoReparacionTableClass::getNameField(tipoReparacionTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . tipoReparacionTableClass::getNameField(tipoReparacionTableClass::DELETED_AT) . ' IS NULL';
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
            $sql = 'SELECT COUNT(' . tipoReparacionTableClass::getNameField(tipoReparacionTableClass::ID) . ') AS cantidad'
                    . ' FROM ' . tipoReparacionTableClass::getNameTable()
                    . ' WHERE ' . tipoReparacionTableClass::getNameField(tipoReparacionTableClass::DELETED_AT) . ' IS NULL';
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return ceil($answer[0]->cantidad / configClass::getRowGrid()); // divide por el numero de grillas que definimos en config.php(2)
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    public static function getTipoReparacionById($id) {
        try {
            $sql = 'SELECT '
                    . tipoReparacionTableClass::getNameField(tipoReparacionTableClass::ID) . ', '
                    . tipoReparacionTableClass::getNameField(tipoReparacionTableClass::NOMBRE) . ', '
                    . tipoReparacionTableClass::getNameField(tipoReparacionTableClass::OBSERVACION) . ', '
                    . tipoReparacionTableClass::getNameField(tipoReparacionTableClass::DELETED_AT) . ' '
                    . ' FROM ' . tipoReparacionTableClass::getNameTable()
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
