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
  * @author Aleyda Mina Caicedo <aleminac@gmail.com>
 */
class newActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
      if (session::getInstance()->hasAttribute('form')) {
            $raza = session::getInstance()->getAttribute('form');
            session::getInstance()->setFlash('raza', $raza);
        }
    $this->defineView('new', 'raza', session::getInstance()->getFormatOutput());
  }

}
