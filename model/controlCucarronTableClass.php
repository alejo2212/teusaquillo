<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of controlCucarronTableClass
 *
 * @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com>
 */
class controlCucarronTableClass extends controlCucarronBaseTableClass {
    public static function getCountPages() {
    try {
      // SELECT COUNT(id) as cantidad FROM controlCucarron WHERE deleted_at is null = contar todos los registros de una tabla
      $sql = 'SELECT COUNT(' . controlCucarronTableClass::getNameField(controlCucarronTableClass::ID) . ') AS cantidad'
              . ' FROM ' . controlCucarronTableClass::getNameTable()
              . ' WHERE ' . controlCucarronTableClass::getNameField(controlCucarronTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . controlCucarronTableClass::getNameField(controlCucarronTableClass::ID) . ') AS cantidad'
              . ' FROM ' . controlCucarronTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . controlCucarronTableClass::getNameField(controlCucarronTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . controlCucarronTableClass::getNameField(controlCucarronTableClass::DELETED_AT) . ' IS NULL';
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

    public static function getControlCucarronById($id) {
        try {
            $sql = 'SELECT 
              cucar1.' . controlCucarronTableClass::ID . ',
              cucar1.' . controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR . ',
              cucar1.' . controlCucarronTableClass::EMPLEADO_ID_VETERINARIO . ',
              cucar1.' . controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE . ',
              cucar1.' . controlCucarronTableClass::FECHA_REALIZACION . ',
              cucar1.' . controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID . ',
              cucar1.' . controlCucarronTableClass::SOLUCION . ',
              cucar1.' . controlCucarronTableClass::FORMA_APLICACION_ID . ',
              cucar1.' . controlCucarronTableClass::AREA_TRATADA . ',
              cucar1.' . controlCucarronTableClass::OBSERVACION . ',
              cucar1.' . controlCucarronTableClass::DELETED_AT . '
              FROM ' . controlCucarronTableClass::getNameTable() . ' AS cucar1 INNER JOIN ' . empleadoTableClass::getNameTable() . ' AS emp1 ON cucar1.' . controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR . '=emp1.' . empleadoTableClass::ID . ', '
                    . controlCucarronTableClass::getNameTable() . ' AS cucar2 INNER JOIN ' . empleadoTableClass::getNameTable() . ' AS emp2 ON cucar2.' . controlCucarronTableClass::EMPLEADO_ID_VETERINARIO . '=emp2.' . empleadoTableClass::ID . ', '
                    . controlCucarronTableClass::getNameTable() . ' AS cucar3 INNER JOIN ' . empleadoTableClass::getNameTable() . ' AS emp3 ON cucar3.' . controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE . '=emp3.' . empleadoTableClass::ID . ', '
                    . controlCucarronTableClass::getNameTable() . ' AS cucar4 INNER JOIN ' . formaAplicacionTableClass::getNameTable() . ' AS forma_aplicacion ON cucar4.' . controlCucarronTableClass::FORMA_APLICACION_ID . '=forma_aplicacion.' . formaAplicacionTableClass::ID . '
            
              WHERE cucar1.' . controlCucarronTableClass::ID . ' = :id
                and cucar1=cucar2 
                and cucar1=cucar3
                and cucar1=cucar4 
                and cucar2=cucar1
                and cucar2=cucar3
                and cucar2=cucar4
                and cucar3=cucar1
                and cucar3=cucar2
                and cucar3=cucar4
                and cucar4=cucar1
                and cucar4=cucar2
                and cucar4=cucar3
              AND cucar1.' . controlCucarronTableClass::DELETED_AT . ' IS NULL';
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
