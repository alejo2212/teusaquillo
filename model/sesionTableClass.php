<?php

use mvc\model\modelClass;

/**
 * Description of sesionClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class sesionTableClass extends sesionBaseTableClass {

  public static function getUserAndPassword($ip_address, $hash_cookie) {
    try {
      $sql = 'SELECT ' . usuarioTableClass::getNameField(usuarioTableClass::ID) . ', ' . usuarioTableClass::getNameField(usuarioTableClass::USER) . ', ' . usuarioTableClass::getNameField(usuarioTableClass::PASSWORD) . ' '
              . 'FROM ' . usuarioTableClass::getNameTable() . ' INNER JOIN ' . sesionTableClass::getNameTable() . ' ON ' . usuarioTableClass::getNameField(usuarioTableClass::ID) . ' = ' . sesionTableClass::getNameField(sesionTableClass::USUARIO_ID) . ' '
              . 'WHERE ' . sesionTableClass::getNameField(sesionTableClass::IP_ADDRESS) . ' = :ip_address '
              . 'AND ' . sesionTableClass::getNameField(sesionTableClass::HASH_COOKIE) . ' = :hash_cookie '
              . 'AND ' . usuarioTableClass::getNameField(usuarioTableClass::ACTIVED) . ' = 1 '
              . 'AND ' . usuarioTableClass::getNameField(usuarioTableClass::DELETED_AT) . ' IS NULL';
      $params = array(
        ':ip_address' => $ip_address,
        ':hash_cookie' => $hash_cookie
      );
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      
      // $id = usuarioTableClass::ID;
      // $answer[0]->$id;
      
      return (count($answer) === 0) ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function clearSessions($date_limit) {
    try {
     $sql = 'DELETE FROM ' . sesionTableClass::getNameTable() . ' WHERE ' . sesionTableClass::getNameField(sesionTableClass::CREATED_AT) . ' >= :date_limit'; 
     $params = array(':date_limit' => $date_limit);
     modelClass::getInstance()->beginTransaction();
     modelClass::getInstance()->prepare($sql)->execute($params);
     modelClass::getInstance()->commit();
     return true;
    } catch (PDOException $exc) {
      modelClass::getInstance()->rollBack();
      throw $exc;
    }
  }

}
