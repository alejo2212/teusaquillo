<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of newActionClass
 *
 * @author Jhonny Alejandro Diaz <Jhonny2212@hotmail.com>
 */
class newActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    if (session::getInstance()->hasAttribute('form')) {
      $maquina = session::getInstance()->getAttribute('form');
      session::getInstance()->setFlash('maquina', $maquina);
    }
            $fieldsMaquina = array(
            clasificacionMaquinaTableClass::ID,
            clasificacionMaquinaTableClass::NOMBRE
        );
            
            $fieldsbodegaclasi = array(
            bodegaClasificacionTableClass::ID,
            bodegaClasificacionTableClass::NOMBRE
        );
   $this->objClasiMaquina = clasificacionMaquinaTableClass::getAll($fieldsMaquina, true, array(clasificacionMaquinaTableClass::NOMBRE), 'ASC');
   $this->objclasibodega = bodegaClasificacionTableClass::getAll($fieldsbodegaclasi, true, array(bodegaClasificacionTableClass::NOMBRE), 'ASC');
   $this->defineView('new', 'maquina', session::getInstance()->getFormatOutput());
  }

}
