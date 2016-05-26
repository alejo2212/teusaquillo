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
        
        $id = request::getInstance()->getPost(requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::ID, true));
        $requisicion = request::getInstance()->getPost(requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::REQUISICION_ID, true));
        $bodega = request::getInstance()->getPost(requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::BODEGA_ID, true));
        $cantidad = request::getInstance()->getPost(requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::CANTIDAD, true));
        $fecha = request::getInstance()->getPost(requisiciondetalleTableClass::getNameField(requisiciondetalleTableClass::FECHA_NECESIDAD, true));
        
        $post = array(
            requisiciondetalleTableClass::REQUISICION_ID => $requisicion,
            requisiciondetalleTableClass::CANTIDAD => $cantidad,
            requisiciondetalleTableClass::FECHA_NECESIDAD => $fecha,
            requisiciondetalleTableClass::BODEGA_ID => $bodega
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        $this->Validations($requisicion, $cantidad, $fecha, $bodega);
        /* ------------- */

        $ids = array(
            requisiciondetalleTableClass::ID => $id
        );
        
        $data = array(
            requisiciondetalleTableClass::REQUISICION_ID => $requisicion,
            requisiciondetalleTableClass::BODEGA_ID => $bodega,
            requisiciondetalleTableClass::CANTIDAD => $cantidad,
            requisiciondetalleTableClass::FECHA_NECESIDAD => $fecha
        );
        requisiciondetalleTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Actualización exitosa');
        
        routing::getInstance()->redirect('requisicion', 'detail', array(requisicionTableClass::ID => $requisicion));
      } else {
        routing::getInstance()->redirect('requisicion', 'detail', array(requisicionTableClass::ID => $requisicion));
      }
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El codigo del Detalle que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('detalleRequisicion', 'edit', array(requisicionTableClass::ID => $requisicion));
      //routing::getInstance()->forward('security', 'new');
    }
  }

  public function Validations($requisicion, $cantidad, $fecha, $bodega) {
    if (!is_numeric($requisicion) || $requisicion === "") {
      throw new PDOException('No se encuentra el Numero de la Requisicion para completar el registro', 00010);
    }
    if (!is_numeric($cantidad)) {
      throw new PDOException('La cantidad solo admite caracteres numericos', 00008);
    }
    if ($cantidad === "") {
      throw new PDOException('La cantidad no puede ir Vacio', 00007);
    }
    if (strtotime($fecha) > strtotime(date('Y-m-d H:i:s'))) {
      throw new PDOException('La Fecha no puede er Mayor a la del Sistema');
    }
    if (!is_numeric($bodega) || $bodega === "") {
      throw new PDOException('Seleccione una Bodega valida', 00010);
    }
  }

}
