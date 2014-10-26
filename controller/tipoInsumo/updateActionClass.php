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

                $id = request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID, true));
                $nombre = request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE, true));
                $observacion = request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::OBSERVACION, true));
                $ids = array(
                    tipoInsumoTableClass::ID => $id
                );

                $data = array(
                    tipoInsumoTableClass::NOMBRE => $nombre,
                    tipoInsumoTableClass::OBSERVACION=> $observacion
                );
                tipoInsumoTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Actualización exitosa');

                routing::getInstance()->redirect('tipoInsumo', 'index');
            } else {
                routing::getInstance()->redirect('tipoInsumo', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('tipoInsumo', 'index');
        }
    }

}
