<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of defaultClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class informeActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {

        try {
            session::getInstance()->deleteAttribute('form');
            $fields = array(
                ambienteTableClass::ID,
                ambienteTableClass::NOMBRE,
                ambienteTableClass::OBSERVACION,
                ambienteTableClass::TIPO_AMBIENTE_ID,
                ambienteTableClass::DELETED_AT
            );

            $where = $this->filters();
//
            $this->objAmbiente = ambienteTableClass::getAll($fields, true, array(ambienteTableClass::NOMBRE), 'ASC', null, null, $where);
            $this->defineView('informe', 'ambiente', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('ambiente', 'index');
        }
    }

    private function filters() {
        $where = array();

        if (
                request::getInstance()->hasPost(ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true))
                and
                request::getInstance()->getPost(ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true)) !== ''
        ) {
            $where[ambienteTableClass::getNameField(ambienteTableClass::NOMBRE)] = request::getInstance()->getPost(ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true));
        }
        if (
                request::getInstance()->hasPost(ambienteTableClass::getNameField(ambienteTableClass::TIPO_AMBIENTE_ID, true))
                and
                request::getInstance()->getPost(ambienteTableClass::getNameField(ambienteTableClass::TIPO_AMBIENTE_ID, true)) !== ''
        ) {
            $where[ambienteTableClass::getNameField(ambienteTableClass::TIPO_AMBIENTE_ID)] = request::getInstance()->getPost(ambienteTableClass::getNameField(ambienteTableClass::TIPO_AMBIENTE_ID, true));
        }
        return $where;
    }

}
