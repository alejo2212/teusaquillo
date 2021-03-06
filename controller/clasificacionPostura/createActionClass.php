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

//        $clasi_id = request::getInstance()->getPost(clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::CLASIFICACION_POSTURA_ID, true));
        $nombre = request::getInstance()->getPost(clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::NOMBRE, true));
        $descripcion = request::getInstance()->getPost(clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::DESCRIPCION, true));
        $observacion = request::getInstance()->getPost(clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::OBSERVACION, true));

        $post = array(
//            clasificacionPosturaTableClass::CLASIFICACION_POSTURA_ID => $clasi_id,
            clasificacionPosturaTableClass::NOMBRE => $nombre,
            clasificacionPosturaTableClass::DESCRIPCION => $descripcion,
            clasificacionPosturaTableClass::OBSERVACION => $observacion
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        $this->Validations($nombre, $descripcion, $observacion);
        /* ------------- */

//        session::getInstance()->setAttribute(localidadTableClass::getNameField(localidadTableClass::NOMBRE, true), $nombre);

        $data = array(
//            clasificacionPosturaTableClass::CLASIFICACION_POSTURA_ID => $clasi_id,
            clasificacionPosturaTableClass::NOMBRE => $nombre,
            clasificacionPosturaTableClass::DESCRIPCION => $descripcion
        );
        if($observacion != '') {
            $data[clasificacionPosturaTableClass::OBSERVACION] = $observacion;
        }
        clasificacionPosturaTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');

        routing::getInstance()->redirect('clasificacionPostura', 'index');
      } else {
        routing::getInstance()->redirect('clasificacionPostura', 'index');
      }
      session::getInstance()->deleteAttribute('form');
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La Clasificacion de Postura que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('clasificacionPostura', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  public function Validations($nombre, $descripcion, $observacion) {
    if (strlen($nombre) > clasificacionPosturaTableClass::NOMBRE_LENGTH) {
      throw new PDOException('El nombre no pude ser mayor a ' . clasificacionPosturaTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
    }
    if ($nombre === "") {
      throw new PDOException('El campo Nombre no puede ir Vacio', 00006);
    }
//    if (!ereg("^[A-Za-z_]*$", $nombre)) {
//      throw new PDOException('El campo Nombre no puede llevar campos numericos', 00007);
//    }
    if ($descripcion === "") {
      throw new PDOException('El campo Descripcion no puede ir Vacio', 00006);
    }
    if (strlen($nombre) > clasificacionPosturaTableClass::NOMBRE_LENGTH) {
      throw new PDOException('La Descripcion no pude ser mayor a ' . clasificacionPosturaTableClass::DESCRIPCION_LENGTH . ' caracteres', 00006);
    }
    if (strlen($observacion) > clasificacionPosturaTableClass::OBSERVACION_LENGTH) {
      throw new PDOException('La Observacion no pude ser mayor a ' . clasificacionPosturaTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
    }
  }

}
