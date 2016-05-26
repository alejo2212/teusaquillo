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
        
        $id = request::getInstance()->getPost(posturaTableClass::getNameField(posturaTableClass::ID, true));
        $ambiente = request::getInstance()->getPost(posturaTableClass::getNameField(posturaTableClass::AMBIENTE_ID, true));
        $fecha = request::getInstance()->getPost(posturaTableClass::getNameField(posturaTableClass::FECHA, true));
        $lote = request::getInstance()->getPost(posturaTableClass::getNameField(posturaTableClass::LOTE_ID, true));
        
        /**
         * VALIDACIONES
         */
         $this->Validations($ambiente, $fecha, $lote);
        /* ------------- */
        
        $ids = array(
            posturaTableClass::ID => $id
        );
        
        $data = array(
            posturaTableClass::AMBIENTE_ID => $ambiente,
            posturaTableClass::LOTE_ID => $lote,
            posturaTableClass::FECHA => $fecha
        );
        posturaTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Actualización exitosa');
        
        routing::getInstance()->redirect('postura', 'index');
      } else {
        routing::getInstance()->redirect('postura', 'index');
      }
      session::getInstance()->deleteAttribute('form');
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
      routing::getInstance()->redirect('postura', 'edit', array('id'=>$id));
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
