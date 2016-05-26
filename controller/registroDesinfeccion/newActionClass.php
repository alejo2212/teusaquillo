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
  @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com.com> */
class newActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
      if (session::getInstance()->hasAttribute('form')) {
            $registroDesinfeccion = session::getInstance()->getAttribute('form');
            session::getInstance()->setFlash('registroDesinfeccion', $registroDesinfeccion);
        }
        
        $this->objVerificador = empleadoTableClass::getAdministrador();
//        $this->objVeterinario = empleadoTableClass::getVeterinario();
        
        $fieldsEmpleado = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
        );
        $this->objRespon = empleadoTableClass::getAll($fieldsEmpleado, true, array(empleadoTableClass::NOMBRE), 'ASC');


        $fieldsTipoDesinfeccion = array(
            tipoDesinfeccionTableClass::ID,
            tipoDesinfeccionTableClass::NOMBRE
        );
        $this->objtipoDesinfeccion = tipoDesinfeccionTableClass::getAll($fieldsTipoDesinfeccion, true, array(tipoDesinfeccionTableClass::NOMBRE), 'ASC');
        $this->numramadas = ambienteTableClass::getNumRamadas();
        $this->defineView('new', 'registroDesinfeccion', session::getInstance()->getFormatOutput());
        
    }

}
