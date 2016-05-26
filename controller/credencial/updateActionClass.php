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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      if (request::getInstance()->isMethod('POST')) {

        $id = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::ID, true));
        $nombre = request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, true));
        $post = array(
            credencialTableClass::NOMBRE => $nombre
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        $this->Validations($nombre);
        /* ------------- */
        $ids = array(
            credencialTableClass::ID => $id
        );

        $data = array(
            credencialTableClass::NOMBRE => $nombre,
            credencialTableClass::UPDATE_AT => date(config::getFormatTimestamp())
        );
        credencialTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Actualización exitosa');

        routing::getInstance()->redirect('credencial', 'index');
      } else {
        routing::getInstance()->redirect('credencial', 'index');
      }
    session::getInstance()->deleteAttribute('form');
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La Credencial que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('credencial', 'edit');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  public function Validations($nombre) {
    if (strlen($nombre) > credencialTableClass::NOMBRE_LENGTH) {
      throw new PDOException('El nombre no pude ser mayor a ' . credencialTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
    }
    if ($nombre === "") {
      throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
    }
//    if (!ereg("^[A-Za-z_]*$", $nombre)) {
//      throw new PDOException('El campo Nombre no puede llevar campos numericos', 00008);
//    }
  }

}
