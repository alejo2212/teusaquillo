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
        
        $id = request::getInstance()->getPost(cargoTableClass::getNameField(cargoTableClass::ID, true));
        $nombre = request::getInstance()->getPost(cargoTableClass::getNameField(cargoTableClass::NOMBRE, true));
        $descripcion = request::getInstance()->getPost(cargoTableClass::getNameField(cargoTableClass::DESCRIPCION, true));

        $ids = array(
            cargoTableClass::ID => $id
        );
        $post = array(
            cargoTableClass::NOMBRE => $nombre,
            cargoTableClass::DESCRIPCION => $descripcion
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        $this->Validations($nombre,$descripcion);
        /* ------------- */

        session::getInstance()->setAttribute(cargoTableClass::getNameField(cargoTableClass::NOMBRE, true), $nombre);

        $data = array(
            cargoTableClass::NOMBRE => $nombre,
            cargoTableClass::DESCRIPCION => $descripcion
        );
        cargoTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Actualización exitosa');
        
        routing::getInstance()->redirect('cargo', 'index');
      } else {
        routing::getInstance()->redirect('cargo', 'index');
      }
    session::getInstance()->deleteAttribute('form');
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El cargo que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('cargo', 'edit', array(cargoTableClass::ID => $id));
      //routing::getInstance()->forward('security', 'new');
    }
  }

  public function Validations($nombre,$descripcion) {
    if (strlen($nombre) > cargoTableClass::NOMBRE_LENGTH) {
      throw new PDOException('El nombre no pude ser mayor a ' . cargoTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
    }
    if ($nombre === "") {
      throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
    }
//    if (!ereg("^[A-Za-z_]*$", $nombre)) {
//      throw new PDOException('El campo Nombre no puede llevar campos numericos', 00008);
//    }
    if (strlen($descripcion) > cargoTableClass::DESCRIPCION_LENGTH) {
      throw new PDOException('La Descripcion no pude ser mayor a ' . cargoTableClass::DESCRIPCION_LENGTH . ' caracteres', 00007);
    }
    if ($descripcion === "") {
      throw new PDOException('El campo Descripcion no puede ir Vacio', 00007);
    }
  }

}
