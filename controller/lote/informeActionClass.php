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
                loteTableClass::ID,
                loteTableClass::LOTE,
                loteTableClass::FECHA_ENTRADA_GRANJA,
                loteTableClass::FECHA_SALIDA_ESTIPULADA,
                loteTableClass::FECHA_SALIDA_REAL,
                loteTableClass::RAZA_ID,
                loteTableClass::PESO_PROMEDIO_MACHOS,
                loteTableClass::PESO_PROMEDIO_HEMBRAS,
                loteTableClass::CANTIDAD_MACHOS,
                loteTableClass::CANTIDAD_HEMBRAS,
                loteTableClass::CANTIDAD_TOTAL,
                loteTableClass::FECHA_ENTRA_PRODUCCION,
                loteTableClass::OBSERVACION,
                loteTableClass::EMPLEADO_ID,
                loteTableClass::DELETED_AT
            );
            $where = $this->filters();
//
            $this->objLote = loteTableClass::getAll($fields, true, array(loteTableClass::LOTE), 'ASC', null, null, $where);
            $this->defineView('informe', 'lote', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('lote', 'index');
        }
    }

    private function filters() {
        $where = array();

        if (
                request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::LOTE, true))
                and
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::LOTE, true)) !== ''
        ) {
            $where[loteTableClass::getNameField(loteTableClass::LOTE)] = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::LOTE, true));
        }

        if (
                request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::RAZA_ID, true))
                and
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::RAZA_ID, true)) !== ''
        ) {
            $where[loteTableClass::getNameField(loteTableClass::RAZA_ID)] = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::RAZA_ID, true));
        }
        if (
                request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::EMPLEADO_ID, true))
                and
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::EMPLEADO_ID, true)) !== ''
        ) {
            $where[loteTableClass::getNameField(loteTableClass::EMPLEADO_ID)] = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::EMPLEADO_ID, true));
        }
        if (
                request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::CANTIDAD_TOTAL, true))
                and
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::CANTIDAD_TOTAL, true)) !== ''
        ) {
            $where[loteTableClass::getNameField(loteTableClass::CANTIDAD_TOTAL)] = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::CANTIDAD_TOTAL, true));
        }
        if (
                (
                request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) . '_ini')
                and
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) . '_ini') !== ''
                )
                and (
                request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) . '_fin')
                and
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) . '_fin') !== ''
                )
        ) {
            $where[loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA)] = array(
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) . '_ini'),
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true) . '_fin'),
            );
        }


        if (
                (
                request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) . '_ini')
                and
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) . '_ini') !== ''
                )
                and (
                request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) . '_fin')
                and
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) . '_fin') !== ''
                )
        ) {
            $where[loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL)] = array(
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) . '_ini'),
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true) . '_fin'),
            );
        }

        if (
                (
                request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) . '_ini')
                and
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) . '_ini') !== ''
                )
                and (
                request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) . '_fin')
                and
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) . '_fin') !== ''
                )
        ) {
            $where[loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION)] = array(
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) . '_ini'),
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true) . '_fin'),
            );
        }

        if (
                (
                request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) . '_ini')
                and
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) . '_ini') !== ''
                )
                and (
                request::getInstance()->hasPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) . '_fin')
                and
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) . '_fin') !== ''
                )
        ) {
            $where[loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA)] = array(
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) . '_ini'),
                request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true) . '_fin'),
            );
        }

        return $where;
    }

}
