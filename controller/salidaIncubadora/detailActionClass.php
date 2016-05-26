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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class detailActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasRequest('id')) {
        $this->idSalida = $id = request::getInstance()->getRequest('id');
        $fields = array(
            salidaDetalleIncubadoraTableClass::ID,
            salidaDetalleIncubadoraTableClass::CANTIDAD,
            salidaDetalleIncubadoraTableClass::SALIDA_INCUBADORA_ID,
            salidaDetalleIncubadoraTableClass::INCUBADORA_ID,
            salidaDetalleIncubadoraTableClass::DESCRIPCION,
            salidaDetalleIncubadoraTableClass::TIPO_EMPAQUE_ID,
            salidaDetalleIncubadoraTableClass::CANTIDAD_EMPAQUE
        );

        $this->page = 0;

        if (request::getInstance()->hasGet('page')) {
          $this->page = (request::getInstance()->getGet('page') - 1);
        }

        $this->countPages = salidaDetalleIncubadoraTableClass::getCountPages($id);
        $fieldsT = array(
            tipoEmpaqueTableClass::ID,
            tipoEmpaqueTableClass::NOMBRE
        );
        
        $this->objEmpaque = empleadoTableClass::getAll($fieldsT, true, array(tipoEmpaqueTableClass::NOMBRE), 'ASC');
        
        $where = array(
            salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::SALIDA_INCUBADORA_ID) => $id
        );

        $this->objDetalleSalida = salidaDetalleIncubadoraTableClass::getAll($fields, true, array(salidaDetalleIncubadoraTableClass::SALIDA_INCUBADORA_ID), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
        $this->defineView('index', 'salidaDetalleIncubadora', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('salidaIncubadora', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('salidaIncubadora', 'index');
    }
  }

}
