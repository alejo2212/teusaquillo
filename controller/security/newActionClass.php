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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class newActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {

    if(session::getInstance()->hasAttribute('form')) {
      $usuario = session::getInstance()->getAttribute('form');
      session::getInstance()->setFlash('usuario', $usuario);
    }
    
    session::getInstance()->setInformation('La contraseña no debe de contener caracteres especiales (\\*@;.,)');
    $this->defineView('new', 'security', session::getInstance()->getFormatOutput());
  }

}
