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
            $tipoAmbiente = session::getInstance()->getAttribute('form');
            session::getInstance()->setFlash('tipoAmbiente', $tipoAmbiente);
        }
        

        $this->defineView('new', 'tipoAmbiente', session::getInstance()->getFormatOutput());
    }

}
