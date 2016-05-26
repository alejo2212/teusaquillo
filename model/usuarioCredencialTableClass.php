<?php

use mvc\model\modelClass;
use mvc\config\configClass;

/**
 * Description of usuarioCredencialTableClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class usuarioCredencialTableClass extends usuarioCredencialBaseTableClass {
  
  public static function getCountPages() {
    try {
      // SELECT COUNT(id) FROM usuario
      $sql = 'SELECT COUNT(' . usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::ID) . ') AS cantidad'
              . ' FROM ' . usuarioCredencialTableClass::getNameTable();
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute();
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return ceil($answer[0]->cantidad / configClass::getRowGrid());
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
}
