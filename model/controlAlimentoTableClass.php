<?php

use mvc\model\modelClass;
use mvc\config\configClass;
/**
 * Description of control_alimentoTableClass
 *
 * @author Jhonny Alejandro <jhonny2212@hotmail.com>
 */
class controlAlimentoTableClass extends controlAlimentoBaseTableClass {

  public static function getDataControlAlimento($id) {
    try {
      $sql = 'SELECT ' . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID) . ', ' 
              . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::AMBIENTE_HISTORIAL_LOTE_ID) . ', ' 
              . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SALIDA_INSUMO_DETALLE_ID) . ', ' 
              . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID_EMPLEADO) . ', ' 
              . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEXO) . ', ' 
              . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::CANTIDAD) . ', ' 
              . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA) . ', ' 
              . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEMANA) . ', ' 
              . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::OBSERVACION) . ', ' 
              . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::DELETED_AT) . ' '
              . 'FROM ' . controlAlimentoTableClass::getNameTable() . ' '
              . 'WHERE ' . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID) . ' = :id ';
      $params = array(
        'id' => $id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer[0];
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM controlalimento
      $sql = 'SELECT COUNT(' . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . controlAlimentoTableClass::getNameTable();
//      echo $sql;
//      exit();
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return round($answer[0]->cantidad / configClass::getRowGrid(),0);
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getCountPagesByWhere($where) {
    try {
      // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
      $sql = 'SELECT COUNT(' . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . controlAlimentoTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::DELETED_AT) . ' IS NULL';
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

}
