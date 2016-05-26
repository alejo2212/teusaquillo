<?php
use mvc\model\modelClass;
use mvc\config\configClass;
/**
 * Description of localidadTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class localidadTableClass extends localidadBaseTableClass {
  
  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM localizacion
      $sql = 'SELECT COUNT(' . localidadTableClass::getNameField(localidadTableClass::ID) . ') AS cantidad'
              . ' FROM ' . localidadTableClass::getNameTable()
              . ' WHERE ' . localidadTableClass::getNameField(localidadTableClass::DELETED_AT) . ' IS NULL' . ' '
              . ' AND ' . localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID) . ' <> ' . 0;
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
      $sql = 'SELECT COUNT(' . localidadTableClass::getNameField(localidadTableClass::ID) . ') AS cantidad'
              . ' FROM ' . localidadTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID) . ' <> ' . 0;
      }else{
          $sql = $sql . ' WHERE ' . localidadTableClass::getNameField(localidadTableClass::DELETED_AT) . ' IS NULL' .
                  ' AND ' . localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID) . ' <> ' . 0;
      }
      
      echo $sql;
      exit();
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid()); // divide por el numero de grillas que definimos en config.php(2)
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getLocalidades() {
    try {
      $sql = 'SELECT
      ' . localidadTableClass::getNameField(localidadTableClass::ID) . ',
      ' . localidadTableClass::getNameField(localidadTableClass::NOMBRE) . ',
      ' . localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID) . ',
      ' . localidadTableClass::getNameField(localidadTableClass::DELETED_AT) . '
      FROM ' . localidadTableClass::getNameTable() . '
      WHERE ' . localidadTableClass::getNameField(localidadTableClass::DELETED_AT) . ' IS NULL'
              . ' ORDER BY ' . localidadTableClass::getNameField(localidadTableClass::NOMBRE) . ' ASC';
      $params = array(
         
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer === 0 ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  public static function getLocalidadesById($id) {
    try {
      $sql = 'SELECT
      ' . localidadTableClass::getNameField(localidadTableClass::ID) . ',
      ' . localidadTableClass::getNameField(localidadTableClass::NOMBRE) . ',
      ' . localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID) . ',
      ' . localidadTableClass::getNameField(localidadTableClass::DELETED_AT) . '
      FROM ' . localidadTableClass::getNameTable() . '
      WHERE ' . localidadTableClass::getNameField(localidadTableClass::DELETED_AT) . ' IS NULL'
              . ' AND ' . localidadTableClass::getNameField(localidadTableClass::ID) . '= :id';
      $params = array(
         ':id' => $id
      );
//      echo $sql;
//      exit();
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer[0];
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getLocalidadById($id) {
    try {
      $sql = 'SELECT '
              . localidadTableClass::getNameField(localidadTableClass::NOMBRE) . '
              FROM '
              . localidadTableClass::getNameTable() . 
              ' WHERE ' . localidadTableClass::ID . ' = :id
              AND ' . localidadTableClass::DELETED_AT . ' IS NULL';
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
  
  public static function getCiudadesByIdDepto($id) {
    try {
      $sql = 'SELECT
"public".localizacion."id",
"public".localizacion.nombre as ciudad
FROM
"public".localizacion
WHERE
"public".localizacion.localizacion_id = :id AND
"public".localizacion.deleted_at IS NULL';
      $params = array(
         ':id' => $id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer === 0 ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
}
