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
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = request::getInstance()->getPost(ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true));
        $observacion = request::getInstance()->getPost(ambienteTableClass::getNameField(ambienteTableClass::OBSERVACION, true));
        $tipoamb = request::getInstance()->getPost(ambienteTableClass::getNameField(ambienteTableClass::TIPO_AMBIENTE_ID, true));

        $post = array(
            ambienteTableClass::NOMBRE => $nombre,
            ambienteTableClass::OBSERVACION => $observacion,
            ambienteTableClass::TIPO_AMBIENTE_ID => $tipoamb
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        // usuarioTableClass::USER_LENGTH
        $this->Validations($nombre, $observacion, $tipoamb);

        /* ------------- */

        session::getInstance()->setAttribute(ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true), $nombre);
//                session::getInstance()->setAttribute(ambienteTableClass::getNameField(ambienteTableClass::OBSERVACION, true), $observacion);

        $data = array(
            ambienteTableClass::NOMBRE => $nombre,
            ambienteTableClass::OBSERVACION => $observacion,
            ambienteTableClass::TIPO_AMBIENTE_ID => $tipoamb
        );
        ambienteTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');

        routing::getInstance()->redirect('ambiente', 'index');
      } else {
        routing::getInstance()->redirect('ambiente', 'index');
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
        case 00008:
          session::getInstance()->setWarning($exc->getMessage());
          break;
//        case '22P02':
//          session::getInstance()->setWarning('Ingresar datos validos');
//          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('ambiente', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function Validations($nombre, $observacion, $tipoamb) {
    if (strlen($nombre) > ambienteTableClass::NOMBRE_LENGTH) {
      throw new PDOException(' El nombre del ambiente no pude ser mayor a ' . ambienteTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
    }
    if (strlen($observacion) > ambienteTableClass::OBSERVACION_LENGTH) {
      throw new PDOException('La Observacion del ambiente no pude ser mayor a ' . ambienteTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
    }
    if ($nombre === "") {
      throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
    }
    if (!is_numeric($tipoamb) and $tipoamb == '') {
      throw new PDOException('Seleccione un tipo de ambiente valido', 00008);
    }
//    if (!ereg("^[A-Za-z_]*$", $nombre)) {
//      throw new PDOException('El campo Nombre Solo admite caracteres Alfabeticos', 00008);
//    }
  }

}
