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
  @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com> */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $admin = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR, true));
        $vete = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO, true));
        $idEmpleado = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE, true));
        $fechare = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true));
        $cajon = request::getInstance()->getPost(cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::NUMERO, true));
        $galli = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::GALLINAZA_UTILIZADA, true));
        $canaves = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_TOTAL_AVES, true));
        $cantm = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_MACHOS, true));
        $canth = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_HEMBRAS, true));
        $lotesalida = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::ID, true));
        $observacion = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::OBSERVACION, true));
//                exit();
        $post = array(
            controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR => $admin,
            controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO => $vete,
            controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE => $idEmpleado,
            controlCompostajeTableClass::FECHA_REALIZACION => $fechare,
            controlCompostajeTableClass::CAJON_COMPOSTAJE_ID => $cajon,
            controlCompostajeTableClass::GALLINAZA_UTILIZADA => $galli,
            controlCompostajeTableClass::CANTIDAD_TOTAL_AVES => $canaves,
            controlCompostajeTableClass::CANTIDAD_MACHOS => $cantm,
            controlCompostajeTableClass::CANTIDAD_HEMBRAS => $canth,
            controlCompostajeTableClass::SALIDA_LOTE_ID => $lotesalida,
            controlCompostajeTableClass::OBSERVACION => $observacion
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        // usuarioTableClass::USER_LENGTH
        $this->Validations($fechare, $cajon, $galli, $canaves, $cantm, $canth, $lotesalida, $observacion);
        /* ------------- */


        session::getInstance()->setAttribute(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true), $fechare);

        $data = array(
            controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR => $admin,
            controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO => $vete,
            controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE => $idEmpleado,
            controlCompostajeTableClass::FECHA_REALIZACION => $fechare,
            controlCompostajeTableClass::CAJON_COMPOSTAJE_ID => $cajon,
            controlCompostajeTableClass::GALLINAZA_UTILIZADA => $galli,
            controlCompostajeTableClass::CANTIDAD_TOTAL_AVES => $canaves,
            controlCompostajeTableClass::CANTIDAD_MACHOS => $cantm,
            controlCompostajeTableClass::CANTIDAD_HEMBRAS => $canth,
            controlCompostajeTableClass::SALIDA_LOTE_ID => $lotesalida,
            controlCompostajeTableClass::OBSERVACION => $observacion
        );
        controlCompostajeTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');

        routing::getInstance()->redirect('controlCompostaje', 'index');
      } else {
        routing::getInstance()->redirect('controlCompostaje', 'index');
      }
      session::getInstance()->deleteAttribute('form');
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El control Compostaje que intenta registar ya existe en la base de datos');
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
        case 000015:
          session::getInstance()->setWarning($exc->getMessage());
          break;
//                case '22P02':
//                    session::getInstance()->setWarning('Ingresar datos validos');
//                    break;
        default:
          session::getInstance()->setWarning($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('controlCompostaje', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function Validations($fechare, $cajon, $galli, $canaves, $cantm, $canth, $lotesalida, $observacion) {

    if (strtotime($fechare) > strtotime(date('Y-m-d H:i:s'))) {
      throw new PDOException('La fecha de realizacion no puede ser mayor a la del sistema');
    }
    if ($cajon === "") {
      throw new PDOException('El campo Cajon no puede ir Vacio', 00007);
    }
    if (!is_numeric($galli)) {
      throw new PDOException('El campo Gallinaza Utilizada solo puede contener caracteres numericos', 00008);
    }
    if ($galli === "") {
      throw new PDOException('El campo Gallinaza Utilizada no puede ir Vacio', 00006);
    }
    if (!is_numeric($canaves)) {
      throw new PDOException('El campo Cantidad Total Aves solo puede contener caracteres numericos', 00007);
    }
    if ($canaves === "") {
      throw new PDOException('El campo Cantidad Total Aves no puede ir Vacio', 00008);
    }
    if (!is_numeric($cantm)) {
      throw new PDOException('El campo Cantidad Machos solo puede contener caracteres numericos', 00006);
    }
    if ($cantm === "") {
      throw new PDOException('El campo Cantidad Machos no puede ir Vacio', 00007);
    }
    if (!is_numeric($canth)) {
      throw new PDOException('El campo Cantidad Hembras solo puede contener caracteres numericos', 00008);
    }
    if ($canth === "") {
      throw new PDOException('El campo Cantidad Hembras no puede ir Vacio', 00006);
    }
    if ($lotesalida === "") {
      throw new PDOException('El campo Salida Lote no puede ir Vacio', 00008);
    }
    if (strlen($observacion) > controlCompostajeTableClass::OBSERVACION_LENGTH) {
      throw new PDOException('Las observaciones  no pueden ser mayor a ' . controlCompostajeTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
    }
  }

}
