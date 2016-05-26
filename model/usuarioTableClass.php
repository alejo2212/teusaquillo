<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of usuarioTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class usuarioTableClass extends usuarioBaseTableClass {

  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM usuario
      $sql = 'SELECT COUNT(' . usuarioTableClass::getNameField(usuarioTableClass::ID) . ') AS cantidad'
              . ' FROM ' . usuarioTableClass::getNameTable();
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
      $sql = 'SELECT COUNT(' . usuarioTableClass::getNameField(usuarioTableClass::ID) . ') AS cantidad'
              . ' FROM ' . usuarioTableClass::getNameTable();
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
        $sql = $sql . ' AND ' . usuarioTableClass::getNameField(usuarioTableClass::DELETED_AT) . ' IS NULL';
      } else {
        $sql = $sql . ' WHERE ' . usuarioTableClass::getNameField(usuarioTableClass::DELETED_AT) . ' IS NULL';
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

  public static function getUsuarioById($id) {
    try {
      $sql = 'SELECT '
              . usuarioTableClass::getNameField(usuarioTableClass::ID) . ', '
              . usuarioTableClass::getNameField(usuarioTableClass::USER) . ', '
              . usuarioTableClass::getNameField(usuarioTableClass::ACTIVED) . ', '
              . usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT) . ', '
              . usuarioTableClass::getNameField(usuarioTableClass::LAST_LOGIN_AT)
              . ' FROM ' . usuarioTableClass::getNameTable()
              . ' WHERE ' . usuarioTableClass::ID . ' = :id';
      $params = array(':id' => $id);
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer[0];
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function getUserNameById($id) {
    try {
      $sql = 'SELECT '
              . usuarioTableClass::getNameField(usuarioTableClass::USER) . '
              FROM '
              . usuarioTableClass::getNameTable() .
              ' WHERE ' . usuarioTableClass::ID . ' = :id
              AND ' . usuarioTableClass::DELETED_AT . ' IS NULL';
      //echo $sql;
      //exit();
      $params = array(
          ':id' => $id
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);

      return (count($answer) === 0) ? false : $answer[0]->user_name;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function verifyUser($usuario, $password) {
    try {
      $sql = 'SELECT ' . credencialTableClass::getNameField(credencialTableClass::NOMBRE) . ' as credencial,
	' . usuarioTableClass::getNameField(usuarioTableClass::USER) . ' as usuario,
	' . usuarioTableClass::getNameField(usuarioTableClass::ID) . ' as id_usuario
    FROM ' . usuarioTableClass::getNameTable() . ' LEFT JOIN ' . usuarioCredencialTableClass::getNameTable() . ' ON ' . usuarioTableClass::getNameField(usuarioTableClass::ID) . ' = ' . usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID) . '
    LEFT JOIN ' . credencialTableClass::getNameTable() . ' ON ' . credencialTableClass::getNameField(credencialTableClass::ID) . ' = ' . usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID) . '
    WHERE ' . usuarioTableClass::getNameField(usuarioTableClass::ACTIVED) . ' = :actived
    AND ' . usuarioTableClass::getNameField(usuarioTableClass::DELETED_AT) . ' IS NULL
    AND ' . credencialTableClass::getNameField(credencialTableClass::DELETED_AT) . ' IS NULL
    AND ' . usuarioTableClass::getNameField(usuarioTableClass::USER) . ' = :user
    AND ' . usuarioTableClass::getNameField(usuarioTableClass::PASSWORD) . ' = :pass';
      $params = array(
          ':user' => $usuario,
          ':pass' => md5($password),
          ':actived' => ((configClass::getDbDriver() === 'mysql') ? 1 : 't')
      );
//      echo $usuario, $password;
//      exit();
      $answer = modelClass::getInstance()->prepare($sql);
      
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
//      print_r($answer);
//      exit();
      return (count($answer) > 0 ) ? $answer : false;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

  public static function setRegisterLastLoginAt($id) {
    try {
      $sql = 'UPDATE ' . usuarioTableClass::getNameTable() . '
              SET ' . usuarioTableClass::LAST_LOGIN_AT . ' = :last_login_at
              WHERE ' . usuarioTableClass::ID . ' = :id';
      $params = array(
          ':id' => $id,
          ':last_login_at' => date(configClass::getFormatTimestamp())
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      return true;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }

}
