<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of indexActionClass
 *
 * @author Jhonny Alejandro Diaz <Jhonny2212@hotmail.com>
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

//        $id = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::ID, true));
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
        
//        exit();
        $post = array(
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
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        $this->Validations($empleado,$salidaid,$fecha_ini,$fecha_fin,$lote,$fecha_ini_cortina,$fecha_fin_cortina,$fecha_ini_cama,$fecha_fin_cama,$fecha_equipo);
        /* ------------- */

//        session::getInstance()->setAttribute(cargoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true), $documento);
        
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
        registroAlistamientoTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');
        
        routing::getInstance()->redirect('registroAlistamiento', 'index');
      } else {
        routing::getInstance()->redirect('registroAlistamiento', 'index');
      }
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El registro de Alistamiento que intenta registar ya existe en la base de datos');
          break;
        case 00006:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case 00007:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case 00008:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case 00009:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case 00010:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('registroAlistamiento', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }
  
  public function Validations($empleado,$salidaid,$fecha_ini,$fecha_fin,$lote,$fecha_ini_cortina,$fecha_fin_cortina,$fecha_ini_cama,$fecha_fin_cama,$fecha_equipo){
    if (!is_numeric($empleado)|| $empleado === "") {
      throw new PDOException('Seleccione un Empleado Valida', 00010);
    }
    if (!is_numeric($salidaid)|| $salidaid === "") {
      throw new PDOException('Ingrese un numero de salida Valida', 00010);
    }
    if (!is_numeric($lote)|| $lote === "") {
      throw new PDOException('Seleccione un Lote Valido', 00010);
    }
    if (strtotime($fecha_ini) > strtotime(date('Y-m-d H:i:s'))) {
      throw new PDOException('La Fecha no puede er Mayor a la del Sistema', 00009);
    }
    if (strtotime($fecha_ini) > strtotime($fecha_fin)) {
      throw new PDOException('La Fecha de inicio no puede er Mayor a la Fecha de finalizacion', 00009);
    }
    if (strtotime($fecha_ini_cortina) > strtotime(date('Y-m-d H:i:s'))) {
      throw new PDOException('La Fecha de inicio de cortina no puede er Mayor a la del Sistema', 00009);
    }
    if (strtotime($fecha_ini_cortina) > strtotime($fecha_fin_cortina)) {
      throw new PDOException('La Fecha de inicio de cortina no puede er Mayor a la Fecha de finalizacion de cortina', 00009);
    }
    if (strtotime($fecha_ini_cama) > strtotime(date('Y-m-d H:i:s'))) {
      throw new PDOException('La Fecha de inicio de cama no puede er Mayor a la del Sistema', 00009);
    }
    if (strtotime($fecha_ini_cama) > strtotime($fecha_fin_cama)) {
      throw new PDOException('La Fecha de inicio de cama no puede er Mayor a la Fecha de finalizacion de cama', 00009);
    }
    if (strtotime($fecha_ini) > strtotime($fecha_equipo)) {
      throw new PDOException('La Fecha de inicio no puede er Mayor a la Fecha de entrada del equipo', 00009);
    }
    if (strtotime($fecha_ini) > strtotime($fecha_ini_cortina)) {
      throw new PDOException('La Fecha de inicio no puede er Mayor a la Fecha de inicio de cortina', 00009);
    }
    if (strtotime($fecha_ini) > strtotime($fecha_ini_cama)) {
      throw new PDOException('La Fecha de inicio no puede er Mayor a la Fecha de inicio de cama', 00009);
    }
  }

}
