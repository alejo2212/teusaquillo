<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of tipo_insumoTableClass
 *
 * @author jhon fernando hoyos <jhonfernandohoyosdiaz@gmail.com>
 */
class tipoInsumoTableClass extends tipoInsumoBaseTableClass {

    public static function getNombreById($id) {
        try {
            // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
            $sql = 'SELECT ' . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE) . ' AS nombre'
                    . ' FROM ' . tipoInsumoTableClass::getNameTable()
                    . ' WHERE ' . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID) . ' = :id';
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
      $sql = 'SELECT COUNT(' . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . tipoInsumoTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DELETED_AT) . ' IS NULL';
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
            $sql = 'SELECT COUNT(' . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID) . ') AS cantidad'
                    . ' FROM ' . tipoInsumoTableClass::getNameTable()
                    . ' WHERE ' . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DELETED_AT) . ' IS NULL';
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return ceil($answer[0]->cantidad / configClass::getRowGrid()); // divide por el numero de grillas que definimos en config.php(2)
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    public static function getTipoInsumoById($id) {
        try {
            $sql = 'SELECT '
                    . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID) . ', '
                    . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE) . ', '
                    . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::OBSERVACION) . ', '
                    . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DELETED_AT) . ' '
                    . ' FROM ' . tipoInsumoTableClass::getNameTable()
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
