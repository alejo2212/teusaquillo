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
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
      if (request::getInstance()->isMethod('POST')) {
        
        $id = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true));
        $usuario = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true));
        $activado = (request::getInstance()->hasPost(usuarioTableClass::getNameField(usuarioTableClass::ACTIVED, true))) ? request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ACTIVED, true)) : 'f';
        
        $ids = array(
            usuarioTableClass::ID => $id
        );
        
        $data = array(
            usuarioTableClass::USER => $usuario,
            usuarioTableClass::ACTIVED => $activado
        );
        usuarioTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Actualización exitosa');
        
        routing::getInstance()->redirect('security', 'index');
      } else {
        routing::getInstance()->redirect('security', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('security', 'index');
    }
  }

}
