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
      $controlCompostaje = session::getInstance()->getAttribute('form');
      session::getInstance()->setFlash('controlCompostaje', $controlCompostaje);
    }
    if (request::getInstance()->hasGet('idSalidaLote')and request::getInstance()->hasGet('cantidad_hembras')and request::getInstance()->hasGet('cantidad_machos')) {
      
      $this->idSa = array(
          'salida'=>request::getInstance()->getGet('idSalidaLote'),
          'hembras'=>request::getInstance()->getGet('cantidad_hembras'),
          'machos'=>request::getInstance()->getGet('cantidad_machos')
      );
    } else {
      $this->idSa = '';
    }
//        exit();
    $this->objAdmin = empleadoTableClass::getAdministrador();
    $this->objVeterinario = empleadoTableClass::getVeterinario();

    $fieldsResponsable = array(
        empleadoTableClass::ID,
        empleadoTableClass::NOMBRE
    );
    $this->objEmpleado = empleadoTableClass::getAll($fieldsResponsable, true, array(empleadoTableClass::NOMBRE), 'ASC');


    $fieldsCajon = array(
        cajonCompostajeTableClass::ID,
        cajonCompostajeTableClass::OBSERVACION
    );
    $this->objCajon = cajonCompostajeTableClass::getAll($fieldsCajon, true, array(cajonCompostajeTableClass::OBSERVACION), 'ASC');



    $fieldsSalidalote = array(
        salidaLoteTableClass::ID,
        salidaLoteTableClass::CANTIDAD_HEMBRAS,
        salidaLoteTableClass::CANTIDAD_MACHOS,
        salidaLoteTableClass::CANTIDAD_TOTAL
    );
    $this->objSalidalote = salidaLoteTableClass::getAll($fieldsSalidalote, true, array(salidaLoteTableClass::ID), 'ASC');

    $this->defineView('new', 'controlCompostaje', session::getInstance()->getFormatOutput());
  }

}
