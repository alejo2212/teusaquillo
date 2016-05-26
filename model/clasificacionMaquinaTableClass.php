<?php
use mvc\model\modelClass;
use mvc\config\configClass;
/**
 * Description of requisicionTableClass
 *
 * @author Jhonny Alejandro <jhonny2212@hotmail.com>
 */
class clasificacionMaquinaTableClass extends clasificacionMaquinaBaseTableClass{
  
  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM cargo
      $sql = 'SELECT COUNT(' . clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::ID) . ') AS cantidad'
              . ' FROM ' . clasificacionMaquinaTableClass::getNameTable()
              . ' WHERE ' . clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::ID) . ') AS cantidad'
              . ' FROM ' . clasificacionMaquinaTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::DELETED_AT) . ' IS NULL';
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
  
   public static function getclasificacionMaquina($id) {
    try {
      $sql = 'SELECT 
              '. clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::ID) . ',
              ' . clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::NOMBRE) . ',
              ' . clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::DESCRIPCION) . ' 
              FROM '
              . clasificacionMaquinaTableClass::getNameTable().
              ' WHERE ' . clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::ID) . ' = :id
              AND ' . clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::DELETED_AT) . ' IS NULL';
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
  
  public static function getClasiMaquinaById($id) {
    try {
      $sql = 'SELECT '
              . clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::NOMBRE) . '
              FROM '
              . clasificacionMaquinaTableClass::getNameTable() . 
              ' WHERE ' . clasificacionMaquinaTableClass::ID . ' = :id
              AND ' . clasificacionMaquinaTableClass::DELETED_AT . ' IS NULL';
      //echo $sql;
      //exit();
      $params = array(
          ':id' => $id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return (count($answer) === 0) ? false : $answer[0]->nombre;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
}
