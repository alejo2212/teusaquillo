<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of salida_insumoTableClass
 *
 * @author Jhonny Alejandro <jhonny2212@hotmail.com>
 */
class salidaInsumoTableClass extends salidaInsumoBaseTableClass {

    public static function getCountPages() {
        try {
            // SELECT COUNT(id) AS cantidad FROM salidaInsumo where deleted_ad is null = contar todos los registros de una tabla
            $sql = 'SELECT COUNT(' . salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ID) . ') AS cantidad'
                    . ' FROM ' . salidaInsumoTableClass::getNameTable()
                    . ' WHERE ' . salidaInsumoTableClass::getNameField(salidaInsumoTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . salidaInsumoTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . salidaInsumoTableClass::getNameField(salidaInsumoTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . salidaInsumoTableClass::getNameField(salidaInsumoTableClass::DELETED_AT) . ' IS NULL';
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

    public static function getSalidaInsumoById($id) {
        try {
            $sql = 'SELECT '
                    . 'sal.' . salidaInsumoTableClass::ID . ', '
                    . 'sal.' . salidaInsumoTableClass::EMPLEADO_ID_SALIDA . ', '
                    . 'sal.' .  salidaInsumoTableClass::EMPLEADO_ID_RECEPCION . ', '
                    . 'sal.' . salidaInsumoTableClass::FECHA . ', '
                    . 'sal.' . salidaInsumoTableClass::OBSERVACION . ', '
                    . 'sal.' . salidaInsumoTableClass::ANULADO . ', '
                    . 'sal.' . salidaInsumoTableClass::REQUISICION_ID . ', '
                    . 'sal.' . salidaInsumoTableClass::DELETED_AT . ' '
                    . ' FROM '
                    . salidaInsumoTableClass::getNameTable() . ' as sal INNER JOIN ' . empleadoTableClass::getNameTable() . ' as empl ON sal.' . salidaInsumoTableClass::EMPLEADO_ID_SALIDA . ' = empl.' . empleadoTableClass::ID . ', '
                    . salidaInsumoTableClass::getNameTable() . ' as sal1 INNER JOIN ' . empleadoTableClass::getNameTable() . ' as empl1 ON sal1.' . salidaInsumoTableClass::EMPLEADO_ID_RECEPCION . ' = empl1.' . empleadoTableClass::ID . ' '
                    . ' WHERE '
                    . ' sal = sal1 and sal.id = :id ';
            $params = array(':id' => $id);
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer[0];
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    public static function getIdSalidaInsumo() {
    try {
      $sql = 'SELECT 
              MAX(' . salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ID) . ') AS maximo
              FROM ' . salidaInsumoTableClass::getNameTable();
      $params = array(
          
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->maximo;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getIdSalidaInsumoById($id) {
    try {
      $sql = 'SELECT
"public".salida_insumo_detalle.salida_insumo_id as id
FROM
"public".salida_insumo_detalle
WHERE
"public".salida_insumo_detalle."id" = :id AND
"public".salida_insumo_detalle.deleted_at IS NULL';
      $params = array(
          ':id'=>$id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer[0]->id;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
