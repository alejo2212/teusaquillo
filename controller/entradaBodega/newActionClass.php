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
  @author jhon fernando hoyos diaz <aprendiz.jhonfernandohoyosdiaz@gmail.com> */
class newActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        if (session::getInstance()->hasAttribute('form')) {
            $entradaBodega = session::getInstance()->getAttribute('form');
            session::getInstance()->setFlash('entradaBodega', $entradaBodega);
        }
        $fieldsempleado = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
        );
        $fieldstransportador = array(
            transportadorTableClass::ID,
            transportadorTableClass::NOMBRE
        );

        $this->objempleado = empleadoTableClass::getAll($fieldsempleado, true, array(empleadoTableClass::NOMBRE), 'ASC');
        $this->objtransportador = transportadorTableClass::getAll($fieldstransportador, true, array(transportadorTableClass::NOMBRE), 'ASC');
        $this->defineView('new', 'entradaBodega', session::getInstance()->getFormatOutput());
    }

}
