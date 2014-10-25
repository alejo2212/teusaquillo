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
class createdActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $descripcion = request::getInstance()->getPost(tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DESCRIPCION, true));
        
        $data = array(
            tipoIdentificacionTableClass::DESCRIPCION => $descripcion
        );
        tipoIdentificacionTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');
        
        routing::getInstance()->redirect('tipoid', 'index');
      } else {
        routing::getInstance()->redirect('tipoid', 'index');
      }
    } catch (Exception $exc) {
      echo $exc->getMessage();
    }
  }
}
