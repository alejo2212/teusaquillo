<?php

/**
 * Description of tipoDesinfeccionTableClass
 *
 * @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com>
 */
class tipoDesinfeccionTableClass extends tipoDesinfeccionBaseTableClass {

    public static function getDatotipo_desinfeccion($id) {
        try {
            $sql = 'SELECT' . tipo_desinfeccionTableClass::getNameField(tipo_desinfeccionTableClass::ID). ', ' . tipo_desinfeccionTableClass::getNameField(tipo_desinfeccionTableClass::NOMBRE). ', ' . tipo_desinfeccionTableClass::getNameField(tipo_desinfeccionTableClass::OBSERVACION).', ' . tipo_desinfeccionTableClass::getNameField(tipo_desinfeccionTableClass::DELETED_AT) . ' '
                    . 'FROM' . tipo_desinfeccionTableClass::getNameTable() . ' WHERE ' . tipo_desinfeccionTableClass::getNameField(tipo_desinfeccionTableClass::ID).' = :id ';
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
