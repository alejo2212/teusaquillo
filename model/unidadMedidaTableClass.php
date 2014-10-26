<?php

use mvc\model\modelClass;

/**
 * Description of tipo_insumoTableClass
 *
 * @author jhon fernando hoyos <jhonfernandohoyosdiaz@gmail.com>
 */
class unidadMedidaTableClass extends unidadMedidaBaseTableClass {

  public static function getUnidadMedidaById($id) {
    try {
      $sql = 'SELECT '
              . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::ID) . ', '
              . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::NOMBRE) . ', '
              . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::SIGLA) . ', '
              . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::OBSERVACION) . ', '
              . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::DELETED_AT) . ' '
              . ' FROM ' . unidadMedidaTableClass::getNameTable()
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



