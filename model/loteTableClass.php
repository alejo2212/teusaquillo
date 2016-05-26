<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of loteTableClass
 *
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class loteTableClass extends loteBaseTableClass {

    public static function getCountPages() {
        try {
            // SELECT COUNT(id) AS cantidad FROM lote where deleted_ad is null = contar todos los registros de una tabla
            $sql = 'SELECT COUNT(' . loteTableClass::getNameField(loteTableClass::ID) . ') AS cantidad'
                    . ' FROM ' . loteTableClass::getNameTable()
                    . ' WHERE ' . loteTableClass::getNameField(loteTableClass::DELETED_AT) . ' IS NULL';
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return ceil($answer[0]->cantidad / configClass::getRowGrid());
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    public static function getCountPagesByWhere($where) {
    try {
      // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
      $sql = 'SELECT COUNT(' . loteTableClass::getNameField(loteTableClass::ID) . ') AS cantidad'
              . ' FROM ' . loteTableClass::getNameTable();
      $flag = false;
      if (is_array($where) === true and $where != NULL) {
        foreach ($where as $field => $value) {
          if ($flag === false) {
            $sql = $sql . ' WHERE ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
            $flag = true;
          } else {
            $sql = $sql . ' AND ' . $field . ' = ' . ((is_numeric($value)) ? $value : "'$value'") . ' ';
          }
        }
        $sql = $sql . ' AND ' . loteTableClass::getNameField(loteTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . loteTableClass::getNameField(loteTableClass::DELETED_AT) . ' IS NULL';
      }
//      echo $sql;
//      exit();
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid()); // divide por el numero de grillas que definimos en config.php(2)
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

    public static function getLoteById($id) {
        try {
            $sql = 'SELECT '
                    . ' lote1.' . loteTableClass::ID . ', '
                    . ' lote1.' . loteTableClass::LOTE . ', '
                    . ' lote1.' . loteTableClass::FECHA_ENTRADA_GRANJA . ', '
                    . ' lote1.' . loteTableClass::FECHA_SALIDA_ESTIPULADA . ', '
                    . ' lote1.' . loteTableClass::FECHA_SALIDA_REAL . ', '
                    . ' lote1.' . loteTableClass::RAZA_ID . ', '
                    . ' lote1.' . loteTableClass::PESO_PROMEDIO_MACHOS . ', '
                    . ' lote1.' . loteTableClass::PESO_PROMEDIO_HEMBRAS . ', '
                    . ' lote1.' . loteTableClass::CANTIDAD_HEMBRAS . ', '
                    . ' lote1.' . loteTableClass::CANTIDAD_MACHOS . ', '
                    . ' lote1.' . loteTableClass::CANTIDAD_HEMBRAS . ', '
                    . ' lote1.' . loteTableClass::CANTIDAD_TOTAL . ', '
                    . ' lote1.' . loteTableClass::FECHA_ENTRA_PRODUCCION . ', '
                    . ' lote1.' . loteTableClass::OBSERVACION . ', '
                    . ' lote1.' . loteTableClass::EMPLEADO_ID . ' '
                    . ' FROM '
                    . loteTableClass::getNameTable() . ' as lote1 INNER JOIN ' . razaTableClass::getNameTable() . ' as raza ON lote1.' . loteTableClass::RAZA_ID . ' = raza.' . razaTableClass::ID . ', '
                    . loteTableClass::getNameTable() . ' as lote2 INNER JOIN ' . empleadoTableClass::getNameTable() . ' as empleado ON lote2.' . loteTableClass::EMPLEADO_ID . '= empleado.' . empleadoTableClass::ID . ' '
                    . ' WHERE lote1.' . loteTableClass::ID . ' = :id'
                    . ' AND lote1=lote2';
//            echo $sql;
//            exit();
            $params = array(':id' => $id);
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer[0];
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    public static function getLote($id) {
        try {
            $sql = 'SELECT '
                    . loteTableClass::getNameField(loteTableClass::LOTE) . '
              FROM '
                    . loteTableClass::getNameTable() .
                    ' WHERE ' . loteTableClass::ID . ' = :id
              AND ' . loteTableClass::DELETED_AT . ' IS NULL';
            //echo $sql;
            //exit();
            $params = array(
                ':id' => $id
            );
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);

            return (count($answer) === 0) ? false : $answer[0]->lote;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    public static function getNombreById($id) {
        try {
            // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
            $sql = 'SELECT ' . loteTableClass::getNameField(loteTableClass::LOTE) . ' AS nombre'
                    . ' FROM ' . loteTableClass::getNameTable()
                    . ' WHERE ' . loteTableClass::getNameField(loteTableClass::ID) . ' = :id';
            $params = array(
                ':id' => $id
            );
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return $answer[0]->nombre;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    public static function getCantMachosCantHembras($lote) {
        try {
            $sql = 'SELECT
"public".lote.cantidad_hembras AS hembras,
"public".lote.cantidad_machos AS machos
FROM
"public".lote
WHERE
"public".lote.lote = :lote
AND '. loteTableClass::getNameField(loteTableClass::DELETED_AT) . ' IS NULL';
//            echo $sql;
//            exit();
            $params = array(':lote' => $lote);
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

}
