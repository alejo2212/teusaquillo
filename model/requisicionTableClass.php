<?php

use mvc\model\modelClass;

/**
 * Description of requisicionTableClass
 *
 * @author Jhonny Alejandro <jhonny2212@hotmail.com>
 */
class requisicionTableClass extends requisicionBaseTableClass {

  public static function getDataRequisicion($id) {
    try {
      $sql = 'SELECT ' . requisicionTableClass::getNameField(requisicionTableClass::ID) . ', ' . requisicionTableClass::getNameField(requisicionTableClass::EMPLEADO_ID) . ', ' . requisicionTableClass::getNameField(requisicionTableClass::FECHA_REALIZACION) . ', ' . requisicionTableClass::getNameField(requisicionTableClass::ANULADO) . ', ' . control_alimentoTableClass::getNameField(control_alimentoTableClass::DELETED_AT) . ' '
              . 'FROM ' . requisicionTableClass::getNameTable() . ' '
              . 'WHERE ' . requisicionTableClass::getNameField(requisicionTableClass::ID) . ' = :id ';
      $params = array(
        'id' => $id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
}
