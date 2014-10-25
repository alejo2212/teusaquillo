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
 * @author A <@gmail.com>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::ID, true));
                $nombre = request::getInstance()->getPost(tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::NOMBRE, true));
                $descripcion = request::getInstance()->getPost(tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::DESCRIPCION, true));
                $observacion = request::getInstance()->getPost(tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::OBSERVACION, true));
                

                $ids = array(
                    tipoAmbienteTableClass::ID => $id
                );

                $data = array(
                    tipoAmbienteTableClass::NOMBRE => $nombre,
                    tipoAmbienteTableClass::DESCRIPCION => $descripcion,
                    tipoAmbienteTableClass::OBSERVACION => $observacion
                );
                tipoAmbienteTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Actualización exitosa');

                routing::getInstance()->redirect('tipoAmbiente', 'index');
            } else {
                routing::getInstance()->redirect('tipoAmbiente', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('tipoAmbiente', 'index');
        }
    }

}
