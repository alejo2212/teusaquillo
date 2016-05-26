<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of entradaBodegaTableClass
 *
 * @author jhon fernando hoyos <jhonfernandohoyosdiaz@gmail.com>
 */
class entradaBodegaTableClass extends entradaBodegaBaseTableClass {
    
    
     public static function getNombreById($id) {
        try {
            // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
            $sql = 'SELECT ' . entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID) . ' ,'
                    . ' FROM ' . entradaBodegaTableClass::getNameTable()
                    . ' WHERE ' . entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID) . ' = :id';
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
    
    public static function getCountPagesByWhere($where) {
    try {
      // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
      $sql = 'SELECT COUNT(' . entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID) . ') AS cantidad'
              . ' FROM ' . entradaBodegaTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . entradaBodegaTableClass::getNameField(entradaBodegaTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . entradaBodegaTableClass::getNameField(entradaBodegaTableClass::DELETED_AT) . ' IS NULL';
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

    public static function getCountPages() {
        try {
            // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
            $sql = 'SELECT COUNT(' . entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID) . ') AS cantidad'
                    . ' FROM ' . entradaBodegaTableClass::getNameTable()
                    . ' WHERE ' . entradaBodegaTableClass::getNameField(entradaBodegaTableClass::DELETED_AT) . ' IS NULL';
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return ceil($answer[0]->cantidad / configClass::getRowGrid()); // divide por el numero de grillas que definimos en config.php(2)
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    public static function getentradaBodegaById($id) {
        try {
            $sql = 'SELECT '
                    . ' bode1.' . entradaBodegaTableClass::ID . ', '
                    . ' bode1.' . entradaBodegaTableClass::EMPLEADO_ID . ', '
                    . ' bode1.' . entradaBodegaTableClass::TRANSPORTADOR_ID . ', '
                    . ' bode1.' . entradaBodegaTableClass::FECHA_ENTRADA . ', '
                    . ' bode1.' . entradaBodegaTableClass::REMISION . ', '
                    . ' bode1.' . entradaBodegaTableClass::OBSERVACION . ' '
                    . ' FROM ' . entradaBodegaTableClass::getNameTable() . ' AS bode1 INNER JOIN ' . empleadoTableClass::getNameTable()
                    . ' ON bode1.' . entradaBodegaTableClass::EMPLEADO_ID . ' = ' . empleadoTableClass::getNameField(empleadoTableClass::ID) . ', '
                    . entradaBodegaTableClass::getNameTable() . ' AS bode2 INNER JOIN ' . transportadorTableClass::getNameTable()
                    . ' ON bode2.' . entradaBodegaTableClass::TRANSPORTADOR_ID . ' = ' . transportadorTableClass::getNameField(transportadorTableClass::ID) . ' '
                    . ' WHERE bode1.' . entradaBodegaTableClass::ID . ' = :id'
                    . ' AND bode1=bode2 ';
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
    
    public static function getEntradaById($id) {
        try {
            $sql = 'SELECT
"public".empleado.nombre AS empleado,
"public".transportador.nombre AS conductor,
"public".entrada_bodega.fecha_entrada AS fecha,
"public".entrada_bodega.remision AS remision
FROM
"public".entrada_bodega
INNER JOIN "public".empleado ON "public".empleado."id" = "public".entrada_bodega.empleado_id
INNER JOIN "public".transportador ON "public".transportador."id" = "public".entrada_bodega.transportador_id
WHERE
"public".entrada_bodega."id" = :id';
            $params = array(':id' => $id);
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    public static function getIdandRemision($remision) {
        try {
            $sql = 'SELECT
"public".entrada_bodega."id",
"public".entrada_bodega.remision
FROM
"public".entrada_bodega
WHERE
"public".entrada_bodega.remision = :remision';
           // echo $sql;
            //exit();
            $params = array(':remision' => $remision);
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer[0]->id;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
     public static function getRemision($id) {
        try {
            $sql = 'SELECT
"public".entrada_bodega."id",
"public".entrada_bodega.remision
FROM
"public".entrada_bodega
WHERE
"public".entrada_bodega."id" = :id';
           // echo $sql;
            //exit();
            $params = array(':id' => $id);
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer[0]->remision;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    

}
