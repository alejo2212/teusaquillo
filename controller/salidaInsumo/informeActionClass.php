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
                salidaInsumoTableClass::ID,
                salidaInsumoTableClass::EMPLEADO_ID_SALIDA,
                salidaInsumoTableClass::EMPLEADO_ID_RECEPCION,
                salidaInsumoTableClass::FECHA,
                salidaInsumoTableClass::OBSERVACION,
                salidaInsumoTableClass::ANULADO,
                salidaInsumoTableClass::REQUISICION_ID,
                salidaInsumoTableClass::DELETED_AT
            );

            $where = $this->filters();
//
            $this->objSalidainsumo = salidaInsumoTableClass::getAll($fields, true, array(salidaInsumoTableClass::ID), 'ASC', null, null, $where);
            $this->defineView('informe', 'salidaInsumo', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('salidaInsumo', 'index');
        }
    }

    private function filters() {
        $where = array();

        if (
                request::getInstance()->hasPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_SALIDA, true))
                and
                request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_SALIDA, true)) !== ''
        ) {
            $where[salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_SALIDA)] = request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_SALIDA, true));
        }
        if (
                request::getInstance()->hasPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_RECEPCION, true))
                and
                request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_RECEPCION, true)) !== ''
        ) {
            $where[salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_RECEPCION)] = request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_RECEPCION, true));
        }
        if (
                request::getInstance()->hasPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::REQUISICION_ID, true))
                and
                request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::REQUISICION_ID, true)) !== ''
        ) {
            $where[salidaInsumoTableClass::getNameField(salidaInsumoTableClass::REQUISICION_ID)] = request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::REQUISICION_ID, true));
        }
        if (
                (
                request::getInstance()->hasPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) . '_ini')
                and
                request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) . '_ini') !== ''
                )
                and (
                request::getInstance()->hasPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) . '_fin')
                and
                request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) . '_fin') !== ''
                )
        ) {
            $where[salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA)] = array(
                request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) . '_ini'),
                request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true) . '_fin'),
            );
        }


        return $where;
    }

}
