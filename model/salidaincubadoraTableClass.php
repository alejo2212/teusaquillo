<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of incubadoraTableClass
 *
 * @author paula andrea lopez cruz <palopez7317@misena.edu.co>
 */
class salidaincubadoraTableClass extends salidaincubadoraBaseTableClass {

    public static function getCountPages() {
        try {
            // SELECT COUNT(id) FROM cargo
            $sql = 'SELECT COUNT(' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::ID) . ') AS cantidad'
                    . ' FROM ' . salidaincubadoraTableClass::getNameTable()
                    . ' WHERE ' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::ID) . ') AS cantidad'
              . ' FROM ' . salidaincubadoraTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::DELETED_AT) . ' IS NULL';
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

    public static function getSalidaIncubadora($id) {
        try {
            $sql = 'SELECT 
              ' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::ID) . ',
              ' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::ID_ANUAL) . ',
              ' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::CANTIDAD) . ',
              ' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA) . ',
              ' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::NO_PEDIDO) . ',
              ' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_LLEGADA) . ',
              ' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_SALIDAD) . ',
              ' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::OBSERVACION) . ',
              ' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::EMPLEADO_ID) . '
              FROM ' . salidaincubadoraTableClass::getNameTable().'
              WHERE ' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::ID) . ' = :id 
              AND ' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::DELETED_AT) . ' IS NULL';
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

    public static function getIdSalida() {
        try {
            $sql = 'SELECT 
              MAX(' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::ID) . ') AS maximo
              FROM ' . salidaincubadoraTableClass::getNameTable();
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
    
    public static function getNpedido() {
        try {
            $sql = 'SELECT 
              MAX(' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::NO_PEDIDO) . ') AS maximo
              FROM ' . salidaincubadoraTableClass::getNameTable();
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
    
    public static function getIdAnual($id) {
        try {
            $sql = 'SELECT 
              MAX(' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::ID_ANUAL) . ') AS idanual
              FROM ' . salidaincubadoraTableClass::getNameTable().
              ' WHERE ' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::ID) . ' = :id' ;
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
    
    public static function getIdAnualById($id) {
        try {
            $sql = 'SELECT 
              ' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::ID_ANUAL) . ' AS idanual
              FROM ' . salidaincubadoraTableClass::getNameTable().
             ' WHERE ' . salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::ID) . ' = :id' ;
            $params = array(
                ':id' => $id
            );
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer[0]->idanual;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    public static function getIdSalidaIncubadoraByNpedido($salidaIncu) {
        try {
            $sql = 'SELECT
"public".salida_incubadora."id" AS idsalida
FROM
"public".salida_incubadora
WHERE
"public".salida_incubadora.no_pedido = :id' ;
            $params = array(
                ':id' => $salidaIncu
            );
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer[0]->idsalida;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    public static function getFechaById($id) {
        try {
            $sql = 'SELECT
"public".salida_incubadora.fecha
FROM
"public".salida_incubadora
WHERE
"public".salida_incubadora."id" = :id' ;
            $params = array(
                ':id' => $id
            );
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer[0]->fecha;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

}
