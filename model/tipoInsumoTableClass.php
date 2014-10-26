<?php

use mvc\model\modelClass;

/**
 * Description of tipo_insumoTableClass
 *
 * @author jhon fernando hoyos <jhonfernandohoyosdiaz@gmail.com>
 */
class tipoInsumoTableClass extends tipoInsumoBaseTableClass {

  public static function getTipoInsumoById($id) {
    try {
      $sql = 'SELECT '
              . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID) . ', '
              . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE) . ', '
              . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::OBSERVACION) . ', '
              . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DELETED_AT) . ' '
              . ' FROM ' . tipoInsumoTableClass::getNameTable()
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



