<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of alistamientoReparacionTableClass
 *
 * @author jhon fernando hoyos <jhonfernandohoyosdiaz@gmail.com>
 */
class alistamientoReparacionTableClass extends alistamientoReparacionBaseTableClass {

    public static function getNombreById($id) {
        try {
            // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
            $sql = 'SELECT ' . alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::ID) . ' ,'
                    . ' FROM ' . alistamientoReparacionTableClass::getNameTable()
                    . ' WHERE ' . alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::ID) . ' = :id';
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
      $sql = 'SELECT COUNT(' . alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::ID) . ') AS cantidad'
              . ' FROM ' . alistamientoReparacionTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::DELETED_AT) . ' IS NULL';
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
            $sql = 'SELECT COUNT(' . alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::ID) . ') AS cantidad'
                    . ' FROM ' . alistamientoReparacionTableClass::getNameTable()
                    . ' WHERE ' . alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::DELETED_AT) . ' IS NULL';
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return ceil($answer[0]->cantidad / configClass::getRowGrid()); // divide por el numero de grillas que definimos en config.php(2)
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    public static function getalistamientoReparacionById($id) {
        try {
            $sql = 'SELECT '
                    . ' bode1.' . alistamientoReparacionTableClass::ID . ', '
                    . ' bode1.' . alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID . ', '
                    . ' bode1.' . alistamientoReparacionTableClass::TIPO_REPARACION_ID . ', '
                    . ' bode1.' . alistamientoReparacionTableClass::FECHA_INICIO . ', '
                    . ' bode1.' . alistamientoReparacionTableClass::FECHA_FIN . ' '
                    . ' FROM ' . alistamientoReparacionTableClass::getNameTable() . ' AS bode1 INNER JOIN ' . tipoReparacionTableClass::getNameTable()
                    . ' ON bode1.' . alistamientoReparacionTableClass::TIPO_REPARACION_ID . ' = ' . tipoReparacionTableClass::getNameField(tipoReparacionTableClass::ID) . ' '
                    . ' WHERE bode1.' . alistamientoReparacionTableClass::ID . ' = :id';
            // echo $sql;
            //exit();
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
