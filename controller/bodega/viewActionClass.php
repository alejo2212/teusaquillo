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
 * @author jhon fernando hoyos diaz <aprendiz.jhonfernandohoyosdiaz@gmail.com>
 */
class viewActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasGet('id')) {
                $id = request::getInstance()->getGet('id');

                $this->objbodega = bodegaTableClass::getBodegaById($id);

                $this->defineView('view', 'bodega', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('bodega', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('bodega', 'index');
        }
    }

}
