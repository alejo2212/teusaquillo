<?php

/**
 * Description of incubadoraTableClass
 *
 * @author paula andrea lopez <palopez7317@misena.edu.co>
 */
class incubadoraTableClass extends incubadoraBaseTableClass {
  public static function getDataincubadora($id){
      try {
          $sql ='SELECT ' .incubadoraTableClass::getNameField(incubadoraTableClass::ID).', '. incubadoraTableClass::getNameField(incubadoraTableClass::NOMBRE).'; '.incubadoraTableClass::getNameField(incubadoraTableClass::OBSERVACION). ' '//me faltan campos//
          . 'FROM '. incubadoraTableClass::getNameTable() . 'WHERE '.incubadoraTableClass::getNameField(incubadoraTableClass::ID.' =:id');
      $params = array(':id'=> $id);
      
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer;
          
      } catch (PDOException $exc) {
          throw $exe;
      }
    }  
}
