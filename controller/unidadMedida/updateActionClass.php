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

                $id = request::getInstance()->getPost(unidadMedidaTableClass::getNameField(unidadMedidaTableClass::ID, true));
                $nombre = request::getInstance()->getPost(unidadMedidaTableClass::getNameField(unidadMedidaTableClass::NOMBRE, true));
                $sigla = request::getInstance()->getPost(unidadMedidaTableClass::getNameField(unidadMedidaTableClass::SIGLA, true));
                $observacion = request::getInstance()->getPost(unidadMedidaTableClass::getNameField(unidadMedidaTableClass::OBSERVACION, true));
                $ids = array(
                    unidadMedidaTableClass::ID => $id
                );

                $data = array(
                    unidadMedidaTableClass::NOMBRE => $nombre,
                    unidadMedidaTableClass::SIGLA => $sigla,
                    unidadMedidaTableClass::OBSERVACION=> $observacion
                );
                unidadMedidaTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Actualización exitosa');

                routing::getInstance()->redirect('unidadMedida', 'index');
            } else {
                routing::getInstance()->redirect('unidadMedida', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('unidadMedida', 'index');
        }
    }

}
