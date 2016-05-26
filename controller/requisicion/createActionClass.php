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

        $emple = request::getInstance()->getPost(requisicionTableClass::getNameField(requisicionTableClass::EMPLEADO_ID, true));
        $fecha = request::getInstance()->getPost(requisicionTableClass::getNameField(requisicionTableClass::FECHA_REALIZACION, true));
        $anulado = 'f';
//        exit();
        $post = array(
            requisicionTableClass::EMPLEADO_ID => $emple,
            requisicionTableClass::FECHA_REALIZACION => $fecha
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        $this->Validations($emple, $fecha);
        /* ------------- */

        $data = array(
            requisicionTableClass::EMPLEADO_ID => $emple,
            requisicionTableClass::FECHA_REALIZACION => $fecha,
            requisicionTableClass::ANULADO => $anulado
        );
        requisicionTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');
        $idRequisicion = requisicionTableClass::getIdRequisicion();

        routing::getInstance()->redirect('detalleRequisicion', 'new', array(requisicionTableClass::ID . 'Requisicion' => $idRequisicion));
      } else {
        routing::getInstance()->redirect('requisicion', 'index');
      }
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La Requisicion que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('requisicion', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  public function Validations($emple, $fecha) {

    if (!is_numeric($emple) || $emple === "") {
      throw new PDOException('Seleccione un Empleado Valido', 00010);
    }
    if (strtotime($fecha) > strtotime(date('Y-m-d H:i:s'))) {
      throw new PDOException('La Fecha no puede er Mayor a la del Sistema');
    }
  }

}
