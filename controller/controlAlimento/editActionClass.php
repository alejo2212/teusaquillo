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
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet('id')) {
        $id = request::getInstance()->getGet('id');
        $this->objControlAlimento = controlAlimentoTableClass::getDataControlAlimento($id);
        $this->edit = true;
        $fieldsEmple = array(
        empleadoTableClass::ID,
        empleadoTableClass::NOMBRE
     );
    $fieldsAmbiente = array(
        ambienteHistorialLoteTableClass::ID,
        ambienteHistorialLoteTableClass::AMBIENTE_ID,
        ambienteHistorialLoteTableClass::LOTE_ID,
        ambienteHistorialLoteTableClass::NO_CASETA,
        ambienteHistorialLoteTableClass::CANTIDAD_HEMBRAS,
        ambienteHistorialLoteTableClass::CANTIDAD_MACHOS
     );
    $this->objEmpleado = empleadoTableClass::getAll($fieldsEmple, true, array(empleadoTableClass::NOMBRE), 'ASC');
    $this->objAmbienteHistorial = ambienteHistorialLoteTableClass::getAmbienteHistLote();
        $this->defineView('edit', 'controlAlimento', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('controlAlimento', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('controlAlimento', 'index');
    }
  }

}
