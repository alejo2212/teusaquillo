<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class detailActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
          session::getInstance()->deleteAttribute('form');
            if (request::getInstance()->hasRequest('id')) {
                $this->id = $id = request::getInstance()->getRequest('id');
                $fields = array(
                    salidaInsumoDetalleTableClass::ID,
                    salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID,
                    salidaInsumoDetalleTableClass::BODEGA_ID,
                    salidaInsumoDetalleTableClass::CANTIDAD,
                    salidaInsumoDetalleTableClass::OBSERVACION,
                    salidaInsumoDetalleTableClass::INSUMO_ID,
                    salidaInsumoDetalleTableClass::ANULADO,
                    salidaInsumoDetalleTableClass::DELETED_AT
                );
                $this->page = 0;


                if (request::getInstance()->hasGet('page')) {
                    $this->page = (request::getInstance()->getGet('page') - 1);
                }

                $this->countPages = salidaInsumoDetalleTableClass::getCountPages();

                $where = array(
                    salidaInsumoDetalleTableClass::getNameField(salidaInsumoDetalleTableClass::SALIDA_INSUMO_ID) => $id
                );


                $this->objSalidainsumoDetalle = salidaInsumoDetalleTableClass::getAll($fields, true, array(salidaInsumoDetalleTableClass::ID), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
                $this->defineView('index', 'salidaInsumoDetalle', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('salidaInsumo', 'index');
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
//            session::getInstance()->setError($exc->getMessage());
//            routing::getInstance()->redirect('salidaInsumo', 'index');
        }
    }

}
