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
        
        $id = request::getInstance()->getPost(clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::ID, true));
        $nombre = request::getInstance()->getPost(clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::NOMBRE, true));
        $descripcion = request::getInstance()->getPost(clasificacionMaquinaTableClass::getNameField(clasificacionMaquinaTableClass::DESCRIPCION, true));
       
        $ids = array(
            clasificacionMaquinaTableClass::ID => $id
        );
         /**
         * VALIDACIONES
         */
        $this->Validations($nombre,$descripcion);
        /* ------------- */
        $data = array(
            clasificacionMaquinaTableClass::NOMBRE => $nombre,
            clasificacionMaquinaTableClass::DESCRIPCION => $descripcion
        );
        
        clasificacionMaquinaTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Actualización exitosa');
        
        routing::getInstance()->redirect('clasificacionMaquina', 'index');
      } else {
        routing::getInstance()->redirect('clasificacionMaquina', 'index');
      }
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La Clasificacion de Maquina que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('clasificacionMaquina', 'edit', array(clasificacionMaquinaTableClass::ID=>$id));
      //routing::getInstance()->forward('security', 'new');
    }
  }
  
  public function Validations($nombre,$descripcion) {
   if (strlen($descripcion) > clasificacionMaquinaTableClass::DESCRIPCION_LENGTH) {
      throw new PDOException('La descripcion no pude ser mayor a ' . clasificacionMaquinaTableClass::DESCRIPCION_LENGTH . ' caracteres', 00006);
    }
    if ($nombre === "") {
      throw new PDOException('El nombre no puede ir Vacio', 00007);
    }
    if (strlen($nombre) > clasificacionMaquinaTableClass::NOMBRE_LENGTH) {
      throw new PDOException('El nombre no pude ser mayor a ' . clasificacionMaquinaTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
    }
  }

}
