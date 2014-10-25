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

                $id = request::getInstance()->getPost(tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::ID, true));
                $nombre = request::getInstance()->getPost(tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::NOMBRE, true));
                $observacion = request::getInstance()->getPost(tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::OBSERVACION, true));
                $ids = array(
                    tipoDesinfeccionTableClass::ID => $id
                );

                $data = array(
                    tipoDesinfeccionTableClass::NOMBRE => $nombre,
                    tipoDesinfeccionTableClass::OBSERVACION=> $observacion
                );
                tipoDesinfeccionTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Actualización exitosa');

                routing::getInstance()->redirect('tipoDesinfeccion', 'index');
            } else {
                routing::getInstance()->redirect('tipoDesinfeccion', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('tipoDesinfeccion', 'index');
        }
    }

}
