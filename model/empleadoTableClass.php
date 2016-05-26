<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of requisicionTableClass
 *
 * @author Jhonny Alejandro <jhonny2212@hotmail.com>
 */
class empleadoTableClass extends empleadoBaseTableClass {

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM empleado
      $sql = 'SELECT COUNT(' . empleadoTableClass::getNameField(empleadoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . empleadoTableClass::getNameTable()
              . ' WHERE ' . empleadoTableClass::getNameField(empleadoTableClass::DELETED_AT) . ' IS NULL';
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
      $sql = 'SELECT COUNT(' . empleadoTableClass::getNameField(empleadoTableClass::ID) . ') AS cantidad'
              . ' FROM ' . empleadoTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . empleadoTableClass::getNameField(empleadoTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . empleadoTableClass::getNameField(empleadoTableClass::DELETED_AT) . ' IS NULL';
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

  public static function getEmpleado($id) {
    try {
      $sql = 'SELECT 
              emp1.' . empleadoTableClass::ID . ',
              emp1.' . empleadoTableClass::FEHCA_INGRESO . ',
              emp1.' . empleadoTableClass::TIPO_ID . ',
              emp1.' . empleadoTableClass::DOCUMENTO . ' ,
              emp1.' . empleadoTableClass::GENERO . ' ,
              emp1.' . empleadoTableClass::NOMBRE . ',
              emp1.' . empleadoTableClass::APELLIDO . ' ,
              emp1.' . empleadoTableClass::TELEFONO . ',
              emp1.' . empleadoTableClass::DIRECCION . ',
              emp1.' . empleadoTableClass::CORREO . ', 
              emp1.' . empleadoTableClass::CARGO . ', 
              emp1.' . empleadoTableClass::LOCALIZACION_ID . ', 
              emp1.' . empleadoTableClass::USUARIO_ID . ',
              emp1.' . empleadoTableClass::FOTO . ',
              emp1.' . empleadoTableClass::DELETED_AT . ',
              emp1.' . empleadoTableClass::ACTIVO . ' 
              FROM '
              . empleadoTableClass::getNameTable() . ' AS emp1 INNER JOIN ' . tipoIdentificacionTableClass::getNameTable() . ' AS ide ON emp1.' . empleadoTableClass::TIPO_ID . '=ide.' . tipoIdentificacionTableClass::ID . ', '
              . empleadoTableClass::getNameTable() . ' AS emp2 INNER JOIN ' . cargoTableClass::getNameTable() . ' ON emp2.' . empleadoTableClass::CARGO . '=' . cargoTableClass::getNameField(cargoTableClass::ID) . ', '
              . empleadoTableClass::getNameTable() . ' AS emp3 INNER JOIN ' . localidadTableClass::getNameTable() . ' AS ciu ON emp3.' . empleadoTableClass::LOCALIZACION_ID . '=ciu.' . localidadTableClass::ID .
              ' WHERE emp1.' . empleadoTableClass::ID . ' = :id
              AND emp1=emp2 
              AND emp1=emp3 
              AND emp2=emp3
              AND emp1.' . empleadoTableClass::DELETED_AT . ' IS NULL';
//      echo $sql;
//      exit();
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

  public static function getEmpleadoById($id) {
    try {
      $sql = 'SELECT '
              . empleadoTableClass::getNameField(empleadoTableClass::NOMBRE) . '
              FROM '
              . empleadoTableClass::getNameTable() . 
              ' WHERE ' . empleadoTableClass::ID . ' = :id
              AND ' . empleadoTableClass::DELETED_AT . ' IS NULL';
      //echo $sql;
      //exit();
      $params = array(
          ':id' => $id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return (count($answer) === 0) ? false : $answer[0]->nombre;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function getAdministrador() {
    try {
      $sql = 'SELECT '
              . empleadoTableClass::getNameField(empleadoTableClass::ID) . ', '
              . empleadoTableClass::getNameField(empleadoTableClass::NOMBRE) . '
              FROM '
              . empleadoTableClass::getNameTable() . 
              ' WHERE ' . empleadoTableClass::CARGO . ' = 1
              AND ' . empleadoTableClass::DELETED_AT . ' IS NULL';
      //echo $sql;
      //exit();
      $params = array(
          
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return ($answer === 0) ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  public static function getVeterinario() {
    try {
      $sql = 'SELECT '
              . empleadoTableClass::getNameField(empleadoTableClass::ID) . ', '
              . empleadoTableClass::getNameField(empleadoTableClass::NOMBRE) . '
              FROM '
              . empleadoTableClass::getNameTable() . 
              ' WHERE ' . empleadoTableClass::CARGO . ' = 3
              AND ' . empleadoTableClass::DELETED_AT . ' IS NULL';
      //echo $sql;
      //exit();
      $params = array(
          
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return ($answer === 0) ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
