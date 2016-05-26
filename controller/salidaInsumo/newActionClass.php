<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class newActionClass extends controllerClass implements controllerActionInterface {

  
      public function execute() {
          if (session::getInstance()->hasAttribute('form')) {
            $salidaInsumo = session::getInstance()->getAttribute('form');
            session::getInstance()->setFlash('salidaInsumo', $salidaInsumo);
            }
       $fieldsEmplSal = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
        );
        $this->objEmplSal = empleadoTableClass::getAll($fieldsEmplSal, true, array(empleadoTableClass::NOMBRE), 'ASC');
         
       $fieldsEmplRec = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
        );
        $this->objEmplRec = empleadoTableClass::getAll($fieldsEmplRec, true, array(empleadoTableClass::NOMBRE), 'ASC');
        
        
    $this->defineView('new', 'salidaInsumo', session::getInstance()->getFormatOutput());
  }

}
