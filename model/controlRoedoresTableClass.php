<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of controlRoedoresTableClass
 *
 * @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com>
 */
class controlRoedoresTableClass extends controlRoedoresBaseTableClass {

    public static function getCountPages() {
        try {
            // SELECT COUNT(id) as cantidad FROM controlRoeodres WHERE deleted_at is null = contar todos los registros de una tabla
            $sql = 'SELECT COUNT(' . controlRoedoresTableClass::getNameField(controlRoedoresTableClass::ID) . ') AS cantidad'
                    . ' FROM ' . controlRoedoresTableClass::getNameTable()
                    . ' WHERE ' . controlRoedoresTableClass::getNameField(controlRoedoresTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . controlRoedoresTableClass::getNameField(controlRoedoresTableClass::ID) . ') AS cantidad'
              . ' FROM ' . controlRoedoresTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . controlRoedoresTableClass::getNameField(controlRoedoresTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . controlRoedoresTableClass::getNameField(controlRoedoresTableClass::DELETED_AT) . ' IS NULL';
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

    public static function getControlRoedoresById($id) {
        try {
            $sql = 'SELECT 
              roe1.' . controlRoedoresTableClass::ID . ',
              roe1.' . controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR . ' ,
              roe1.' . controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO . ' ,
              roe1.' . controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE . ' ,
              roe1.' . controlRoedoresTableClass::FECHA_REALIZACION . ',
              roe1.' . controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID . ',
              roe1.' . controlRoedoresTableClass::PELLETS . ',
              roe1.' . controlRoedoresTableClass::BLOQUES . ',
              roe1.' . controlRoedoresTableClass::EVIDENCIA_CONSUMO . ',
              roe1.' . controlRoedoresTableClass::LUGAR . ',
              roe1.' . controlRoedoresTableClass::OBSERVACION . ',
              roe1.' . controlRoedoresTableClass::DELETED_AT . '
              FROM ' . controlRoedoresTableClass::getNameTable() . ' AS roe1 INNER JOIN ' . empleadoTableClass::getNameTable() . ' AS emp1 ON roe1.' . controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR . '=emp1.' . empleadoTableClass::ID . ', '
                    . controlRoedoresTableClass::getNameTable() . ' AS roe2 INNER JOIN ' . empleadoTableClass::getNameTable() . ' AS emp2 ON roe2.' . controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO . '=emp2.' . empleadoTableClass::ID . ', '
                    . controlRoedoresTableClass::getNameTable() . ' AS roe3 INNER JOIN ' . empleadoTableClass::getNameTable() . ' AS emp3 ON roe3.' . controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE . '=emp3.' . empleadoTableClass::ID . '
                    
              WHERE roe1.' . controlRoedoresTableClass::ID . ' = :id
                    and roe1=roe2 
                    and roe1=roe3
                    and roe2=roe3
                    and roe3=roe2
              AND roe1.' . controlRoedoresTableClass::DELETED_AT . ' IS NULL';
            //echo $sql;
            //exit();
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

}
