<?php

use mvc\model\modelClass;
use mvc\config\configClass;
/**
 * Description of maquinaTableClass
 *
 * @author liliana carolina moreno <lilianacarol6@hotmail.com>
 */
class maquinaTableClass extends maquinaBaseTableClass {
  
  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM empleado
      $sql = 'SELECT COUNT(' . maquinaTableClass::getNameField(maquinaTableClass::ID) . ') AS cantidad'
              . ' FROM ' . maquinaTableClass::getNameTable()
              . ' WHERE ' . maquinaTableClass::getNameField(maquinaTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . maquinaTableClass::getNameField(maquinaTableClass::ID) . ') AS cantidad'
              . ' FROM ' . maquinaTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . maquinaTableClass::getNameField(maquinaTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . maquinaTableClass::getNameField(maquinaTableClass::DELETED_AT) . ' IS NULL';
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

  public static function getMaquina($id) {
    try {
      $sql = 'SELECT 
              '. maquinaTableClass::getNameField(maquinaTableClass::ID) . ',
              ' . maquinaTableClass::getNameField(maquinaTableClass::CLASIFICACION_MAQUINA_ID) . ',
              ' . maquinaTableClass::getNameField(maquinaTableClass::FECHA_INGRESO) . ' ,
              ' . maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION) . ' ,
              ' . maquinaTableClass::getNameField(maquinaTableClass::CODIGO) . ',
              ' . maquinaTableClass::getNameField(maquinaTableClass::REFERENCIA) . ' ,
              ' . maquinaTableClass::getNameField(maquinaTableClass::FECHA_MANTENIMIENTO) . ',
              ' . maquinaTableClass::getNameField(maquinaTableClass::INTERVALO_MANTENIMIENTO) . ',
              ' . maquinaTableClass::getNameField(maquinaTableClass::ACTIVADO) . ',
              ' . maquinaTableClass::getNameField(maquinaTableClass::VALOR) . '
              FROM '
              . maquinaTableClass::getNameTable() . ' INNER JOIN ' . clasificacionMaquinaTableClass::getNameTable() . ''
              . ' ON '. maquinaTableClass::getNameTable().'.'. maquinaTableClass::CLASIFICACION_MAQUINA_ID . '=' . clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::ID) . ' '.
             
              ' WHERE ' . maquinaTableClass::getNameField(maquinaTableClass::ID) . ' = :id
              AND ' . maquinaTableClass::getNameField(maquinaTableClass::DELETED_AT) . ' IS NULL';
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
  
  public static function getMaquinaById($id) {
    try {
      $sql = 'SELECT '
              . maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION) . '
              FROM '
              . maquinaTableClass::getNameTable() . 
              ' WHERE ' . maquinaTableClass::ID . ' = :id
              AND ' . maquinaTableClass::DELETED_AT . ' IS NULL';
      //echo $sql;
      //exit();
      $params = array(
          ':id' => $id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return (count($answer) === 0) ? false : $answer[0]->descripcion;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
}
