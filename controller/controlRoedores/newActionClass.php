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
  @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com> */
class newActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        if (session::getInstance()->hasAttribute('form')) {
            $controlRoedores = session::getInstance()->getAttribute('form');
            session::getInstance()->setFlash('controlRoedores', $controlRoedores);
        }
        $this->objAdmin = empleadoTableClass::getAdministrador();
        $this->objVeterinario = empleadoTableClass::getVeterinario();
        $fieldsEmpleado = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
        );
        $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado, true, array(empleadoTableClass::NOMBRE), 'ASC');

        $this->defineView('new', 'controlRoedores', session::getInstance()->getFormatOutput());
        
    }

}
