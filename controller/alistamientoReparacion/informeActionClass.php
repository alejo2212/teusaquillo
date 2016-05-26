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
                alistamientoReparacionTableClass::ID,
                alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID,
                alistamientoReparacionTableClass::TIPO_REPARACION_ID,
                alistamientoReparacionTableClass::FECHA_INICIO,
                alistamientoReparacionTableClass::FECHA_FIN,
            );

            $where = $this->filters();
//
            $this->objalistamientoReparacion = alistamientoReparacionTableClass::getAll($fields, true, array(alistamientoReparacionTableClass::ID), 'ASC', null, null, $where);
            $this->defineView('informe', 'alistamientoReparacion', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('alistamientoReparacion', 'index');
        }
    }

    private function filters() {
        $where = array();

        if (
                request::getInstance()->hasPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID, true))
                and
                request::getInstance()->getPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID, true)) !== ''
        ) {
            $where[alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID)] = request::getInstance()->getPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID, true));
        }
        if (
                request::getInstance()->hasPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::TIPO_REPARACION_ID, true))
                and
                request::getInstance()->getPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::TIPO_REPARACION_ID, true)) !== ''
        ) {
            $where[alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::TIPO_REPARACION_ID)] = request::getInstance()->getPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::TIPO_REPARACION_ID, true));
        }

        if (
                request::getInstance()->hasPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_INICIO, true))
                and
                request::getInstance()->getPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_INICIO, true)) !== ''
        ) {
            $where[alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_INICIO)] = request::getInstance()->getPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_INICIO, true));
        }

        return $where;
    }

}
