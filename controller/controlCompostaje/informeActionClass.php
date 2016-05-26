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
                controlCompostajeTableClass::ID,
                controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR,
                controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO,
                controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE,
                controlCompostajeTableClass::FECHA_REALIZACION,
                controlCompostajeTableClass::CAJON_COMPOSTAJE_ID,
                controlCompostajeTableClass::GALLINAZA_UTILIZADA,
                controlCompostajeTableClass::CANTIDAD_TOTAL_AVES,
                controlCompostajeTableClass::CANTIDAD_MACHOS,
                controlCompostajeTableClass::CANTIDAD_HEMBRAS,
                controlCompostajeTableClass::SALIDA_LOTE_ID,
                controlCompostajeTableClass::OBSERVACION,
                controlCompostajeTableClass::DELETED_AT,
            );

            $where = $this->filters();
//
            $this->objcontrolCompostaje = controlCompostajeTableClass::getAll($fields, true, array(controlCompostajeTableClass::ID), 'ASC', null, null, $where);
            $this->defineView('informe', 'controlCompostaje', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('controlCompostaje', 'index');
        }
    }

    private function filters() {
        $where = array();

        if (
                request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR, true))
                and
                request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR, true)) !== ''
        ) {
            $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR, true));
        }

        if (
                request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO, true))
                and
                request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO, true)) !== ''
        ) {
            $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO, true));
        }

        if (
                request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE, true))
                and
                request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE, true)) !== ''
        ) {
            $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE, true));
        }
        if (
                (
                request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) . '_ini')
                and
                request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) . '_ini') !== ''
                )
                and (
                request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) . '_fin')
                and
                request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) . '_fin') !== ''
                )
        ) {
            $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION)] = array(
                request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) . '_ini'),
                request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) . '_fin'),
            );
        }

        if (
                request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CAJON_COMPOSTAJE_ID, true))
                and
                request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CAJON_COMPOSTAJE_ID, true)) !== ''
        ) {
            $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CAJON_COMPOSTAJE_ID)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CAJON_COMPOSTAJE_ID, true));
        }

        if (
                request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::GALLINAZA_UTILIZADA, true))
                and
                request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::GALLINAZA_UTILIZADA, true)) !== ''
        ) {
            $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::GALLINAZA_UTILIZADA)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::GALLINAZA_UTILIZADA, true));
        }
        if (
                request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_TOTAL_AVES, true))
                and
                request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_TOTAL_AVES, true)) !== ''
        ) {
            $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_TOTAL_AVES)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_TOTAL_AVES, true));
        }
        if (
                request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_MACHOS, true))
                and
                request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_MACHOS, true)) !== ''
        ) {
            $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_MACHOS)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_MACHOS, true));
        }
        if (
                request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_HEMBRAS, true))
                and
                request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_HEMBRAS, true)) !== ''
        ) {
            $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_HEMBRAS)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_HEMBRAS, true));
        }
        if (
                request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::SALIDA_LOTE_ID, true))
                and
                request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::SALIDA_LOTE_ID, true)) !== ''
        ) {
            $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::SALIDA_LOTE_ID)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::SALIDA_LOTE_ID, true));
        }

        return $where;
    }

}
