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
class userCredentialCreateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $id_credencial = request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true));
        $id_usuario = request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true));
        
        $data = array(
            usuarioCredencialTableClass::USUARIO_ID => $id_usuario,
            usuarioCredencialTableClass::CREDENCIAL_ID => $id_credencial,
            usuarioCredencialTableClass::CREATED_AT => date(config::getFormatTimestamp())
        );
        usuarioCredencialTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');
        routing::getInstance()->redirect('security', 'userCredentialIndex');
      } else {
        routing::getInstance()->redirect('security', 'userCredentialIndex');
      }
    } catch (Exception $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('Registro duplicado');
          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('security', 'userCredentialIndex');
    }
  }

}
