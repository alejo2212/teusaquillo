<?php

/**
 * Description of tipo_insumoTableClass
 *
 * @author jhon fernando hoyos <jhonfernandohoyosdiaz@gmail.com>
 */
class tipoInsumoTableClass extends tipoInsumoBaseTableClass {

    public static function getDatotipo_insumo($id) {
        
        try {
            $sql = 'SELECT'. tipoInsumoTableClass:: getNameField(tipoInsumoTableClass::ID). ', ' . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE). ', ' . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::OBSERVACION). ', ' . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DELETED_AT). ' '
            . 'FROM' . tipoInsumoTableClass::getNameTable() . 'WHERE' . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID).'= :id';
            $params = array(':id'=>$id);
            $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer;
        } catch (PDOException $exc) {
            throw $exc;
        }
            
    }

}
