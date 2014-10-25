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
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    $fields = array(
        usuarioTableClass::ID,
        usuarioTableClass::USER,
        usuarioTableClass::ACTIVED,
        usuarioTableClass::LAST_LOGIN_AT
    );
    $this->objUsuarios = usuarioTableClass::getAll($fields, true, array(usuarioTableClass::USER), 'ASC');
    $this->defineView('index', 'security', session::getInstance()->getFormatOutput());
  }

}
