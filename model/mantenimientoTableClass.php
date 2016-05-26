<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of mantenimientoTableClass
 *
 * @author liliana carolina moreno <lilianacarol6@hotmail.com>
 */
class mantenimientoTableClass extends mantenimientoBaseTableClass {
  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM empleado
      $sql = 'SELECT COUNT(' . mantenimientoTableClass::getNameField(mantenimientoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . mantenimientoTableClass::getNameTable()
              . ' WHERE ' . mantenimientoTableClass::getNameField(mantenimientoTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . mantenimientoTableClass::getNameField(mantenimientoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . mantenimientoTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . mantenimientoTableClass::getNameField(mantenimientoTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . mantenimientoTableClass::getNameField(mantenimientoTableClass::DELETED_AT) . ' IS NULL';
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

  public static function getMantenimiento($id) {
    try {
      $sql = 'SELECT 
              ' . mantenimientoTableClass::getNameField(mantenimientoTableClass::ID) . ',
              ' . mantenimientoTableClass::getNameField(mantenimientoTableClass::MAQUINA_ID) . ',
              ' . mantenimientoTableClass::getNameField(mantenimientoTableClass::EMPLEADO_ID) . ',
              ' . mantenimientoTableClass::getNameField(mantenimientoTableClass::TIPO_MANTENIMIENTO_ID) . ',
              ' . mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_INICIO) . ',
              ' . mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_FIN) . ',
              ' . mantenimientoTableClass::getNameField(mantenimientoTableClass::CAUSA) . ',
              ' . mantenimientoTableClass::getNameField(mantenimientoTableClass::ARREGLO) . ',
              ' . mantenimientoTableClass::getNameField(mantenimientoTableClass::OBSERVACION) . ' 
              FROM '
              . mantenimientoTableClass::getNameTable() .
              ' WHERE ' . mantenimientoTableClass::getNameField(mantenimientoTableClass::ID) . ' = :id
              AND ' . mantenimientoTableClass::getNameField(mantenimientoTableClass::DELETED_AT) . ' IS NULL';
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
