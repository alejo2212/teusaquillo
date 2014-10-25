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
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = request::getInstance()->getPost(tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::NOMBRE, true));
        $descripcion = request::getInstance()->getPost(tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::DESCRIPCION, true));
        $observacion = request::getInstance()->getPost(tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::OBSERVACION, true)) . '2';
        
        $data = array(
            tipoAmbienteTableClass::NOMBRE => $nombre,
            tipoAmbienteTableClass::DESCRIPCION => $descripcion,
            tipoAmbienteTableClass::OBSERVACION => $observacion
        );
        tipoAmbienteTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');
        
        routing::getInstance()->redirect('tipoAmbiente', 'index');
      } else {
        routing::getInstance()->redirect('tipoAmbiente', 'index');
      }
    } catch (Exception $exc) {
      echo $exc->getMessage();
    }
  }

}
