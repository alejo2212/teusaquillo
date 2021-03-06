<?php

use mvc\interfaces\controllerInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of defaultClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class defaultClass extends controllerClass implements controllerInterface {

  public function indexAction() {
    $this->mensaje = 'Bienvenido al sistema Soveuh System';
    $this->defineView('index', 'default', session::getInstance()->getFormatOutput());
  }

}
