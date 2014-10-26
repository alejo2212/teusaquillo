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
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(presentacionTableClass::getNameField(presentacionTableClass::ID, true));
                $nombre = request::getInstance()->getPost(presentacionTableClass::getNameField(presentacionTableClass::NOMBRE, true));
                $observacion = request::getInstance()->getPost(presentacionTableClass::getNameField(presentacionTableClass::OBSERVACION, true));
                $ids = array(
                    presentacionTableClass::ID => $id
                );

                $data = array(
                    presentacionTableClass::NOMBRE => $nombre,
                    presentacionTableClass::OBSERVACION=> $observacion
                );
                presentacionTableClass::update($ids, $data);
                session::getInstance()->setSuccess('presentacion exitosa');

                routing::getInstance()->redirect('presentacion', 'index');
            } else {
                routing::getInstance()->redirect('presentacion', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('presentacion', 'index');
        }
    }

}
