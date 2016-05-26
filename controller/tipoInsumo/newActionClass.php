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
            $tipoInsumo = session::getInstance()->getAttribute('form');
            session::getInstance()->setFlash('tipoInsumo', $tipoInsumo);
        }
        $this->defineView('new', 'tipoInsumo', session::getInstance()->getFormatOutput());
    }

}
