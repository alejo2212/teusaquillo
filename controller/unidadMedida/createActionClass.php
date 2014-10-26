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
@author jhon fernando hoyos diaz <aprendiz.jhonfernandohoyosdiaz@gmail.com> */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = request::getInstance()->getPost(unidadMedidaTableClass::getNameField(unidadMedidaTableClass::NOMBRE, true));
        $sigla = request::getInstance()->getPost(unidadMedidaTableClass::getNameField(unidadMedidaTableClass::SIGLA, true));
        $observacion = request::getInstance()->getPost(unidadMedidaTableClass::getNameField(unidadMedidaTableClass::OBSERVACION, true));
        
        
        $data = array(
            unidadMedidaTableClass::NOMBRE => $nombre,
            unidadMedidaTableClass::SIGLA => $sigla,
            unidadMedidaTableClass::OBSERVACION => $observacion
          
        );
        unidadMedidaTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');
        
        routing::getInstance()->redirect('unidadMedida', 'index');
      } else {
        routing::getInstance()->redirect('unidadMedida', 'index');
      }
    } catch (Exception $exc) {
      echo $exc->getMessage();
    }
  }

}
