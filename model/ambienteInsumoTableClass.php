<?php

use mvc\model\modelClass;
use mvc\config\configClass;
/**
 * Description of ambiente_insumoTableClass
 *
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class ambienteInsumoTableClass extends ambienteInsumoBaseTableClass {

     public static function getCountPages() {
    try {
      // SELECT COUNT(id) AS cantidad FROM ambienteInsumo where deleted_ad is null = contar todos los registros de una tabla
      $sql = 'SELECT COUNT(' . ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . ambienteInsumoTableClass::getNameTable()
              .' WHERE ' . ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::DELETED_AT) . ' IS NULL' ;
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
      $sql = 'SELECT COUNT(' . ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . ambienteInsumoTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::DELETED_AT) . ' IS NULL';
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
  
   public static function getAmbienteInsumoById($id) {
        try {
            $sql = 'SELECT '
                    . ' ambins.' . ambienteInsumoTableClass::ID . ', '
                    . ' ambins.' . ambienteInsumoTableClass::AMBIENTE_ID . ', '
                    . ' ambins.' . ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID . ', '
                     . ' ambins.' . ambienteInsumoTableClass::FECHA_ASIGNACION . ', '
                     . ' ambins.' . ambienteInsumoTableClass::FECHA_RETIRO . ', '
                    . ' ambins.' .  ambienteInsumoTableClass::AMBIENTE_ID
                    . ' FROM ' . ambienteInsumoTableClass::getNameTable() . ' as ambins INNER JOIN ' . ambienteTableClass::getNameTable() . ' as amb '
                    . ' ON ambins.' .ambienteInsumoTableClass::AMBIENTE_ID . ' = amb.' . ambienteTableClass::ID. ' '
                    . ' WHERE ambins.' . ambienteInsumoTableClass::ID. ' = :id';
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
  
  
}
