<?php

use mvc\model\modelClass;

/**
 * Description of control_alimentoTableClass
 *
 * @author Jhonny Alejandro <jhonny2212@hotmail.com>
 */
class controlAlimentoTableClass extends controlAlimentoBaseTableClass {

  public static function getDataControlAlimento($id) {
    try {
      $sql = 'SELECT ' . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID) . ', ' . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::AMBIENTE_HISTORIAL_LOTE_ID) . ', ' . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SALIDA_INSUMO_DETALLE_ID) . ', ' . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID_EMPLEADO) . ', ' . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEXO) . ', ' . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::CANTIDAD) . ', ' . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA) . ', ' . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEMANA) . ', ' . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::OBSERVACION) . ', ' . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::DELETED_AT) . ' '
              . 'FROM ' . controlAlimentoTableClass::getNameTable() . ' '
              . 'WHERE ' . controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID) . ' = :id ';
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
