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
                registroDesinfeccionTableClass::ID,
                registroDesinfeccionTableClass::FECHA_REALIZACION,
                registroDesinfeccionTableClass::FECHA_TERMINADO,
                registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE,
                registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR,
                registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID,
                registroDesinfeccionTableClass::SOLUCION,
                registroDesinfeccionTableClass::OBSERVACION,
                registroDesinfeccionTableClass::TIPO_DESINFECCION_ID,
                registroDesinfeccionTableClass::DELETED_AT,
                registroDesinfeccionTableClass::CANT_PEDILUVIOS,
                registroDesinfeccionTableClass::DES_BODEGA,
                registroDesinfeccionTableClass::DES_PEDILUVIOS,
                registroDesinfeccionTableClass::DES_RAMDAS
            );

            $where = $this->filters();
//
            $this->objregistroDesinfeccion = registroDesinfeccionTableClass::getAll($fields, true, array(registroDesinfeccionTableClass::FECHA_REALIZACION), 'DESC', null, null, $where);
            $this->defineView('informe', 'registroDesinfeccion', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('registroDesinfeccion', 'index');
        }
    }

    private function filters() {
        $where = array();

        if (
                (
                request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) . '_ini')
                and
                request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) . '_ini') !== ''
                )
                and (
                request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) . '_fin')
                and
                request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) . '_fin') !== ''
                )
        ) {
            $where[registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION)] = array(
                request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) . '_ini'),
                request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) . '_fin'),
            );
        }

        if (
                (
                request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) . '_ini')
                and
                request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) . '_ini') !== ''
                )
                and (
                request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) . '_fin')
                and
                request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) . '_fin') !== ''
                )
        ) {
            $where[registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO)] = array(
                request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) . '_ini'),
                request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) . '_fin'),
            );
        }

        if (
                request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE, true))
                and
                request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE, true)) !== ''
        ) {
            $where[registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE)] = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE, true));
        }


        if (
                request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR, true))
                and
                request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR, true)) !== ''
        ) {
            $where[registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR)] = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR, true));
        }

        if (
                request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID, true))
                and
                request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID, true)) !== ''
        ) {
            $where[registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID)] = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID, true));
        }

        if (
                request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SOLUCION, true))
                and
                request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SOLUCION, true)) !== ''
        ) {
            $where[registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SOLUCION)] = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SOLUCION, true));
        }

        if (
                request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::TIPO_DESINFECCION_ID, true))
                and
                request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::TIPO_DESINFECCION_ID, true)) !== ''
        ) {
            $where[registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::TIPO_DESINFECCION_ID)] = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::TIPO_DESINFECCION_ID, true));
        }

        return $where;
    }

}
