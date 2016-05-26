<?php

use mvc\model\modelClass;
use mvc\config\configClass;
/**
 * Description of ambienteTableClass
 *
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class ambienteTableClass extends ambienteBaseTableClass {
    
    
    public static function getNombreById($id) {
        try {
            $sql = 'SELECT ' . ambienteTableClass::getNameField(ambienteTableClass::NOMBRE) . ' AS nombre'
                    . ' FROM ' . ambienteTableClass::getNameTable()
                    . ' WHERE ' . ambienteTableClass::getNameField(ambienteTableClass::ID) . ' = :id';

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
      $sql = 'SELECT COUNT(' . ambienteTableClass::getNameField(ambienteTableClass::ID) . ') AS cantidad'
              . ' FROM ' . ambienteTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . ambienteTableClass::getNameField(ambienteTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . ambienteTableClass::getNameField(ambienteTableClass::DELETED_AT) . ' IS NULL';
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
      // SELECT COUNT(id) AS cantidad FROM Ambiente where deleted_ad is null = contar todos los registros de una tabla
      $sql = 'SELECT COUNT(' . ambienteTableClass::getNameField(ambienteTableClass::ID) . ') AS cantidad'
              . ' FROM ' . ambienteTableClass::getNameTable()
              .' WHERE ' . ambienteTableClass::getNameField(ambienteTableClass::DELETED_AT) . ' IS NULL' ;
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid());
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
    public static function getAmbienteById($id) {
        try {
            $sql = 'SELECT '
                    . ambienteTableClass::getNameField(ambienteTableClass::ID) . ', '
                    . ambienteTableClass::getNameField(ambienteTableClass::NOMBRE) . ', '
                    . ambienteTableClass::getNameField(ambienteTableClass::OBSERVACION) . ', '
                    . ambienteTableClass::getNameField(ambienteTableClass::TIPO_AMBIENTE_ID) . ', '
                    . ambienteTableClass::getNameField(ambienteTableClass::DELETED_AT) . ' '
                    
                    . ' FROM ' . ambienteTableClass::getNameTable()
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
   
    public static function getTipoAmbienteById($id) {
        try {
            $sql = 'SELECT '
                    . ' amb.' . ambienteTableClass::ID . ', '
                    . ' amb.' . ambienteTableClass::NOMBRE . ', '
                    . ' amb.' . ambienteTableClass::OBSERVACION . ', '
                    . ' tipo.' . tipoAmbienteTableClass::NOMBRE . ' AS ' . ambienteTableClass::TIPO_AMBIENTE_ID
                    . ' FROM ' . ambienteTableClass::getNameTable() . ' as amb INNER JOIN ' . tipoAmbienteTableClass::getNameTable() . ' as tipo '
                    . ' ON amb.' .ambienteTableClass::TIPO_AMBIENTE_ID . ' = tipo.' . tipoAmbienteTableClass::ID. ' '
                    . ' WHERE amb.' . ambienteTableClass::ID. ' = :id';
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
    
    public static function getNumRamadas() {
    try {
      $sql = 'SELECT
"public".ambiente."id"
FROM
"public".ambiente
WHERE
"public".ambiente.tipo_ambiente_id = 1';
      $params = array(
          
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }   
  
   public static function getRamadas() {
    try {
      $sql = 'SELECT
"public".ambiente."id",
"public".ambiente.nombre
FROM
"public".ambiente
WHERE
"public".ambiente.tipo_ambiente_id = 1';
      $params = array(
          
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }   
    
         
}
