<?php

/**
 * Description of maquinaTableClass
 *
 * @author liliana carolina moreno <lilianacarol6@hotmail.com>
 */
class maquinaTableClass extends maquinaBaseTableClass {
 
    public static function getdatabaseMaquina ($Id) {
        try {
           $sql = 'SELECT '. maquinaTableClass::getNameField(maquinaTableClass::ID).', '.maquinaTableClass::FECHA_IONGRESO. ', '.maquinaTableClass::DIRECCION. ', '.maquinaTableClass::CODIGO. ', ' .maquinaTableClass::REFERENCIA. ', ' .maquinaTableClass::FECHA_MANTENIMIENTO. ', ' .maquinaTableClass::INTERVALO_MANTENIMIENTO. ', ' .maquinaTableClass::ACTIVADO. ', ' .maquinaTableClass::valor. ', '.maquinaTableClass::DELATED_AT.' '
           
                            .'FROM'.maquinaBaseTableClass::getNameTable(). 'WERW' . maquinaTableClass::getNameTable(maquinaTableClass::ID). ' = :id';
      $params = Array (':id' => $id);
      $answer = modelClass::getInstance()->prepare($sql);
      $answer->execute($params);
      $answer = $answer->fetchAll(PDO::FETCH_OBJ);
      return (count($answer) === 0) ? false : $answer;
    } catch (PDOException $exc) {
      throw $exc;
    }
  }
  
  public static function clearSessions($date_limit) {
    try {
     $sql = 'DELETE FROM sesion WHERE ' . sesionTableClass::getNameField(sesionTableClass::CREATED_AT) . ' >= :date_limit'; 
     $params = array(':date_limit' => $date_limit);
     modelClass::getInstance()->beginTransaction();
     modelClass::getInstance()->prepare($sql)->execute($params);
     modelClass::getInstance()->commit();
     return true;
        } catch (PDOException $ex) {
          throw $exe;
        }
}

}