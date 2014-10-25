<?php

use mvc\interfaces\controllerInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of insumoClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class insumoClass extends controllerClass implements controllerInterface {

  public function indexAction() {
    $this->mensaje = 'jhon bien';
    $this->defineView('index', 'insumo', session::getInstance()->getFormatOutput());
  }

}
