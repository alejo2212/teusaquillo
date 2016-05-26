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
                insumoTableClass::ID,
                insumoTableClass::ACTIVO,
                insumoTableClass::DELETED_AT,
                insumoTableClass::NOMBRE,
                insumoTableClass::TIPO_INSUMO_ID,
                insumoTableClass::PRESENTACION_ID,
                insumoTableClass::UNIDAD_MEDIDA_ID,
                insumoTableClass::INVENTARIO_BODEGA
            );

            $where = $this->filters();
//
            $this->objinsumo = insumoTableClass::getAll($fields, true, array(insumoTableClass::NOMBRE), 'ASC', null, null, $where);
            $this->defineView('informe', 'insumo', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('insumo', 'index');
        }
    }

    private function filters() {
        $where = array();
         if (
                request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true))
                and
                request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true)) !== ''
        ) {
            $where[insumoTableClass::getNameField(insumoTableClass::NOMBRE)] = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true));
        }
        if (
                request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::INVENTARIO_BODEGA, true))
                and
                request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::INVENTARIO_BODEGA, true)) !== ''
        ) {
            $where[insumoTableClass::getNameField(insumoTableClass::INVENTARIO_BODEGA)] = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::INVENTARIO_BODEGA, true));
        }
        if (
                request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, true))
                and
                request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, true)) !== ''
        ) {
            $where[insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID)] = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, true));
        }

        if (
                request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::PRESENTACION_ID, true))
                and
                request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::PRESENTACION_ID, true)) !== ''
        ) {
            $where[insumoTableClass::getNameField(insumoTableClass::PRESENTACION_ID)] = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::PRESENTACION_ID, true));
        }
        if (
                request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::UNIDAD_MEDIDA_ID, true))
                and
                request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::UNIDAD_MEDIDA_ID, true)) !== ''
        ) {
            $where[insumoTableClass::getNameField(insumoTableClass::UNIDAD_MEDIDA_ID)] = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::UNIDAD_MEDIDA_ID, true));
        }
        return $where;
    }

}
