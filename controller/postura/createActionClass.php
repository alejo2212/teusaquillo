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

        $ambiente = request::getInstance()->getPost(posturaTableClass::getNameField(posturaTableClass::AMBIENTE_ID, true));
        $fecha = request::getInstance()->getPost(posturaTableClass::getNameField(posturaTableClass::FECHA, true));
        $lote = request::getInstance()->getPost(posturaTableClass::getNameField(posturaTableClass::LOTE_ID, true));

        $post = array(
            posturaTableClass::AMBIENTE_ID => $ambiente,
            posturaTableClass::LOTE_ID => $lote,
            posturaTableClass::FECHA => $fecha
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        $this->Validations($ambiente, $fecha, $lote);
        /* ------------- */

        $data = array(
            posturaTableClass::AMBIENTE_ID => $ambiente,
            posturaTableClass::LOTE_ID => $lote,
            posturaTableClass::FECHA => $fecha
        );
        posturaTableClass::insert($data);
//        session::getInstance()->setSuccess('Registro exitoso');
        $idPostura = posturaTableClass::getIdPostura();

        routing::getInstance()->redirect('posturaDetalle', 'new', array(posturaTableClass::ID . 'Postura' => $idPostura));
      } else {
        routing::getInstance()->redirect('postura', 'index');
      }
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La Postura que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('postura', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  public function Validations($ambiente, $fecha, $lote) {

    if (!is_numeric($ambiente) || $ambiente === "") {
      throw new PDOException('Seleccione un Ambiente Valido', 00010);
    }
    if (!is_numeric($lote) || $lote === "") {
      throw new PDOException('Seleccione un Lote Valido', 00010);
    }
    if (strtotime($fecha) > strtotime(date('Y-m-d H:i:s'))) {
      throw new PDOException('La Fecha no puede er Mayor a la del Sistema');
    }
  }

}
