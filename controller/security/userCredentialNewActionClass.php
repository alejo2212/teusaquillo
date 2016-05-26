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
class userCredentialNewActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      $fields = array(
        usuarioTableClass::ID,
        usuarioTableClass::USER
      );
      $orderBy = array(
        usuarioTableClass::USER
      );
      $this->objUsuarios = usuarioTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      $fields = array(
        credencialTableClass::ID,
        credencialTableClass::NOMBRE
      );
      $orderBy = array(
        credencialTableClass::NOMBRE
      );
      $this->objCredenciales = credencialTableClass::getAll($fields, true, $orderBy, 'ASC');

      $this->defineView('userCredentialNew', 'security', session::getInstance()->getFormatOutput());
    } catch (Exception $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('security', 'userCredentialIndex');
    }
  }

}
