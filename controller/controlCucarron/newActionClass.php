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
            $controlCucarron = session::getInstance()->getAttribute('form');
            session::getInstance()->setFlash('controlCucarron', $controlCucarron);
        }
        
        $this->objAdmin = empleadoTableClass::getAdministrador();
        $this->objVeterinario = empleadoTableClass::getVeterinario();
        
        $fieldsEmpleado = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
        );
        $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado, true, array(empleadoTableClass::NOMBRE), 'ASC');


        $fieldsFormaAplicacion = array(
            formaAplicacionTableClass::ID,
            formaAplicacionTableClass::NOMBRE
        );
        $this->objformaAplicacion = formaAplicacionTableClass::getAll($fieldsFormaAplicacion, true, array(formaAplicacionTableClass::NOMBRE), 'ASC');

        $this->defineView('new', 'controlCucarron', session::getInstance()->getFormatOutput());
        
    }

}
