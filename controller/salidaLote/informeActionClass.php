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
                salidaLoteTableClass::ID,
                salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID,
                salidaLoteTableClass::RAZON_SALIDA_ID,
                salidaLoteTableClass::CANTIDAD_TOTAL,
                salidaLoteTableClass::CANTIDAD_MACHOS,
                salidaLoteTableClass::CANTIDAD_HEMBRAS,
                salidaLoteTableClass::EMPLEADO_ID,
                salidaLoteTableClass::DELETED_AT
            );

            $where = $this->filters();
//
            $this->objSalidalote = salidaLoteTableClass::getAll($fields, true, array(salidaLoteTableClass::ID), 'ASC', null, null, $where);
            $this->defineView('informe', 'salidaLote', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('salidaLote', 'index');
        }
    }

    private function filters() {
        $where = array();

        if (
                request::getInstance()->hasPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true))
                and
                request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true)) !== ''
        ) {
          $where[salidaLoteTableClass::getNameField(salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID)] = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true));
        }
        if (
                request::getInstance()->hasPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::RAZON_SALIDA_ID, true))
                and
                request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::RAZON_SALIDA_ID, true)) !== ''
        ) {
          $where[salidaLoteTableClass::getNameField(salidaLoteTableClass::RAZON_SALIDA_ID)] = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::RAZON_SALIDA_ID, true));
        }
        if (
                request::getInstance()->hasPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_TOTAL, true))
                and
                request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_TOTAL, true)) !== ''
        ) {
          $where[salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_TOTAL)] = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_TOTAL, true));
        }
        if (
                request::getInstance()->hasPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_MACHOS, true))
                and
                request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_MACHOS, true)) !== ''
        ) {
          $where[salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_MACHOS)] = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_MACHOS, true));
        }
         if (
                request::getInstance()->hasPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_HEMBRAS, true))
                and
                request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_HEMBRAS, true)) !== ''
        ) {
          $where[salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_HEMBRAS)] = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_HEMBRAS, true));
        }
         if (
                request::getInstance()->hasPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::EMPLEADO_ID, true))
                and
                request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::EMPLEADO_ID, true)) !== ''
        ) {
          $where[salidaLoteTableClass::getNameField(salidaLoteTableClass::EMPLEADO_ID)] = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::EMPLEADO_ID, true));
        }
        

//        if (
//                (
//                request::getInstance()->hasPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_ini')
//                and
//                request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_ini') !== ''
//                )
//                and (
//                request::getInstance()->hasPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_fin')
//                and
//                request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_fin') !== ''
//                )
//        ) {
//            $where[usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT)] = array(
//                request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_ini'),
//                request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_fin'),
//            );
//        }


        return $where;
    }

}