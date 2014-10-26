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

        $nombre = request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE, true));
        $observacion = request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::OBSERVACION, true));
        
        
        $data = array(
            tipoInsumoTableClass::NOMBRE => $nombre,
            tipoInsumoTableClass::OBSERVACION => $observacion
          
        );
        tipoInsumoTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');
        
        routing::getInstance()->redirect('tipoInsumo', 'index');
      } else {
        routing::getInstance()->redirect('tipoInsumo', 'index');
      }
    } catch (Exception $exc) {
      echo $exc->getMessage();
    }
  }

}
