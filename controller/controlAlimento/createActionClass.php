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

        $ambHistoLote = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true));
        $salidaDetalle = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SALIDA_INSUMO_DETALLE_ID, true));
        $emple = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID_EMPLEADO, true));
        $sexo = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEXO, true));
        $cantidad = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::CANTIDAD, true));
        $fecha = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA, true));
        $semana = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEMANA, true));
        $observacion = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::OBSERVACION, true));

        $post = array(
            controlAlimentoTableClass::AMBIENTE_HISTORIAL_LOTE_ID => $ambHistoLote,
            controlAlimentoTableClass::SALIDA_INSUMO_DETALLE_ID => $salidaDetalle,
            controlAlimentoTableClass::ID_EMPLEADO => $emple,
            controlAlimentoTableClass::SEXO => $sexo,
            controlAlimentoTableClass::CANTIDAD => $cantidad,
            controlAlimentoTableClass::FECHA => $fecha,
            controlAlimentoTableClass::SEMANA => $semana,
            controlAlimentoTableClass::OBSERVACION => $observacion
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        $this->Validations($ambHistoLote, $salidaDetalle, $emple, $sexo, $cantidad, $fecha, $semana, $observacion);
        /* ------------- */

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
        controlAlimentoTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');

        routing::getInstance()->redirect('controlAlimento', 'index');
      } else {
        routing::getInstance()->redirect('controlAlimento', 'index');
      }
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El Tipo de Usuario que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('controlAlimento', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  public function Validations($ambHistoLote, $salidaDetalle, $emple, $sexo, $cantidad, $fecha, $semana, $observacion) {
    if (!is_numeric($ambHistoLote) || $ambHistoLote === "") {
      throw new PDOException('Seleccione un numero de Ramada Valido', 00010);
    }
    if (!is_numeric($salidaDetalle) || $salidaDetalle === "") {
      throw new PDOException('Ingrese un Numero de Salida Valido', 00010);
    }
    if (!is_numeric($emple) || $emple === "") {
      throw new PDOException('Seleccione un Empleado Valido', 00010);
    }
    if (!is_numeric($sexo) || $sexo === "") {
      throw new PDOException('Seleccione un sexo de ave Valido', 00010);
    }
    if (!is_numeric($cantidad)) {
      throw new PDOException('La cantidad solo admite caracteres numericos', 00008);
    }
    if ($cantidad === "") {
      throw new PDOException('La cantidad no puede ir Vacio', 00007);
    }
    if (strtotime($fecha) > strtotime(date('Y-m-d H:i:s'))) {
      throw new PDOException('La Fecha no puede er Mayor a la del Sistema', 00009);
    }
    if (!is_numeric($semana)) {
      throw new PDOException('La semana de edad de las aves solo admite caracteres numericos', 00008);
    }
    if ($semana === "") {
      throw new PDOException('La semana de edad de las aves no puede ir Vacio', 00007);
    }
    if (strlen($observacion) > controlAlimentoTableClass::OBSERVACION_LENGTH) {
      throw new PDOException('La observacion no pude ser mayor a ' . controlAlimentoTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
    }
  }

}
