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
 * @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com>
 */
class newActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
      if (session::getInstance()->hasAttribute('form')) {
            $tipoDesinfeccion = session::getInstance()->getAttribute('form');
            session::getInstance()->setFlash('tipoDesinfeccion', $tipoDesinfeccion);
        }
    $this->defineView('new', 'tipoDesinfeccion', session::getInstance()->getFormatOutput());
  }

}
