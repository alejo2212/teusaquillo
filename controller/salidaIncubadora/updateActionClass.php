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
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      
      if (request::getInstance()->isMethod('POST')) {
        
        $id = request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::ID, true));
        $idanual = request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::ID_ANUAL, true));
        $cantidad = request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::CANTIDAD, true));
//        $fecha = request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA, true));
        $npedido = request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::NO_PEDIDO, true));
        $fecha_lle = request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_LLEGADA, true));
        $fecha_sa = request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::FECHA_SALIDAD, true));
        $empleado = request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::EMPLEADO_ID, true));
        $empleado = request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::EMPLEADO_ID, true));
        $observacion = request::getInstance()->getPost(salidaincubadoraTableClass::getNameField(salidaincubadoraTableClass::OBSERVACION, true));
        
        $idanual = salidaincubadoraTableClass::getIdAnualById($id);
//        exit();
        /**
         * VALIDACIONES
         */
        $this->Validations($cantidad, $fecha, $npedido, $fecha_lle, $fecha_sa, $empleado, $observacion);
        /* ------------- */
        
        $ids = array(
            salidaincubadoraTableClass::ID => $id
        );
        
        $data = array(
            salidaincubadoraTableClass::ID_ANUAL => $idanual,
            salidaincubadoraTableClass::CANTIDAD => $cantidad,
            salidaincubadoraTableClass::FECHA => date(config::getFormatTimestamp()),
            salidaincubadoraTableClass::NO_PEDIDO => $npedido,
            salidaincubadoraTableClass::FECHA_LLEGADA => $fecha_lle,
            salidaincubadoraTableClass::FECHA_SALIDAD => $fecha_sa,
            salidaincubadoraTableClass::EMPLEADO_ID => $empleado
        );
        if($observacion != '') {
            $data[salidaincubadoraTableClass::OBSERVACION] = $observacion;
        }
        salidaincubadoraTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Actualización exitosa');
        
        routing::getInstance()->redirect('salidaIncubadora', 'index');
      } else {
        routing::getInstance()->redirect('salidaIncubadora', 'index');
      }
      session::getInstance()->deleteAttribute('form');
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La salida de Incubadora que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('salidaIncubadora', 'edit', array('id'=>$id));
      //routing::getInstance()->forward('security', 'new');
    }
  }

  public function Validations($cantidad, $fecha, $npedido, $fecha_lle, $fecha_sa, $empleado, $observacion) {

    if (!is_numeric($cantidad) || $cantidad === "") {
      throw new PDOException('La cantidad solo admite caracteres numericos y no puede quedar vacio', 00010);
    }
    if (!is_numeric($npedido) || $npedido === "") {
      throw new PDOException('el numero de pedido solo admite caracteres numericos y no puede quedar vacio', 00010);
    }
    if (!is_numeric($empleado) || $empleado === "") {
      throw new PDOException('Seleccione un Empleado Valido', 00010);
    }
//    if (strtotime($fecha) > strtotime(date('Y-m-d H:i:s'))) {
//      throw new PDOException('La Fecha no puede ser Mayor a la del Sistema');
//    }
    if (strtotime($fecha_lle) > strtotime(date('Y-m-d H:i:s'))) {
      throw new PDOException('La Fecha de Llegada no puede ser Mayor a la del Sistema');
    }
    if (strtotime($fecha_lle) > strtotime($fecha_sa)) {
      throw new PDOException('La Fecha de Llegada no puede ser Mayor a la Fecha de Salida');
    }
    if (strlen($observacion) > salidaincubadoraTableClass::OBSERVACION_LENGTH) {
      throw new PDOException('La observacion no pude ser mayor a ' . salidaincubadoraTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
    }
  }

}
