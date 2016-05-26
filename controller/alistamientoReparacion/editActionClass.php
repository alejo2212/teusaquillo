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
class editActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasGet('id')) {
                $id = request::getInstance()->getGet('id');
                $this->objalistamientoReparacion = alistamientoReparacionTableClass::getalistamientoReparacionById($id);
                $this->edit = true;
                $fieldstiporepa = array(
                    tipoReparacionTableClass::ID,
                    tipoReparacionTableClass::NOMBRE
                );

                $this->objtiporepa = tipoReparacionTableClass::getAll($fieldstiporepa, true, array(tipoReparacionTableClass::NOMBRE), 'ASC');
                $this->defineView('edit', 'alistamientoReparacion', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('alistamientoReparacion', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('alistamientoReparacion', 'index');
        }
    }

}
