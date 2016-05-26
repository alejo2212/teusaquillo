<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of salidaDetalleIncubadoraTableClass
 *
 * @author Jhonny Alejandro <jhonny2212@hotmail.com>
 */
class salidaDetalleIncubadoraTableClass extends salidaDetalleIncubadoraBaseTableClass {

    public static function getCountPages($id) {
        try {
            // SELECT COUNT(id) FROM requisiciondetalle
            $sql = 'SELECT COUNT(' . salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::ID) . ') AS cantidad'
                    . ' FROM ' . salidaDetalleIncubadoraTableClass::getNameTable()
                    . ' WHERE ' . salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::DELETED_AT) . ' IS NULL'
                    . ' AND ' . salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::SALIDA_INCUBADORA_ID) . ' = :id';
            $params = array(
                ':id' => $id
            );
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return ceil($answer[0]->cantidad / configClass::getRowGrid());
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    public static function getDetalleIncubadora($id) {
        try {
            $sql = 'SELECT 
              ' . salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::ID) . ',
              ' . salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::SALIDA_INCUBADORA_ID) . ',
              ' . salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::INCUBADORA_ID) . ',
              ' . salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::TIPO_EMPAQUE_ID) . ',
              ' . salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::CANTIDAD) . ',
              ' . salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::DESCRIPCION) . ',
              ' . salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::CANTIDAD_EMPAQUE) . '
              FROM ' . salidaDetalleIncubadoraTableClass::getNameTable() . '
              WHERE ' . salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::ID) . ' = :id 
              AND ' . salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::DELETED_AT) . ' IS NULL';
            $params = array(
                ':id' => $id
            );
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer[0];
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    public static function getDetalleByIdSalidaIncubadora($id) {
        try {
            $sql = 'SELECT
"public".salida_detalle_incubadora.cantidad,
"public".salida_detalle_incubadora.descripcion,
"public".tipo_empaque.nombre AS "empaque",
"public".salida_detalle_incubadora.cantidad_empaque
FROM
"public".salida_detalle_incubadora
INNER JOIN "public".tipo_empaque ON "public".tipo_empaque."id" = "public".salida_detalle_incubadora.tipo_empaque_id
WHERE
"public".salida_detalle_incubadora.salida_incubadora_id = :id';
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
