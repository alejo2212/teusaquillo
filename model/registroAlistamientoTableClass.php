<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of registroAlistamientoTableClass
 *
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class registroAlistamientoTableClass extends registroAlistamientoBaseTableClass {

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM empleado
      $sql = 'SELECT COUNT(' . registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . registroAlistamientoTableClass::getNameTable()
              . ' WHERE ' . registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . registroAlistamientoTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::DELETED_AT) . ' IS NULL';
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

  public static function getRegistroAlistamiento($id) {
    try {
      $sql = 'SELECT 
              alis1.'.registroAlistamientoTableClass::ID . ',
              alis1.'.registroAlistamientoTableClass::EMPLEADO_ID . ',
              alis1.'.registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID . ',
              alis1.'.registroAlistamientoTableClass::FECHA_INICIO . ',
              alis1.'.registroAlistamientoTableClass::FECHA_FIN . ',
              alis1.'.registroAlistamientoTableClass::LOTE_ID . ',
              alis1.'.registroAlistamientoTableClass::FECHA_INICIO_CORTINA . ',
              alis1.'.registroAlistamientoTableClass::FECHA_FIN_CORTINA . ',
              alis1.'.registroAlistamientoTableClass::FECHA_ENTRADA_CAMA . ',
              alis1.'.registroAlistamientoTableClass::FECHA_TERMINO_CAMA. ',
              alis1.'.registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO . '
              FROM '
              . registroAlistamientoTableClass::getNameTable() . ' AS alis1 INNER JOIN ' . loteTableClass::getNameTable() . ' ON alis1.' . registroAlistamientoTableClass::LOTE_ID . '=' . loteTableClass::getNameField(loteTableClass::ID) . ', '
              . registroAlistamientoTableClass::getNameTable() . ' AS alis2 INNER JOIN ' . empleadoTableClass::getNameTable() . ' ON alis2.' . registroAlistamientoTableClass::EMPLEADO_ID . '=' . empleadoTableClass::getNameField(empleadoTableClass::ID) . ', '
              . registroAlistamientoTableClass::getNameTable() . ' AS alis3 INNER JOIN ' . salidaInsumoDetalleTableClass::getNameTable() . ' ON alis3.' . registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID . '=' . salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::ID) .
              ' WHERE alis1.' . registroAlistamientoTableClass::ID . ' = :id
              AND alis1=alis2 
              AND alis1=alis3 
              AND alis2=alis3
              AND alis1.' . registroAlistamientoTableClass::DELETED_AT . ' IS NULL';
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
