<?php

use mvc\model\modelClass;
use mvc\config\configClass;
/**
 * Description of razonSalidaTableClass
 *
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class razonSalidaTableClass extends razonSalidaBaseTableClass {
    
    public static function getNombreById($id) {
        try {
            $sql = 'SELECT ' . razonSalidaTableClass::getNameField(razonSalidaTableClass::RAZON) . ' AS nombre'
                    . ' FROM ' . razonSalidaTableClass::getNameTable()
                    . ' WHERE ' . razonSalidaTableClass::getNameField(razonSalidaTableClass::ID) . ' = :id';

            $params = array(':id' => $id
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
      $sql = 'SELECT COUNT(' . razonSalidaTableClass::getNameField(razonSalidaTableClass::ID) . ') AS cantidad'
              . ' FROM ' . razonSalidaTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . razonSalidaTableClass::getNameField(razonSalidaTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . razonSalidaTableClass::getNameField(razonSalidaTableClass::DELETED_AT) . ' IS NULL';
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
      // SELECT COUNT(id) AS cantidad FROM razonSalida where deleted_ad is null = contar todos los registros de una tabla
      $sql = 'SELECT COUNT(' . razonSalidaTableClass::getNameField(razonSalidaTableClass::ID) . ') AS cantidad'
              . ' FROM ' . razonSalidaTableClass::getNameTable()
              .' WHERE ' . razonSalidaTableClass::getNameField(razonSalidaTableClass::DELETED_AT) . ' IS NULL' ;
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid());
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
    public static function getRazonSalidaById($id) {
        try {
            $sql = 'SELECT '
                    . razonSalidaTableClass::getNameField(razonSalidaTableClass::ID) . ', '
                    . razonSalidaTableClass::getNameField(razonSalidaTableClass::RAZON) . ', '
                    . razonSalidaTableClass::getNameField(razonSalidaTableClass::OBSERVACION) . ', '
                    . razonSalidaTableClass::getNameField(razonSalidaTableClass::DELETED_AT) . ' '
                    
                    . ' FROM ' . razonSalidaTableClass::getNameTable()
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
