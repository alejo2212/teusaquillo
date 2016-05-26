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
                 controlCucarronTableClass::ID,
                controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR,
                controlCucarronTableClass::EMPLEADO_ID_VETERINARIO,
                controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE,
                controlCucarronTableClass::FECHA_REALIZACION,
                controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID,
                controlCucarronTableClass::SOLUCION,
                controlCucarronTableClass::FORMA_APLICACION_ID,
                controlCucarronTableClass::AREA_TRATADA,
                controlCucarronTableClass::OBSERVACION,
                controlCucarronTableClass::DELETED_AT,
            );

            $where = $this->filters();
//
            $this->objcontrolCucarron = controlCucarronTableClass::getAll($fields, true, array(controlCucarronTableClass::ID), 'ASC', null, null, $where);
            $this->defineView('informe', 'controlCucarron', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('controlCucarron', 'index');
        }
    }

    private function filters() {
        $where = array();

         if (
                request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR, true))
                and
                request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR, true)) !== ''
        ) {
            $where[controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR)] = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR, true));
        }
        
        if (
                request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_VETERINARIO, true))
                and
                request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_VETERINARIO, true)) !== ''
        ) {
            $where[controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_VETERINARIO)] = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_VETERINARIO, true));
        }
        
        if (
                request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE, true))
                and
                request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE, true)) !== ''
        ) {
            $where[controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE)] = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE, true));
        }
      if (
                (
                request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) . '_ini')
                and
                request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) . '_ini') !== ''
                )
                and (
                request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) . '_fin')
                and
                request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) . '_fin') !== ''
                )
        ) {
            $where[controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION)] = array(
                request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) . '_ini'),
                request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) . '_fin'),
            );
        }
        
        if (
                request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID, true))
                and
                request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID, true)) !== ''
        ) {
            $where[controlCucarronTableClass::getNameField(controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID)] = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID, true));
        }
        
        if (
                request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::SOLUCION, true))
                and
                request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::SOLUCION, true)) !== ''
        ) {
            $where[controlCucarronTableClass::getNameField(controlCucarronTableClass::SOLUCION)] = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::SOLUCION, true));
        }
        
        if (
                request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FORMA_APLICACION_ID, true))
                and
                request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FORMA_APLICACION_ID, true)) !== ''
        ) {
            $where[controlCucarronTableClass::getNameField(controlCucarronTableClass::FORMA_APLICACION_ID)] = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FORMA_APLICACION_ID, true));
        }
        
        if (
                request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::AREA_TRATADA, true))
                and
                request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::AREA_TRATADA, true)) !== ''
        ) {
            $where[controlCucarronTableClass::getNameField(controlCucarronTableClass::AREA_TRATADA)] = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::AREA_TRATADA, true));
        }
        
        return $where;
        
    }

}
