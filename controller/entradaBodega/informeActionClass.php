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
                entradaBodegaTableClass::ID,
                entradaBodegaTableClass::EMPLEADO_ID,
                entradaBodegaTableClass::TRANSPORTADOR_ID,
                entradaBodegaTableClass::FECHA_ENTRADA,
                entradaBodegaTableClass::REMISION,
                entradaBodegaTableClass::OBSERVACION,
            );

            $where = $this->filters();
//
            $this->objentradaBodega = entradaBodegaTableClass::getAll($fields, true, array(entradaBodegaTableClass::ID), 'ASC', null, null, $where);
            $this->defineView('informe', 'entradaBodega', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('entradaBodega', 'index');
        }
    }

    private function filters() {
        $where = array();

        if (
                request::getInstance()->hasPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::REMISION, true))
                and
                request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::REMISION, true)) !== ''
        ) {
            $where[entradaBodegaTableClass::getNameField(entradaBodegaTableClass::REMISION)] = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::REMISION, true));
        }
        if (
                request::getInstance()->hasPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::EMPLEADO_ID, true))
                and
                request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::EMPLEADO_ID, true)) !== ''
        ) {
            $where[entradaBodegaTableClass::getNameField(entradaBodegaTableClass::EMPLEADO_ID)] = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::EMPLEADO_ID, true));
        }

        if (
                request::getInstance()->hasPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::TRANSPORTADOR_ID, true))
                and
                request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::TRANSPORTADOR_ID, true)) !== ''
        ) {
            $where[entradaBodegaTableClass::getNameField(entradaBodegaTableClass::TRANSPORTADOR_ID)] = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::TRANSPORTADOR_ID, true));
        }

        return $where;
    }

}
