<?php

use mvc\model\modelClass;

/**
 * Description of tipoEmpaqueTableClass
 *
 * @author paola y scarpetta <paocas1794@hotmail.com>
 */
class tipoEmpaqueTableClass extends tipoEmpaqueBaseTableClass {

  public static function getDatotipoEmpaque($id) {
    try {
      //SELECT ID,NOMBRE,CANTIDAD,DESCRIPCION,DELETED_AT
      //FROM tipo_empaque
      //WHERE id=$id;

      $sql = 'SELECT' . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::ID) . ', ' . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::nombre) . ', ' . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::cantidad) . ', ' . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::descripcion) . ', ' . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::deleted_at)
              . 'FROM' . tipoEmpaqueTableClass::getDatotipo_empaque() . 'WHERE' . tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::id) . ' = :id';
      $params = array(':id' => $id);
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
