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
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $user = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true));
        $pass1 = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true));
        $pass2 = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true)) . '2';
        
        $data = array(
            usuarioTableClass::USER => $user,
            usuarioTableClass::PASSWORD => md5($pass1),
            usuarioTableClass::ACTIVED => 't',
            usuarioTableClass::CREATED_AT => date(config::getFormatTimestamp()),
            usuarioTableClass::LAST_LOGIN_AT => date(config::getFormatTimestamp())
        );
        usuarioTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');
        
        routing::getInstance()->redirect('security', 'index');
      } else {
        routing::getInstance()->redirect('security', 'index');
      }
    } catch (Exception $exc) {
      echo $exc->getMessage();
    }
  }

}
