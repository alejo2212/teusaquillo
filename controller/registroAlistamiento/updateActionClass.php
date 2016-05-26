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
        
        $id = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::ID, true));
        $empleado = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::EMPLEADO_ID, true));
        $salidaid = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID, true));
        $fecha_ini = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true));
        $fecha_fin = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true));
        $lote = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::LOTE_ID, true));
        $fecha_ini_cortina = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true));
        $fecha_fin_cortina = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true));
        $fecha_ini_cama = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true));
        $fecha_fin_cama = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true));
        $fecha_equipo = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true));
        
        $ids = array(
            registroAlistamientoTableClass::ID => $id
        );
        
        $data = array(
            registroAlistamientoTableClass::EMPLEADO_ID => $empleado,
            registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID => $salidaid,
            registroAlistamientoTableClass::FECHA_INICIO => $fecha_ini,
            registroAlistamientoTableClass::FECHA_FIN => $fecha_fin,
            registroAlistamientoTableClass::LOTE_ID => $lote,
            registroAlistamientoTableClass::FECHA_INICIO_CORTINA => $fecha_ini_cortina,
            registroAlistamientoTableClass::FECHA_FIN_CORTINA => $fecha_fin_cortina,
            registroAlistamientoTableClass::FECHA_ENTRADA_CAMA => $fecha_ini_cama,
            registroAlistamientoTableClass::FECHA_TERMINO_CAMA => $fecha_fin_cama,
            registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO => $fecha_equipo
        );
        registroAlistamientoTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Actualización exitosa');
        
        routing::getInstance()->redirect('registroAlistamiento', 'index');
      } else {
        routing::getInstance()->redirect('registroAlistamiento', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('registroAlistamiento', 'index');
    }
  }

}
