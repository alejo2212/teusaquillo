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
            $salidaLote = session::getInstance()->getAttribute('form');
            session::getInstance()->setFlash('salidaLote', $salidaLote);
        }
        
        $this->objAmbienteHistorial = ambienteHistorialLoteTableClass::getAmbienteHistLote();
       $fieldsRazonSalida = array(
            razonSalidaTableClass::ID,
            razonSalidaTableClass::RAZON
        );
        $this->objRazonSalida = razonSalidaTableClass::getAll($fieldsRazonSalida, true, array(razonSalidaTableClass::RAZON), 'ASC');
        
        $fieldsEmpleado = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
        );
        $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado, true, array(empleadoTableClass::NOMBRE), 'ASC');

    $this->defineView('new', 'salidaLote', session::getInstance()->getFormatOutput());
  }

}
