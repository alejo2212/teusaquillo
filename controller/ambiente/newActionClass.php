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
            $ambiente = session::getInstance()->getAttribute('form');
            session::getInstance()->setFlash('ambiente', $ambiente);
        }
        $fieldsTipoAmb = array(
            tipoAmbienteTableClass::ID,
            tipoAmbienteTableClass::NOMBRE
        );
        $this->objTipoAmb = tipoAmbienteTableClass::getAll($fieldsTipoAmb, true, array(tipoAmbienteTableClass::NOMBRE), 'ASC');


        $this->defineView('new', 'ambiente', session::getInstance()->getFormatOutput());
    }

}
