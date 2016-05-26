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
                $this->objentradaBodega = entradaBodegaTableClass::getentradaBodegaById($id);
                $this->edit = true;
                $fieldsempleado = array(
                    empleadoTableClass::ID,
                    empleadoTableClass::NOMBRE
                );
                $fieldstransportador = array(
                    transportadorTableClass::ID,
                    transportadorTableClass::NOMBRE
                );
                
                $this->objempleado = empleadoTableClass::getAll($fieldsempleado, true, array(empleadoTableClass::NOMBRE), 'ASC');
                $this->objtransportador = transportadorTableClass::getAll($fieldstransportador, true, array(transportadorTableClass::NOMBRE), 'ASC');
                $this->defineView('edit', 'entradaBodega', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('entradaBodega', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('entradaBodega', 'index');
        }
    }

}
