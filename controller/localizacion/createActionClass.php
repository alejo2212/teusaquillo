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

        $nombre = request::getInstance()->getPost(localidadTableClass::getNameField(localidadTableClass::NOMBRE, true));
        $localidadId = request::getInstance()->getPost(localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID, true));

        $post = array(
            localidadTableClass::NOMBRE => $nombre,
            localidadTableClass::LOCALIDAD_ID => $localidadId
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        $this->Validations($nombre, $localidadId);
        /* ------------- */

        session::getInstance()->setAttribute(localidadTableClass::getNameField(localidadTableClass::NOMBRE, true), $nombre);

        $data = array(
            localidadTableClass::NOMBRE => $nombre,
            localidadTableClass::LOCALIDAD_ID => $localidadId
        );
        localidadTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');

        routing::getInstance()->redirect('localizacion', 'index');
      } else {
        routing::getInstance()->redirect('localizacion', 'index');
      }
      session::getInstance()->deleteAttribute('form');
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La Localidad que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('localizacion', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }
  
  public function Validations($nombre,$localidadId) {
    if (strlen($nombre) > 4) {
      throw new PDOException('El nombre no pude ser mayor a ' . localidadTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
    }
    if ($nombre === "") {
      throw new PDOException('El campo Nombre no puede ir Vacio', 00006);
    }
//    if (!ereg("^[A-Za-z_]*$", $nombre)) {
//      throw new PDOException('El campo Nombre no puede llevar campos numericos', 00007);
//    }
    if (!is_numeric($localidadId)|| $localidadId === "") {
      throw new PDOException('Seleccione un departamento Valido', 00008);
    }
  }

}
