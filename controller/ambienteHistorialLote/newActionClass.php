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
            $ambienteHistorialLote = session::getInstance()->getAttribute('form');
            session::getInstance()->setFlash('ambienteHistorialLote', $ambienteHistorialLote);
        }
        $fieldsambiente = array(
            ambienteTableClass::ID,
            ambienteTableClass::NOMBRE
        );
        $fieldslote = array(
            loteTableClass::ID,
            loteTableClass::LOTE
        );

//        $this->objambiente = ambienteTableClass::getAll($fieldsambiente, true, array(ambienteTableClass::NOMBRE), 'ASC');
        $this->objambiente = ambienteTableClass::getRamadas();
        $this->objlote = loteTableClass::getAll($fieldslote, true, array(loteTableClass::LOTE), 'DESC');
        $this->defineView('new', 'ambienteHistorialLote', session::getInstance()->getFormatOutput());
    }

}
