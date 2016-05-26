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
            $alistamientoReparacion = session::getInstance()->getAttribute('form');
            session::getInstance()->setFlash('alistamientoReparacion', $alistamientoReparacion);
        }
        $fieldstiporepa = array(
            tipoReparacionTableClass::ID,
            tipoReparacionTableClass::NOMBRE
        );

        $this->objtiporepa = tipoReparacionTableClass::getAll($fieldstiporepa, true, array(tipoReparacionTableClass::NOMBRE), 'ASC');
        $this->defineView('new', 'alistamientoReparacion', session::getInstance()->getFormatOutput());
    }

}
