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
                $this->objambienteHistorialLote = ambienteHistorialLoteTableClass::getambienteHistorialLoteById($id);
                $this->edit = true;
                $fieldsambiente = array(
                    ambienteTableClass::ID,
                    ambienteTableClass::NOMBRE
                );
                $fieldslote = array(
                    loteTableClass::ID,
                    loteTableClass::LOTE
                );
                
                $this->objambiente = ambienteTableClass::getAll($fieldsambiente, true, array(ambienteTableClass::NOMBRE), 'ASC');
                $this->objlote = loteTableClass::getAll($fieldslote, true, array(loteTableClass::LOTE), 'ASC');
                $this->defineView('edit', 'ambienteHistorialLote', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('ambienteHistorialLote', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('ambienteHistorialLote', 'index');
        }
    }

}
