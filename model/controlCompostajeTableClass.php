<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of controlCompostajeTableClass
 *
 * @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com>
 */
class controlCompostajeTableClass extends controlCompostajeBaseTableClass {
    public static function getCountPages() {
    try {
      // SELECT COUNT(id) as cantidad FROM controlCompostaje WHERE deleted_at is null = contar todos los registros de una tabla
      $sql = 'SELECT COUNT(' . controlCompostajeTableClass::getNameField(controlCompostajeTableClass::ID) . ') AS cantidad'
              . ' FROM ' . controlCompostajeTableClass::getNameTable()
              . ' WHERE ' . controlCompostajeTableClass::getNameField(controlCompostajeTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . controlCompostajeTableClass::getNameField(controlCompostajeTableClass::ID) . ') AS cantidad'
              . ' FROM ' . controlCompostajeTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . controlCompostajeTableClass::getNameField(controlCompostajeTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . controlCompostajeTableClass::getNameField(controlCompostajeTableClass::DELETED_AT) . ' IS NULL';
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

  public static function getControlCompostajeById($id) {
    try {
      $sql = 'SELECT 
              comp1.' . controlCompostajeTableClass::ID . ',
              comp1.' . controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR . ' ,
              comp1.' . controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO . ' ,
              comp1.' . controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE . ' ,
              comp1.' . controlCompostajeTableClass::FECHA_REALIZACION . ',
              comp1.' . controlCompostajeTableClass::CAJON_COMPOSTAJE_ID.' ,
              comp1.' . controlCompostajeTableClass::GALLINAZA_UTILIZADA . ',
              comp1.' . controlCompostajeTableClass::CANTIDAD_TOTAL_AVES . ',
              comp1.' . controlCompostajeTableClass::CANTIDAD_MACHOS . ',
              comp1.' . controlCompostajeTableClass::CANTIDAD_HEMBRAS . ',
              comp1.' . controlCompostajeTableClass::SALIDA_LOTE_ID.' ,
              comp1.' . controlCompostajeTableClass::OBSERVACION . ',
              comp1.' . controlCompostajeTableClass::DELETED_AT . '
              FROM ' . controlCompostajeTableClass::getNameTable() . ' AS comp1 INNER JOIN ' . empleadoTableClass::getNameTable() . ' AS emp1 ON comp1.' . controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR . '=emp1.' . empleadoTableClass::ID . ', '
              . controlCompostajeTableClass::getNameTable() . ' AS comp2 INNER JOIN ' . empleadoTableClass::getNameTable() . ' AS emp2 ON comp2.' . controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO . '=emp2.' . empleadoTableClass::ID . ', '
              . controlCompostajeTableClass::getNameTable() . ' AS comp3 INNER JOIN ' . empleadoTableClass::getNameTable() . ' AS emp3 ON comp3.' . controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE . '=emp3.' . empleadoTableClass::ID . ', '
              . controlCompostajeTableClass::getNameTable() . ' AS comp4 INNER JOIN ' . cajonCompostajeTableClass::getNameTable() . ' AS cajon ON comp4.' . controlCompostajeTableClass::CAJON_COMPOSTAJE_ID . '=cajon.' . cajonCompostajeTableClass::ID . ', '
              . controlCompostajeTableClass::getNameTable() . ' AS comp5 INNER JOIN ' . salidaLoteTableClass::getNameTable() . ' AS lote ON comp5.' . controlCompostajeTableClass::SALIDA_LOTE_ID . '=lote.' . salidaLoteTableClass::ID . ' 
              WHERE comp1.' . controlCompostajeTableClass::ID . ' = :id
              AND comp1=comp2 
              AND comp1=comp3 
              AND comp2=comp3 
              AND comp5=comp1
              AND comp5=comp2
              AND comp5=comp3
              AND comp4=comp1
              AND comp4=comp2
              AND comp4=comp3
              AND comp4=comp5
              AND comp1.' . controlCompostajeTableClass::DELETED_AT . ' IS NULL';
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
