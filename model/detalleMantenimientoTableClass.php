<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of detalleMantenimientoTableClass
 *
 * @author liliana carolina moreno <lilianacarol6@hotmail.com>
 */
class detalleMantenimientoTableClass extends detalleMantenimientoBaseTableClass {

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM empleado
      $sql = 'SELECT COUNT(' . detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . detalleMantenimientoTableClass::getNameTable()
              . ' WHERE ' . detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::DELETED_AT) . ' IS NULL';
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid());
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getDetalleMante($id) {
    try {
      $sql = 'SELECT 
              ' . detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::ID) . ',
              ' . detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::MANTENIMIENTO_ID) . ',
              ' . detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::DESCRIPCION) . ',
              ' . detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::VALOR) . ',
              ' . detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::OBSERVACION) . ' 
              FROM '
              . detalleMantenimientoTableClass::getNameTable() .
              ' WHERE ' . detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::ID) . ' = :id
              AND ' . detalleMantenimientoTableClass::getNameField(detalleMantenimientoTableClass::DELETED_AT) . ' IS NULL';
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
