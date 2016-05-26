<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of ambienteHistorialLoteTableClass
 *
 * @author jhon fernando hoyos <jhonfernandohoyosdiaz@gmail.com>
 */
class ambienteHistorialLoteTableClass extends ambienteHistorialLoteBaseTableClass {

  public static function getNombreById($id) {
    try {

      $sql = 'SELECT ' . ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::ID) . ' ,'
              . ' FROM ' . ambienteHistorialLoteTableClass::getNameTable()
              . ' WHERE ' . ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::ID) . ' = :id';
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

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
      $sql = 'SELECT COUNT(' . ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::ID) . ') AS cantidad'
              . ' FROM ' . ambienteHistorialLoteTableClass::getNameTable()
              . ' WHERE ' . ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::DELETED_AT) . ' IS NULL';
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid()); // divide por el numero de grillas que definimos en config.php(2)
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getCountPagesByWhere($where) {
    try {
      // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
      $sql = 'SELECT COUNT(' . ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::ID) . ') AS cantidad'
              . ' FROM ' . ambienteHistorialLoteTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::DELETED_AT) . ' IS NULL';
      }
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid()); // divide por el numero de grillas que definimos en config.php(2)
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getambienteHistorialLoteById($id) {
    try {
      $sql = 'SELECT '
              . ' ambhl1.' . ambienteHistorialLoteTableClass::ID . ', '
              . ' ambhl1.' . ambienteHistorialLoteTableClass::AMBIENTE_ID . ', '
              . ' ambhl1.' . ambienteHistorialLoteTableClass::LOTE_ID . ', '
              . ' ambhl1.' . ambienteHistorialLoteTableClass::NO_CASETA . ', '
              . ' ambhl1.' . ambienteHistorialLoteTableClass::CANTIDAD_HEMBRAS . ', '
              . ' ambhl1.' . ambienteHistorialLoteTableClass::CANTIDAD_MACHOS . ' '
              . ' FROM ' . ambienteHistorialLoteTableClass::getNameTable() . ' AS ambhl1 INNER JOIN ' . ambienteTableClass::getNameTable()
              . ' ON ambhl1.' . ambienteHistorialLoteTableClass::AMBIENTE_ID . ' = ' . ambienteTableClass::getNameField(ambienteTableClass::ID) . ', '
              . ambienteHistorialLoteTableClass::getNameTable() . ' AS ambhl2 INNER JOIN ' . loteTableClass::getNameTable()
              . ' ON ambhl2.' . ambienteHistorialLoteTableClass::LOTE_ID . ' = ' . loteTableClass::getNameField(loteTableClass::ID) . ' '
              . ' WHERE ambhl1.' . ambienteHistorialLoteTableClass::ID . ' = :id'
              . ' AND ambhl1=ambhl2 ';
      // echo $sql;
      //exit();
      $params = array(':id' => $id);
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer[0];
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getAmbienteHistLote() {
    try {
      $sql = 'SELECT
                    "public".ambiente_historial_lote."id",
                    "public".ambiente.nombre,
                    "public".lote.lote,
                    "public".ambiente_historial_lote.no_caseta
                    FROM
                    "public".ambiente_historial_lote
                    INNER JOIN "public".ambiente ON "public".ambiente_historial_lote.ambiente_id = "public".ambiente."id"
                    INNER JOIN "public".lote ON "public".ambiente_historial_lote.lote_id = "public".lote."id"
                    WHERE ' . ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::DELETED_AT) . ' IS NULL
                    ORDER BY
                    "public".lote.lote DESC, "public".ambiente.nombre DESC';

//      echo $sql;
//      exit();
      $params = array();
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return (count($answer) === 0) ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getAmbienteHistLoteById($id) {
    try {
      $sql = 'SELECT
                    "public".ambiente_historial_lote."id",
                    "public".ambiente.nombre,
                    "public".lote.lote,
                    "public".ambiente_historial_lote.no_caseta
                    FROM
                    "public".ambiente_historial_lote
                    INNER JOIN "public".ambiente ON "public".ambiente_historial_lote.ambiente_id = "public".ambiente."id"
                    INNER JOIN "public".lote ON "public".ambiente_historial_lote.lote_id = "public".lote."id"
                    WHERE "public".ambiente_historial_lote."id" = :id 
                    AND ' . ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::DELETED_AT) . ' IS NULL
                    ORDER BY
                    "public".ambiente.nombre ASC, "public".lote.lote ASC, "public".ambiente_historial_lote.no_caseta ASC';

//      echo $sql;
//      exit();
      $params = array(':id' => $id);
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return (count($answer) === 0) ? false : $answer[0];
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getSumHSumM($lote) {
    try {
      $sql = 'SELECT
Sum("public".ambiente_historial_lote.cantidad_hembras) AS hembras,
Sum("public".ambiente_historial_lote.cantidad_machos) AS machos
FROM
"public".ambiente_historial_lote
INNER JOIN "public".lote ON "public".ambiente_historial_lote.lote_id = "public".lote."id"
WHERE
"public".lote.lote = :lote
AND ' . ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::DELETED_AT) . ' IS NULL';

//      echo $sql;
//      exit();
      $params = array(':lote' => $lote);
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return (count($answer) === 0) ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getHemrasMahosById($id) {
    try {
      $sql = 'SELECT
"public".ambiente_historial_lote.cantidad_hembras AS hembras,
"public".ambiente_historial_lote.cantidad_machos AS machos
FROM
"public".ambiente_historial_lote
WHERE
"public".ambiente_historial_lote."id" = :id
AND ' . ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::DELETED_AT) . ' IS NULL';

//      echo $sql;
//      exit();
      $params = array(
          ':id' => $id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return (count($answer) === 0) ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function updateAmbienteHistorialLoteById($ambhislote, $hembras, $machos) {
    try {
      $sql = 'UPDATE ambiente_historial_lote
   SET cantidad_hembras= :hembras, cantidad_machos= :machos
 WHERE ambiente_historial_lote.id= :ambiid 
 AND ' . ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::DELETED_AT) . ' IS NULL';

//      echo $sql;
//      exit();
      $params = array(
          ':ambiid' => $ambhislote,
          ':hembras' => $hembras,
          ':machos' => $machos
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//
//            return (count($answer) === 0) ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getAhlById($id) {
    try {

      $sql = 'SELECT
"public".salida_lote.ambiente_historial_lote_id AS ahl
FROM
"public".salida_lote
WHERE
"public".salida_lote."id" = :id';
      $params = array(
          ':id' => $id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return $answer[0]->ahl;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
