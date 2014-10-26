<?php

use mvc\model\modelClass;

/**
 * Description of tipo_insumoTableClass
 *
 * @author jhon fernando hoyos <jhonfernandohoyosdiaz@gmail.com>
 */
class presentacionTableClass extends presentacionBaseTableClass {

  public static function getPresentacionById($id) {
    try {
      $sql = 'SELECT '
              . presentacionTableClass::getNameField(presentacionTableClass::ID) . ', '
              . presentacionTableClass::getNameField(presentacionTableClass::NOMBRE) . ', '
              . presentacionTableClass::getNameField(presentacionTableClass::OBSERVACION) . ', '
              . presentacionTableClass::getNameField(presentacionTableClass::DELETED_AT) . ' '
              . ' FROM ' . presentacionTableClass::getNameTable()
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