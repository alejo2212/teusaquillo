<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of tipoAmbienteTableClass
 *
 * @author Aleyda mina <aleminac@gmail.com>
 */
class tipoAmbienteTableClass extends tipoAmbienteBaseTableClass {

    public static function getNombreById($id) {
        try {
            $sql = 'SELECT ' . tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::NOMBRE) . ' AS nombre'
                    . ' FROM ' . tipoAmbienteTableClass::getNameTable()
                    . ' WHERE ' . tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::ID) . ' = :id';

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
      $sql = 'SELECT COUNT(' . tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::ID) . ') AS cantidad'
              . ' FROM ' . tipoAmbienteTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::DELETED_AT) . ' IS NULL';
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
            // SELECT COUNT(id) AS cantidad FROM tipoAmbiente where deleted_ad is null = contar todos los registros de una tabla
            $sql = 'SELECT COUNT(' . tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::ID) . ') AS cantidad'
                    . ' FROM ' . tipoAmbienteTableClass::getNameTable()
                    . ' WHERE ' . tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::DELETED_AT) . ' IS NULL';
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return ceil($answer[0]->cantidad / configClass::getRowGrid());
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    public static function getTipoAmbienteById($id) {
        try {
            $sql = 'SELECT '
                    . tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::ID) . ', '
                    . tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::NOMBRE) . ', '
                    . tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::DESCRIPCION) . ', '
                    . tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::OBSERVACION) . ', '
                    . tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::DELETED_AT) . ' '
                    . ' FROM ' . tipoAmbienteTableClass::getNameTable()
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

}
