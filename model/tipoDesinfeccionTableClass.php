<?php

use mvc\model\modelClass;

/**
 * Description of tipoDesinfeccionTableClass
 *
 * @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com>
 */
class tipoDesinfeccionTableClass extends tipoDesinfeccionBaseTableClass {

  public static function getTipoDesinfeccionById($id) {
    try {
      $sql = 'SELECT '
              . tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionBaseTableClass::ID) . ', '
              . tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::NOMBRE) . ', '
              . tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::OBSERVACION) . ', '
              . tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::DELETED_AT) . ' '
              . ' FROM ' . tipoDesinfeccionTableClass::getNameTable()
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