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

        $salidaIncu = request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID, true));
        $llegada = request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_LLEGADA, true));
        $faltante = request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_FALTANTE, true));
        $devolucion = request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION, true));
        $fecha = request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::FECHA, true));
        $empleado = request::getInstance()->getPost(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::EMPLEADO, true));

//        exit();

        $post = array(
            devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID => $salidaIncu,
            devolucionIncubadoraTableClass::CANTIDAD_LLEGADA => $llegada,
            devolucionIncubadoraTableClass::CANTIDAD_FALTANTE => $faltante,
            devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION => $devolucion,
            devolucionIncubadoraTableClass::FECHA => $fecha,
            devolucionIncubadoraTableClass::EMPLEADO => $empleado
        );
        session::getInstance()->setAttribute('form', $post);
        
        $idSalidaIncu = salidaincubadoraTableClass::getIdSalidaIncubadoraByNpedido($salidaIncu);
//        exit();
        /**
         * VALIDACIONES
         */
        $this->Validations($idSalidaIncu, $llegada, $faltante, $devolucion, $fecha, $empleado);
        /* ------------- */


        session::getInstance()->setAttribute(devolucionIncubadoraTableClass::getNameField(devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID, true), $salidaIncu);

        $data = array(
            devolucionIncubadoraTableClass::SALIDAD_INCUBADORA_ID => $idSalidaIncu,
            devolucionIncubadoraTableClass::CANTIDAD_LLEGADA => $llegada,
            devolucionIncubadoraTableClass::CANTIDAD_FALTANTE => $faltante,
            devolucionIncubadoraTableClass::CANTIDAD_DEVOLUCION => $devolucion,
            devolucionIncubadoraTableClass::FECHA => $fecha,
            devolucionIncubadoraTableClass::EMPLEADO => $empleado
        );

        devolucionIncubadoraTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');

        routing::getInstance()->redirect('devolucionIncubadora', 'index');
      } else {
        routing::getInstance()->redirect('devolucionIncubadora', 'index');
      }
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La Devolucion que intenta registar ya existe en la base de datos');
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
//        case '23503':
//          session::getInstance()->setError('El numero de salida que ingreso no existe en la base de datos');
//          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('devolucionIncubadora', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  public function Validations($idSalidaIncu, $llegada, $faltante, $devolucion, $fecha, $empleado) {
    if (($llegada + $faltante) != $devolucion) {
      throw new PDOException('La suma de la cantidad llegada y la cantidad faltante debe ser igual a la devolucion total', 00010);
    }
    if (!is_numeric($idSalidaIncu) || $idSalidaIncu === "") {
      throw new PDOException('Ingrese una salida valida', 00010);
    }
    if (!is_numeric($empleado) || $empleado === "") {
      throw new PDOException('Seleccione un Empleado Valido', 00010);
    }
    if (!is_numeric($llegada) || $llegada === "") {
      throw new PDOException('La cantidad de llegada debe ser numerica y es un campo obligatorio', 00010);
    }
    if (!is_numeric($faltante) || $faltante === "") {
      throw new PDOException('La cantidad faltante debe ser numerica y es un campo obligatorio', 00010);
    }
    if (!is_numeric($devolucion) || $devolucion === "") {
      throw new PDOException('La cantidad de devolucion debe ser numerica y es un campo obligatorio', 00010);
    }
    if (strtotime($fecha) > strtotime(date('Y-m-d H:i:s'))) {
      throw new PDOException('La Fecha de Inicio del Mantenimiento no puede ser Mayor a la del Sistema');
    }
  }

}
