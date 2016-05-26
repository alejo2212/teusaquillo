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

        $id = request::getInstance()->getPost(tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ID, true));
        $descripcion = request::getInstance()->getPost(tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::DESCRIPCION, true));
        $abreviatura = request::getInstance()->getPost(tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ABREVIATURA, true));

        $ids = array(
            tipoIdentificacionTableClass::ID => $id
        );
        /**
         * VALIDACIONES
         */
        // usuarioTableClass::USER_LENGTH
        $this->Validations($descripcion, $abreviatura);
        /* ------------- */
        $data = array(
            tipoIdentificacionTableClass::DESCRIPCION => $descripcion,
            tipoIdentificacionTableClass::ABREVIATURA => $abreviatura
        );
        tipoIdentificacionTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Actualización exitosa');

        routing::getInstance()->redirect('tipoid', 'index');
      } else {
        routing::getInstance()->redirect('tipoid', 'index');
      }
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
                default:
                    session::getInstance()->setError($exc->getMessage());
                    break;
            }
            routing::getInstance()->redirect('tipoid', 'edit', array(tipoIdentificacionTableClass::ID => $id));
            //routing::getInstance()->forward('security', 'new');
        }
    }

    private function Validations($nombre,$descripcion) {
        if (strlen($descripcion) > tipoIdentificacionTableClass::DESCRIPCION_LENGTH) {
            throw new PDOException('La Descripcion no pude ser mayor a ' . tipoIdentificacionTableClass::DESCRIPCION_LENGTH . ' caracteres', 00006);
        }
        if (strlen($abreviatura) > tipoIdentificacionTableClass::ABREVIATURA_LENGTH) {
            throw new PDOException('La Abreviatura no pude ser mayor a ' . tipoIdentificacionTableClass::ABREVIATURA_LENGTH . ' caracteres', 00007);
        }
    }

}
