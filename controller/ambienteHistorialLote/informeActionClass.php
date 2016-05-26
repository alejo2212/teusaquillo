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
                ambienteHistorialLoteTableClass::ID,
                ambienteHistorialLoteTableClass::AMBIENTE_ID,
                ambienteHistorialLoteTableClass::LOTE_ID,
                ambienteHistorialLoteTableClass::NO_CASETA,
                ambienteHistorialLoteTableClass::CANTIDAD_HEMBRAS,
                ambienteHistorialLoteTableClass::CANTIDAD_MACHOS
            );

            $where = $this->filters();
//
            $this->objambienteHistorialLote = ambienteHistorialLoteTableClass::getAll($fields, true, array(ambienteHistorialLoteTableClass::ID), 'ASC', null, null, $where);
            $this->defineView('informe', 'ambienteHistorialLote', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('ambienteHistorialLote', 'index');
        }
    }

    private function filters() {
        $where = array();

        if (
                request::getInstance()->hasPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::AMBIENTE_ID, true))
                and
                request::getInstance()->getPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::AMBIENTE_ID, true)) !== ''
        ) {
            $where[ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::AMBIENTE_ID)] = request::getInstance()->getPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::AMBIENTE_ID, true));
        }
        if (
                request::getInstance()->hasPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::LOTE_ID, true))
                and
                request::getInstance()->getPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::LOTE_ID, true)) !== ''
        ) {
            $where[ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::LOTE_ID)] = request::getInstance()->getPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::LOTE_ID, true));
        }

        if (
                request::getInstance()->hasPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::NO_CASETA, true))
                and
                request::getInstance()->getPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::NO_CASETA, true)) !== ''
        ) {
            $where[ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::NO_CASETA)] = request::getInstance()->getPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::NO_CASETA, true));
        }

        return $where;
    }

}
