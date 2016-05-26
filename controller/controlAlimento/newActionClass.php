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
      $controlAlimento = session::getInstance()->getAttribute('form');
      session::getInstance()->setFlash('controlAlimento', $controlAlimento);
    }
    $fieldsEmple = array(
        empleadoTableClass::ID,
        empleadoTableClass::NOMBRE
     );
    $fieldsAmbiente = array(
        ambienteHistorialLoteTableClass::ID,
        ambienteHistorialLoteTableClass::AMBIENTE_ID,
        ambienteHistorialLoteTableClass::LOTE_ID,
        ambienteHistorialLoteTableClass::NO_CASETA,
        ambienteHistorialLoteTableClass::CANTIDAD_HEMBRAS,
        ambienteHistorialLoteTableClass::CANTIDAD_MACHOS
     );
    $this->objEmpleado = empleadoTableClass::getAll($fieldsEmple, true, array(empleadoTableClass::NOMBRE), 'ASC');
    $this->objAmbienteHistorial = ambienteHistorialLoteTableClass::getAmbienteHistLote();
    
    $this->defineView('new', 'controlAlimento', session::getInstance()->getFormatOutput());
  }

}
