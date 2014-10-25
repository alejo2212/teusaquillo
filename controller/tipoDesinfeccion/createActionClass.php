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
 * @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com>
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = request::getInstance()->getPost(tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::NOMBRE, true));
        $observacion = request::getInstance()->getPost(tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::OBSERVACION, true));
        
        
        $data = array(
            tipoDesinfeccionTableClass::NOMBRE => $nombre,
            tipoDesinfeccionTableClass::OBSERVACION => $observacion
          
        );
        tipoDesinfeccionTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');
        
        routing::getInstance()->redirect('tipoDesinfeccion', 'index');
      } else {
        routing::getInstance()->redirect('tipoDesinfeccion', 'index');
      }
    } catch (Exception $exc) {
      echo $exc->getMessage();
    }
  }

}
