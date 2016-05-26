<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of salidaLoteTableClass
 *
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class salidaLoteTableClass extends salidaLoteBaseTableClass {

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) AS cantidad FROM salidaLote where deleted_ad is null = contar todos los registros de una tabla
      $sql = 'SELECT COUNT(' . salidaLoteTableClass::getNameField(salidaLoteTableClass::ID) . ') AS cantidad'
              . ' FROM ' . salidaLoteTableClass::getNameTable()
              . ' WHERE ' . salidaLoteTableClass::getNameField(salidaLoteTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . salidaLoteTableClass::getNameField(salidaLoteTableClass::ID) . ') AS cantidad'
              . ' FROM ' . salidaLoteTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . salidaLoteTableClass::getNameField(salidaLoteTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . salidaLoteTableClass::getNameField(salidaLoteTableClass::DELETED_AT) . ' IS NULL';
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

//    public static function getSalidaLoteById($id) {
//        try {
//            $sql = 'SELECT '
//                    . salidaLoteTableClass::getNameField(salidaLoteTableClass::ID) . ', '
//                    . salidaLoteTableClass::getNameField(salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID) . ', '
//                    . salidaLoteTableClass::getNameField(salidaLoteTableClass::RAZON_SALIDA_ID) . ', '
//                    . salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_TOTAL) . ', '
//                    . salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_MACHOS) . ', '
//                    . salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_HEMBRAS) . ', '
//                    . salidaLoteTableClass::getNameField(salidaLoteTableClass::EMPLEADO_ID) . ', '
//                    . salidaLoteTableClass::getNameField(salidaLoteTableClass::DELETED_AT) . ' '
//                    . ' FROM ' . salidaLoteTableClass::getNameTable()
//                    . ' WHERE id = :id';
//            $params = array(':id' => $id);
//            $answer = modelClass::getInstance()->prepare($sql);
//            $answer->execute($params);
//            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//            return (count($answer) === 0) ? false : $answer[0];
//        } catch (PDOException $exc) {
//            throw $exc;
//        }
//    }

  public static function getSalidaLoteById($id) {
    try {
      $sql = 'SELECT '
              . ' slote1.' . salidaLoteTableClass::ID . ', '
              . ' slote1.' . salidaLoteTableClass::FECHA_REALI . ', '
              . ' slote1.' . salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID . ', '
              . ' slote1.' . salidaLoteTableClass::CANTIDAD_TOTAL . ', '
              . ' slote1.' . salidaLoteTableClass::CANTIDAD_MACHOS . ', '
              . ' slote1.' . salidaLoteTableClass::CANTIDAD_HEMBRAS . ', '
              . ' slote1.' . salidaLoteTableClass::RAZON_SALIDA_ID . ', '
              . ' slote1.' . salidaLoteTableClass::EMPLEADO_ID . ' '
              . ' FROM '
              . salidaLoteTableClass::getNameTable() . ' as slote1 INNER JOIN ' . razonSalidaTableClass::getNameTable() . ' as razon ON slote1.' . salidaLoteTableClass::RAZON_SALIDA_ID . ' = razon.' . razonSalidaTableClass::ID . ', '
              . salidaLoteTableClass::getNameTable() . ' as slote2 INNER JOIN ' . empleadoTableClass::getNameTable() . ' as empleado ON slote2.' . salidaLoteTableClass::EMPLEADO_ID . '= empleado.' . empleadoTableClass::ID . ' '
              . ' WHERE slote1.' . salidaLoteTableClass::ID . ' = :id'
              . ' AND slote1=slote2';
//            echo $sql;
//            exit();
      $params = array(':id' => $id);
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer[0];
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getIdSalidaLote() {
    try {
      $sql = 'SELECT 
              MAX(' . salidaLoteTableClass::getNameField(salidaLoteTableClass::ID) . ') AS maximo
              FROM ' . salidaLoteTableClass::getNameTable();
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
  
  public static function getMachosHembras($id) {
    try {
      $sql = 'SELECT
"public".salida_lote.cantidad_machos AS machos,
"public".salida_lote.cantidad_hembras AS hembras
FROM
"public".salida_lote
WHERE
"public".salida_lote."id" = :id
 AND '. salidaLoteTableClass::getNameField(salidaLoteTableClass::DELETED_AT) . ' IS NULL';
      $params = array(
          ':id' => $id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getIdAhl($id) {
    try {
      $sql = 'SELECT
"public".salida_lote.ambiente_historial_lote_id AS ahl
FROM
"public".salida_lote
WHERE
"public".salida_lote."id" = :id 
 AND '. salidaLoteTableClass::getNameField(salidaLoteTableClass::DELETED_AT) . ' IS NULL';
      $params = array(
          ':id' => $id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->ahl;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
