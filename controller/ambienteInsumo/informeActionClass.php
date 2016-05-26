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
                ambienteInsumoTableClass::ID,
                ambienteInsumoTableClass::AMBIENTE_ID,
                ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID,
                ambienteInsumoTableClass::FECHA_ASIGNACION,
                ambienteInsumoTableClass::FECHA_RETIRO,
                ambienteInsumoTableClass::DELETED_AT
            );

            $where = $this->filters();
//
            $this->objAmbienteInsumo = ambienteInsumoTableClass::getAll($fields, true, array(ambienteInsumoTableClass::AMBIENTE_ID), 'ASC', null, null, $where);
            $this->defineView('informe', 'ambienteInsumo', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('ambienteInsumo', 'index');
        }
    }

    private function filters() {
        $where = array();

        if (
                request::getInstance()->hasPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::AMBIENTE_ID, true))
                and
                request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::AMBIENTE_ID, true)) !== ''
        ) {
            $where[ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::AMBIENTE_ID)] = request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::AMBIENTE_ID, true));
        }
        if (
                request::getInstance()->hasPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID, true))
                and
                request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID, true)) !== ''
        ) {
            $where[ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID)] = request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID, true));
        }
        if (
                (
                request::getInstance()->hasPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) . '_ini')
                and
                request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) . '_ini') !== ''
                )
                and (
                request::getInstance()->hasPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) . '_fin')
                and
                request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) . '_fin') !== ''
                )
        ) {
            $where[ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION)] = array(
                request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) . '_ini'),
                request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true) . '_fin'),
            );
        }
        if (
                (
                request::getInstance()->hasPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) . '_ini')
                and
                request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) . '_ini') !== ''
                )
                and (
                request::getInstance()->hasPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) . '_fin')
                and
                request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) . '_fin') !== ''
                )
        ) {
            $where[ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO)] = array(
                request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) . '_ini'),
                request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true) . '_fin'),
            );
        }

        return $where;
    }

}

