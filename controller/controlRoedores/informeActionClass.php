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
                controlRoedoresTableClass::ID,
                controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR,
                controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO,
                controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE,
                controlRoedoresTableClass::FECHA_REALIZACION,
                controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID,
                controlRoedoresTableClass::PELLETS,
                controlRoedoresTableClass::BLOQUES,
                controlRoedoresTableClass::EVIDENCIA_CONSUMO,
                controlRoedoresTableClass::LUGAR,
                controlRoedoresTableClass::OBSERVACION,
                controlRoedoresTableClass::DELETED_AT,
            );

            $where = $this->filters();
//
            $this->objcontrolRoedores = controlRoedoresTableClass::getAll($fields, true, array(controlRoedoresTableClass::ID), 'ASC', null, null, $where);
            $this->defineView('informe', 'controlRoedores', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('controlRoedores', 'index');
        }
    }

     private function filters() {
        $where = array();

        if (
                request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR, true))
                and
                request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR, true)) !== ''
        ) {
            $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR, true));
        }

        if (
                request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO, true))
                and
                request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO, true)) !== ''
        ) {
            $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO, true));
        }

        if (
                request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE, true))
                and
                request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE, true)) !== ''
        ) {
            $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE, true));
        }


        if (
                request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true))
                and
                request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true)) !== ''
        ) {
            $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true));
        }

        if (
                request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID, true))
                and
                request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID, true)) !== ''
        ) {
            $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID, true));
        }

        if (
                request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::PELLETS, true))
                and
                request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::PELLETS, true)) !== ''
        ) {
            $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::PELLETS)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::PELLETS, true));
        }

        if (
                request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::BLOQUES, true))
                and
                request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::BLOQUES, true)) !== ''
        ) {
            $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::BLOQUES)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::BLOQUES, true));
        }

        if (
                request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EVIDENCIA_CONSUMO, true))
                and
                request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EVIDENCIA_CONSUMO, true)) !== ''
        ) {
            $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EVIDENCIA_CONSUMO)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EVIDENCIA_CONSUMO, true));
        }

        if (
                request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::LUGAR, true))
                and
                request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::LUGAR, true)) !== ''
        ) {
            $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::LUGAR)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::LUGAR, true));
        }
        if (
                (
                request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) . '_ini')
                and
                request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) . '_ini') !== ''
                )
                and (
                request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) . '_fin')
                and
                request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) . '_fin') !== ''
                )
        ) {
            $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION)] = array(
                request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) . '_ini'),
                request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) . '_fin'),
            );
        }

        return $where;
    }

}
