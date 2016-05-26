<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of sesionClass
 *
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class razaTableClass extends razaBaseTableClass {

  public static function getNombreById($id) {
    try {
      $sql = 'SELECT ' . razaTableClass::getNameField(razaTableClass::NOMBRE) . ' AS nombre'
              . ' FROM ' . razaTableClass::getNameTable()
              . ' WHERE ' . razaTableClass::getNameField(razaTableClass::ID) . ' = :id';

      $params = array(':id' => $id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->nombre;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getCountPagesByWhere($where) {
    try {
      // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
      $sql = 'SELECT COUNT(' . razaTableClass::getNameField(razaTableClass::ID) . ') AS cantidad'
              . ' FROM ' . razaTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . razaTableClass::getNameField(razaTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . razaTableClass::getNameField(razaTableClass::DELETED_AT) . ' IS NULL';
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

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) AS cantidad FROM raza where deleted_ad is null = contar todos los registros de una tabla
      $sql = 'SELECT COUNT(' . razaTableClass::getNameField(razaTableClass::ID) . ') AS cantidad'
              . ' FROM ' . razaTableClass::getNameTable()
              . ' WHERE ' . razaTableClass::getNameField(razaTableClass::DELETED_AT) . ' IS NULL';
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid());
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getRazaById($id) {
    try {
      $sql = 'SELECT '
              . razaTableClass::getNameField(razaTableClass::ID) . ', '
              . razaTableClass::getNameField(razaTableClass::NOMBRE) . ', '
              . razaTableClass::getNameField(razaTableClass::DESCRIPCION) . ', '
              . razaTableClass::getNameField(razaTableClass::FOTO) . ', '
              . razaTableClass::getNameField(razaTableClass::DELETED_AT) . ' '
              . ' FROM ' . razaTableClass::getNameTable()
              . ' WHERE id = :id';
      $params = array(':id' => $id);
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer[0];
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getNombreRazaByIdLote($id) {
    try {
      $sql = 'SELECT
"public".raza.nombre as nombre
FROM
"public".lote
INNER JOIN "public".raza ON "public".lote.raza_id = "public".raza."id"
WHERE
"public".lote."id" = :id AND
"public".lote.deleted_at IS NULL AND
"public".raza.deleted_at IS NULL';
      $params = array(':id' => $id);
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer[0]->nombre;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
