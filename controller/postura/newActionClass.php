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
      $Postura = session::getInstance()->getAttribute('form');
      session::getInstance()->setFlash('postura', $Postura);
    }
    $fieldslote = array(
        loteTableClass::ID,
        loteTableClass::LOTE
    );
    $fieldsambiente = array(
        ambienteTableClass::ID,
        ambienteTableClass::NOMBRE
    );
    $this->objambiente = ambienteTableClass::getRamadas();
    $this->objlote = loteTableClass::getAll($fieldslote, true, array(loteTableClass::LOTE), 'DESC');
    $this->defineView('new', 'postura', session::getInstance()->getFormatOutput());
  }

}
