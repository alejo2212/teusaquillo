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

        $nombre = request::getInstance()->getPost(tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::NOMBRE, true));
        $descripcion = request::getInstance()->getPost(tipoMantenimientoTableClass::getNameField(tipoMantenimientoTableClass::DESCRIPCION, true));
       
//        exit();
        $post = array(
            tipoMantenimientoTableClass::NOMBRE => $nombre,
            tipoMantenimientoTableClass::DESCRIPCION => $descripcion
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        $this->Validations($nombre,$descripcion);
        /* ------------- */
        
        $data = array(
            tipoMantenimientoTableClass::NOMBRE => $nombre,
            tipoMantenimientoTableClass::DESCRIPCION => $descripcion
        );
        tipoMantenimientoTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');
        
        routing::getInstance()->redirect('tipoMantenimiento', 'index');
      } else {
        routing::getInstance()->redirect('tipoMantenimiento', 'index');
      }
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El Tipo de Mantenimiento que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('tipoMantenimiento', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }
  
  public function Validations($nombre,$descripcion) {

    if (strlen($descripcion) > tipoMantenimientoTableClass::DESCRIPCION_LENGTH) {
      throw new PDOException('La descripcion no pude ser mayor a ' . tipoMantenimientoTableClass::DESCRIPCION_LENGTH . ' caracteres', 00006);
    }
    if ($nombre === "") {
      throw new PDOException('El nombre no puede ir Vacio', 00007);
    }
    if (strlen($nombre) > tipoMantenimientoTableClass::NOMBRE_LENGTH) {
      throw new PDOException('El nombre no pude ser mayor a ' . tipoMantenimientoTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
    }
  }
}
