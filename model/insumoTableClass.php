<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of insumoTableClass
 *
 * @author jhon fernando hoyos <jhonfernandohoyosdiaz@gmail.com>
 */
class insumoTableClass extends insumoBaseTableClass {
    
    
     public static function getNombreById($id) {
        try {
            // SELECT COUNT(id) FROM cargo = esto es igual a contar todos los registros de una tabla los trae en con un array posicion 0
            $sql = 'SELECT ' . insumoTableClass::getNameField(insumoTableClass::NOMBRE) . ' AS nombre'
                    . ' FROM ' . insumoTableClass::getNameTable()
                    . ' WHERE ' . insumoTableClass::getNameField(insumoTableClass::ID) . ' = :id';
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
      $sql = 'SELECT COUNT(' . insumoTableClass::getNameField(insumoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . insumoTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . insumoTableClass::getNameField(insumoTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . insumoTableClass::getNameField(insumoTableClass::DELETED_AT) . ' IS NULL';
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
            $sql = 'SELECT COUNT(' . insumoTableClass::getNameField(insumoTableClass::ID) . ') AS cantidad'
                    . ' FROM ' . insumoTableClass::getNameTable()
                    . ' WHERE ' . insumoTableClass::getNameField(insumoTableClass::DELETED_AT) . ' IS NULL';
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute();
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return ceil($answer[0]->cantidad / configClass::getRowGrid()); // divide por el numero de grillas que definimos en config.php(2)
        } catch (PDOException $exc) {
            throw $exc;
        }
    }

    public static function getInsumoById($id) {
        try {
            $sql = 'SELECT '
                    . ' insu1.' . insumoTableClass::ID . ', '
                    . ' insu1.' . insumoTableClass::ACTIVO . ', '
                    . ' insu1.' . insumoTableClass::NOMBRE . ', '
                    . ' insu1.' . insumoTableClass::TIPO_INSUMO_ID . ', '
                    . ' insu1.' . insumoTableClass::PRESENTACION_ID . ', '
                    . ' insu1.' . insumoTableClass::UNIDAD_MEDIDA_ID . ', '
                    . ' insu1.' . insumoTableClass::INVENTARIO_BODEGA . ' '
                    . ' FROM ' . insumoTableClass::getNameTable() . ' AS insu1 INNER JOIN ' . tipoInsumoTableClass::getNameTable()
                    . ' ON insu1.' . insumoTableClass::TIPO_INSUMO_ID . ' = ' . tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID) . ', '
                    . insumoTableClass::getNameTable() . ' AS insu2 INNER JOIN ' . presentacionTableClass::getNameTable()
                    . ' ON insu2.' . insumoTableClass::PRESENTACION_ID . ' = ' . presentacionTableClass::getNameField(presentacionTableClass::ID) . ', '
                    . insumoTableClass::getNameTable() . ' AS insu3 INNER JOIN ' . unidadMedidaTableClass::getNameTable()
                    . ' ON insu3.' . insumoTableClass::UNIDAD_MEDIDA_ID . ' = ' . unidadMedidaTableClass::getNameField(unidadMedidaTableClass::ID)
                    . ' WHERE insu1.' . insumoTableClass::ID . ' = :id'
                    . ' AND insu1=insu2 '
                    . ' AND insu1=insu3 '
                    . ' AND insu3=insu2 ';
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
    
    public static function getCantidadInsumoById($id) {
        try {
            $sql = 'SELECT
"public".insumo.inventario_bodega AS inventario
FROM
"public".insumo
WHERE
"public".insumo."id" = :id AND
"public".insumo.activo = \'t\'';
           // echo $sql;
            //exit();
            $params = array(':id' => $id);
            $answer = modelClass::getInstance()->prepare($sql);
            $answer->execute($params);
            $answer = $answer->fetchAll(PDO::FETCH_OBJ);
            return (count($answer) === 0) ? false : $answer[0]->inventario;
        } catch (PDOException $exc) {
            throw $exc;
        }
    }
    
    

}
