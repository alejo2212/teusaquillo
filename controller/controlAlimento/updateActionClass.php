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
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
      if (request::getInstance()->isMethod('POST')) {
        
        $id = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID, true));
        $ambHistoLote = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true));
        $salidaDetalle = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SALIDA_INSUMO_DETALLE_ID, true));
        $emple = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID_EMPLEADO, true));
        $sexo = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEXO, true));
        $cantidad = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::CANTIDAD, true));
        $fecha = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA, true));
        $semana = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEMANA, true));
        $observacion = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::OBSERVACION, true));
        
        $ids = array(
            controlAlimentoTableClass::ID => $id
        );
        
        $data = array(
            controlAlimentoTableClass::AMBIENTE_HISTORIAL_LOTE_ID => $ambHistoLote,
            controlAlimentoTableClass::SALIDA_INSUMO_DETALLE_ID => $salidaDetalle,
            controlAlimentoTableClass::ID_EMPLEADO => $emple,
            controlAlimentoTableClass::SEXO => $sexo,
            controlAlimentoTableClass::CANTIDAD => $cantidad,
            controlAlimentoTableClass::FECHA => $fecha,
            controlAlimentoTableClass::SEMANA => $semana,
            controlAlimentoTableClass::OBSERVACION => $observacion
        );
        controlAlimentoTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Actualización exitosa');
        
        routing::getInstance()->redirect('controlAlimento', 'index');
      } else {
        routing::getInstance()->redirect('controlAlimento', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('controlAlimento', 'index');
    }
  }

}
