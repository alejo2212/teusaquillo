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
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $descripcion = request::getInstance()->getPost(tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DESCRIPCION, true));
        $abreviatura = request::getInstance()->getPost(tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ABREVIATURA, true));

        $post = array(
            tipoIdentificacionTableClass::DESCRIPCION => $descripcion,
            tipoIdentificacionTableClass::ABREVIATURA => $abreviatura
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        // usuarioTableClass::USER_LENGTH
        $this->Validations($descripcion, $abreviatura);
        /* ------------- */


        session::getInstance()->setAttribute(tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DESCRIPCION, true), $descripcion);
//                session::getInstance()->setAttribute(tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ABREVIATURA, true), $abreviatura);

        $data = array(
            tipoIdentificacionTableClass::DESCRIPCION => $descripcion,
            tipoIdentificacionTableClass::ABREVIATURA => $abreviatura
        );
        tipoIdentificacionTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');

        routing::getInstance()->redirect('tipoid', 'index');
      } else {
        routing::getInstance()->redirect('tipoid', 'index');
      }
      session::getInstance()->deleteAttribute('form');
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El Tipo de Identificacion que intenta registar ya existe en la base de datos');
          break;
        case 00006:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case 00007:
          session::getInstance()->setWarning($exc->getMessage());
          break;
//        case 22001:
//          session::getInstance()->setWarning('La Abreviatura no pude ser mayor a ' . tipoIdentificacionTableClass::ABREVIATURA_LENGTH . ' caracteres');
//          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('tipoid', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function Validations($nombre, $descripcion) {
    if (strlen($descripcion) > tipoIdentificacionTableClass::DESCRIPCION_LENGTH) {
      throw new PDOException('La Descripcion no pude ser mayor a ' . tipoIdentificacionTableClass::DESCRIPCION_LENGTH . ' caracteres', 00006);
    }
    if (strlen($abreviatura) > tipoIdentificacionTableClass::ABREVIATURA_LENGTH) {
      throw new PDOException('La Abreviatura no pude ser mayor a ' . tipoIdentificacionTableClass::ABREVIATURA_LENGTH . ' caracteres', 00007);
    }
  }

}
