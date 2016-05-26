<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of cajonCompostajeTableClass
 *
 * @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com>
 */
class cajonCompostajeTableClass extends cajonCompostajeBaseTableClass {
    
    public static function getNombreById($id) {
        try {
            // SELECT COUNT(id) as cantidad FROM insumo= contar todos los registros de una tabla
            $sql = 'SELECT ' . cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::OBSERVACION) . ' AS nom '
                    . ' FROM ' . cajonCompostajeTableClass::getNameTable()
                    . ' WHERE ' . cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::ID) . ' = :id';
            $params = array(
                ':id' => $id
            );
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->nom;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    public static function getCountPagesByWhere($where) {
    try {
      // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
      $sql = 'SELECT COUNT(' . cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::ID) . ') AS cantidad'
              . ' FROM ' . cajonCompostajeTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::DELETED_AT) . ' IS NULL';
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
      // SELECT COUNT(id) as cantidad FROM cajonCompostaje WHERE deleted_at is null = contar todos los registros de una tabla
      $sql = 'SELECT COUNT(' . cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::ID) . ') AS cantidad'
              . ' FROM ' . cajonCompostajeTableClass::getNameTable()
              . ' WHERE ' . cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::DELETED_AT) . ' IS NULL';
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid());
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
    
     public static function getCajonCompostajeById($id) {
    try {
      $sql = 'SELECT '
              . cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::ID) . ', '
              . cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::NUMERO) . ', '
              . cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::OBSERVACION) . ', '
              . cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::DELETED_AT) . ' '
              . ' FROM ' . cajonCompostajeTableClass::getNameTable()
              . ' WHERE ' . cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::ID) . '= :id';
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
