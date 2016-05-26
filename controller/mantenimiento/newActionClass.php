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
      $mantenimiento = session::getInstance()->getAttribute('form');
      session::getInstance()->setFlash('mantenimiento', $mantenimiento);
    }
    $fieldsTipoMante = array(
        tipoMantenimientoTableClass::ID,
        tipoMantenimientoTableClass::NOMBRE
    );
    $this->objTipoMante = tipoMantenimientoTableClass::getAll($fieldsTipoMante, true, array(tipoMantenimientoTableClass::NOMBRE), 'ASC');
    
    $fieldsMaquina = array(
        maquinaTableClass::ID,
        maquinaTableClass::DESCRIPCION
    );
    $this->objMaquina = maquinaTableClass::getAll($fieldsMaquina, true, array(maquinaTableClass::DESCRIPCION), 'ASC');
    
    $fieldsEmple = array(
        empleadoTableClass::ID,
        empleadoTableClass::NOMBRE
    );
    $this->objEmpleado = empleadoTableClass::getAll($fieldsEmple, true, array(empleadoTableClass::NOMBRE), 'ASC');
    
    $this->defineView('new', 'mantenimiento', session::getInstance()->getFormatOutput());
  }

}
