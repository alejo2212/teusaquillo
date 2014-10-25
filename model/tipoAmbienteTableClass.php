<?php

use mvc\model\modelClass;

/**
 * Description of tipoAmbienteTableClass
 *
 * @author jhon fernando hoyos <jhonfernandohoyosdiaz@gmail.com>
 */
class tipoAmbienteTableClass extends tipoAmbienteBaseTableClass {

    public static function getTipoAmbienteById($id) {
        try {
            $sql = 'SELECT '
                    . tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::ID) . ', '
                    . tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::NOMBRE) . ', '
                    . tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::DESCRIPCION) . ', '
                    . tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::OBSERVACION) . ', '
                    . tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::DELETED_AT) . ' '
                    . ' FROM ' . tipoAmbienteTableClass::getNameTable()
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
