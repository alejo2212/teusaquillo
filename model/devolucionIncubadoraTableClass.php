<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of incubadoraTableClass
 *
 * @author paula andrea lopez cruz <palopez7317@misena.edu.co>
 */
class devolucionIncubadoraTableClass extends devolucionIncubadoraBaseTableClass {

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM empleado
      $sql = 'SELECT COUNT(' . devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::ID) . ') AS cantidad'
              . ' FROM ' . devolucionIncubadoraTableClass::getNameTable()
              . ' WHERE ' . devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::DELETED_AT) . ' IS NULL';
//      echo $sql;
//      exit();
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
      $sql = 'SELECT COUNT(' . devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::ID) . ') AS cantidad'
              . ' FROM ' . devolucionIncubadoraTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::DELETED_AT) . ' IS NULL';
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

  public static function getSalidaIncu($id) {
    try {
      $sql = 'SELECT 
              ' . devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::ID) . ',
              ' . devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID) . ',
              ' . devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_LLEGADA) . ',
              ' . devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_FALTANTE) . ',
              ' . devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION) . ',
              ' . devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::FECHA) . ',
              ' . devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::EMPLEADO) . '
              FROM '
              . devolucionIncubadoraTableClass::getNameTable() .
              ' WHERE ' . devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::ID) . ' = :id
              AND ' . devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::DELETED_AT) . ' IS NULL';
//      echo $sql;
//      exit();
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
