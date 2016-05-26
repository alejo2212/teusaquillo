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
        
        $id = request::getInstance()->getPost(salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::ID, true));
        $incubadora = request::getInstance()->getPost(salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::INCUBADORA_ID, true));
        $salidaid = request::getInstance()->getPost(salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::SALIDA_INCUBADORA_ID, true));
        $empaqueid = request::getInstance()->getPost(salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::TIPO_EMPAQUE_ID, true));
        $cantidad = request::getInstance()->getPost(salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::CANTIDAD, true));
        $cantidad_empa = request::getInstance()->getPost(salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::CANTIDAD_EMPAQUE, true));
        $descripcion = request::getInstance()->getPost(salidaDetalleIncubadoraTableClass::getNameField(salidaDetalleIncubadoraTableClass::DESCRIPCION, true));
        
        /**
         * VALIDACIONES
         */
        $this->Validations($incubadora, $salidaid, $empaqueid, $cantidad, $cantidad_empa, $descripcion);
        /* ------------- */
        $ids = array(
            salidaDetalleIncubadoraTableClass::ID => $id
        );
        
        $data = array(
            salidaDetalleIncubadoraTableClass::SALIDA_INCUBADORA_ID => $salidaid,
            salidaDetalleIncubadoraTableClass::INCUBADORA_ID=>$incubadora,
            salidaDetalleIncubadoraTableClass::TIPO_EMPAQUE_ID => $empaqueid,
            salidaDetalleIncubadoraTableClass::CANTIDAD => $cantidad,
            salidaDetalleIncubadoraTableClass::CANTIDAD_EMPAQUE => $cantidad_empa,
            salidaDetalleIncubadoraTableClass::DESCRIPCION => $descripcion
        );
        
        salidaDetalleIncubadoraTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Actualización exitosa');
        
        routing::getInstance()->redirect('salidaIncubadora', 'detail', array(salidaincubadoraTableClass::ID => $salidaid));
      } else {
        routing::getInstance()->redirect('salidaIncubadora', 'detail', array(salidaincubadoraTableClass::ID => $salidaid));
      }
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El codigo del Detalle Salida Incubadora que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('salidaDetalleIncubadora', 'edit', array(salidaincubadoraTableClass::ID => $id));
      //routing::getInstance()->forward('security', 'new');
    }
  }

  public function Validations($incubadora, $salidaid, $empaqueid, $cantidad, $cantidad_empa, $descripcion) {
    
    if (!is_numeric($incubadora) || $incubadora === "") {
      throw new PDOException('Seleccione una Incubadora Valida', 00010);
    }
    if (!is_numeric($salidaid) || $salidaid === "") {
      throw new PDOException('No se encuentra el Numero de Salida para completar el registro', 00010);
    }
    if (!is_numeric($empaqueid) || $empaqueid === "") {
      throw new PDOException('Seleccione una Clasificacion de Postura valida', 00010);
    }
    if (!is_numeric($cantidad)) {
      throw new PDOException('La cantidad solo admite caracteres numericos', 00008);
    }
    if ($cantidad === "") {
      throw new PDOException('La cantidad no puede ir Vacio', 00007);
    }
    if (!is_numeric($cantidad_empa) and $cantidad_empa != '') {
      throw new PDOException('La cantidad de Empaque  solo admite caracteres numericos y no puede quedar vacio', 00008);
    }
    if ($descripcion === "") {
      throw new PDOException('La descripcion no puede ir Vacia', 00007);
    }
    if (strlen($descripcion) > salidaDetalleIncubadoraTableClass::DESCRIPCION_LENGTH) {
      throw new PDOException('La descripcion no pude ser mayor a ' . salidaDetalleIncubadoraTableClass::DESCRIPCION_LENGTH . ' caracteres', 00006);
    }
  }

}
