<?php

use mvc\model\modelClass;

/**
 * Description of requisicionTableClass
 *
 * @author Jhonny Alejandro <jhonny2212@hotmail.com>
 */
class cargoTableClass extends cargoBaseTableClass {

  public static function getCargo($id) {
    try {
      $sql = 'SELECT ' . cargoTableClass::getNameField(cargoTableClass::ID) . ', ' . cargoTableClass::getNameField(cargoTableClass::NOMBRE) . ', ' . cargoTableClass::getNameField(cargoTableClass::DESCRIPCION) . ' '
              . 'FROM ' . cargoTableClass::getNameTable() . ' '
              . 'WHERE ' . cargoTableClass::getNameField(cargoTableClass::ID) . ' = :id '
              . 'AND ' . cargoTableClass::getNameField(cargoTableClass::DELETED_AT) . ' IS NULL';
      $params = array(
        ':id' => $id
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
