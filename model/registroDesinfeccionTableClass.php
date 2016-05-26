<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of registroDesinfeccionTableClass
 *
 * @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com>
 */
class registroDesinfeccionTableClass extends registroDesinfeccionBaseTableClass {

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) as cantidad FROM registroDesinfeccion WHERE deleted_at is null = contar todos los registros de una tabla
      $sql = 'SELECT COUNT(' . registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::ID) . ') AS cantidad'
              . ' FROM ' . registroDesinfeccionTableClass::getNameTable()
              . ' WHERE ' . registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::ID) . ') AS cantidad'
              . ' FROM ' . registroDesinfeccionTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::DELETED_AT) . ' IS NULL';
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

  public static function getRegistroDesinfeccionById($id) {
    try {
      $sql = 'SELECT 
              desin1.' . registroDesinfeccionTableClass::ID . ',
              desin1.' . registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE . ' ,   
              desin1.' . registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR . ' ,
              desin1.' . registroDesinfeccionTableClass::FECHA_REALIZACION . ',
              desin1.' . registroDesinfeccionTableClass::FECHA_TERMINADO . ',
              desin1.' . registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID . ',
              desin1.' . registroDesinfeccionTableClass::SOLUCION . ',
              desin1.' . registroDesinfeccionTableClass::OBSERVACION . ',
              tipo_desinfeccion.' . tipoDesinfeccionTableClass::ID . ' as ' . registroDesinfeccionTableClass::TIPO_DESINFECCION_ID . ' ,
              desin1.' . registroDesinfeccionTableClass::OBSERVACION . ',
              desin1.' . registroDesinfeccionTableClass::CANT_PEDILUVIOS . ',
              desin1.' . registroDesinfeccionTableClass::DES_BODEGA . ',
              desin1.' . registroDesinfeccionTableClass::DES_PEDILUVIOS . ',
              desin1.' . registroDesinfeccionTableClass::DES_RAMDAS . ',
              desin1.' . registroDesinfeccionTableClass::DELETED_AT . '
              FROM ' . registroDesinfeccionTableClass::getNameTable() . ' AS desin1 INNER JOIN ' . empleadoTableClass::getNameTable() . ' AS emp1 ON desin1.' . registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE . '=emp1.' . empleadoTableClass::ID . ', '
              . registroDesinfeccionTableClass::getNameTable() . ' AS desin2 INNER JOIN ' . empleadoTableClass::getNameTable() . ' AS emp2 ON desin2.' . registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR . '=emp2.' . empleadoTableClass::ID . ', '
              . registroDesinfeccionTableClass::getNameTable() . ' AS desin3 INNER JOIN ' . tipoDesinfeccionTableClass::getNameTable() . ' AS tipo_desinfeccion ON desin3.' . registroDesinfeccionTableClass::TIPO_DESINFECCION_ID . '=tipo_desinfeccion.' . tipoDesinfeccionTableClass::ID . '
              
              WHERE desin1.' . registroDesinfeccionTableClass::ID . ' = :id
              AND desin1=desin2 
              AND desin1=desin3
              AND desin2=desin3
              AND desin3=desin2
              AND desin1.' . registroDesinfeccionTableClass::DELETED_AT . ' IS NULL';
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

}
