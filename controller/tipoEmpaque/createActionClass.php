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

        $nombre = request::getInstance()->getPost(tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::NOMBRE, true));
        $descripcion = request::getInstance()->getPost(tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::DESCRIPCION, true));
        $cantidad = request::getInstance()->getPost(tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::CANTIDAD, true));
        
        $post = array(
            tipoEmpaqueTableClass::NOMBRE => $nombre,
            tipoEmpaqueTableClass::CANTIDAD => $cantidad,
            tipoEmpaqueTableClass::DESCRIPCION => $descripcion
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        $this->Validations($nombre,$descripcion,$cantidad);
        /* ------------- */

        session::getInstance()->setAttribute(tipoEmpaqueTableClass::getNameField(tipoEmpaqueTableClass::NOMBRE, true), $nombre);

        $data = array(
            tipoEmpaqueTableClass::NOMBRE => $nombre,
            tipoEmpaqueTableClass::CANTIDAD => $cantidad,
            tipoEmpaqueTableClass::DESCRIPCION => $descripcion
        );
        tipoEmpaqueTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');

        routing::getInstance()->redirect('tipoEmpaque', 'index');
      } else {
        routing::getInstance()->redirect('tipoEmpaque', 'index');
      }
      session::getInstance()->deleteAttribute('form');
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El Tipo de Empaque que intenta registar ya existe en la base de datos');
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
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('tipoEmpaque', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  public function Validations($nombre,$descripcion,$cantidad) {
    if (strlen($nombre) > tipoEmpaqueTableClass::NOMBRE_LENGTH) {
      throw new PDOException('El nombre no pude ser mayor a ' . tipoEmpaqueTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
    }
    if ($nombre === "") {
      throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
    }
    if (strlen($descripcion) > tipoEmpaqueTableClass::DESCRIPCION_LENGTH) {
      throw new PDOException('La Descripcion no pude ser mayor a ' . tipoEmpaqueTableClass::DESCRIPCION_LENGTH . ' caracteres', 00007);
    }
    if ($descripcion === "") {
      throw new PDOException('El campo Descripcion no puede ir Vacio', 00007);
    }
    if (!is_numeric($cantidad)) {
      throw new PDOException('La Cantidad solo admite caracteres numericos', 00008);
    }
  }

}
