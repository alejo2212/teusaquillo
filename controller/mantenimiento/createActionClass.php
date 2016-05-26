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

        $maquinaid = request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::MAQUINA_ID, true));
        $empleadoid = request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::EMPLEADO_ID, true));
        $tipoMante = request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::TIPO_MANTENIMIENTO_ID, true));
        $fechaIni = request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_INICIO, true));
        $fechaFin = request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_FIN, true));
        $causa = request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::CAUSA, true));
        $arreglo = request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::ARREGLO, true));
        $observacion = request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::OBSERVACION, true));
        
//        exit();
        $post = array(
            mantenimientoTableClass::MAQUINA_ID => $maquinaid,
            mantenimientoTableClass::EMPLEADO_ID => $empleadoid,
            mantenimientoTableClass::TIPO_MANTENIMIENTO_ID => $tipoMante,
            mantenimientoTableClass::FECHA_INICIO => $fechaIni,
            mantenimientoTableClass::FECHA_FIN => $fechaFin,
            mantenimientoTableClass::CAUSA => $causa,
            mantenimientoTableClass::ARREGLO => $arreglo,
            mantenimientoTableClass::OBSERVACION => $observacion
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        $this->Validations($maquinaid,$empleadoid,$tipoMante,$fechaIni,$fechaFin,$causa,$arreglo,$observacion);
        /* ------------- */

        session::getInstance()->setAttribute(mantenimientoTableClass::getNameField(mantenimientoTableClass::MAQUINA_ID, true), $maquinaid);
        
        $data = array(
            mantenimientoTableClass::MAQUINA_ID => $maquinaid,
            mantenimientoTableClass::EMPLEADO_ID => $empleadoid,
            mantenimientoTableClass::TIPO_MANTENIMIENTO_ID => $tipoMante,
            mantenimientoTableClass::FECHA_INICIO => $fechaIni
        );
        if($fechaFin != '') {
            $data[mantenimientoTableClass::FECHA_FIN] = $fechaFin;
        }
        if($causa != '') {
            $data[mantenimientoTableClass::CAUSA] = $causa;
        }
        if($arreglo != '') {
            $data[mantenimientoTableClass::ARREGLO] = $arreglo;
        }
        if($observacion != '') {
            $data[mantenimientoTableClass::OBSERVACION] = $observacion;
        }
        mantenimientoTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');
        $idMante = mantenimientoTableClass::getIdMantenimiento();
        
        routing::getInstance()->redirect('detalleMantenimiento', 'new', array(mantenimientoTableClass::ID => $idMante));
      } else {
        routing::getInstance()->redirect('mantenimiento', 'index');
      }
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El Mantenimiento que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('mantenimiento', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }
  
  public function Validations($maquinaid,$empleadoid,$tipoMante,$fechaIni,$fechaFin,$causa,$arreglo,$observacion) {
    
    if (!is_numeric($maquinaid)|| $maquinaid === "") {
      throw new PDOException('Seleccione una Maquina o Equipo Valido', 00010);
    }
    if (!is_numeric($empleadoid)|| $empleadoid === "") {
      throw new PDOException('Seleccione un Empleado Valida', 00010);
    }
    if (!is_numeric($tipoMante)|| $tipoMante === "") {
      throw new PDOException('Seleccione un Tipo de Mantenimiento Valida', 00010);
    }
    if (strlen($causa) > mantenimientoTableClass::CAUSA_LENGTH) {
      throw new PDOException('La Causa no pude ser mayor a ' . mantenimientoTableClass::CAUSA_LENGTH . ' caracteres', 00006);
    }
    if (strlen($arreglo) > mantenimientoTableClass::ARREGLO_LENGTH) {
      throw new PDOException('El Arreglo no pude ser mayor a ' . mantenimientoTableClass::ARREGLO_LENGTH . ' caracteres', 00006);
    }
    if (strlen($observacion) > mantenimientoTableClass::OBSERVACION_LENGTH) {
      throw new PDOException('La Observacion no pude ser mayor a ' . mantenimientoTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
    }
    if (strtotime($fechaIni) > strtotime(date('Y-m-d H:i:s'))) {
      throw new PDOException('La Fecha de Inicio del Mantenimiento no puede ser Mayor a la del Sistema');
    }
    if (strtotime($fechaFin) <= strtotime($fechaIni)) {
      throw new PDOException('La Fecha de Fin del Mantenimiento no puede ser Menor o igual a la Fecha de Inicio');
    }
  }


}
