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

        $id = request::getInstance()->getPost(incubadoraTableClass::getNameField(incubadoraTableClass::ID, true));
        $localiza = request::getInstance()->getPost(incubadoraTableClass::getNameField(incubadoraTableClass::LOCALIZACION_ID, true));
        $nombre = request::getInstance()->getPost(incubadoraTableClass::getNameField(incubadoraTableClass::NOMBRE, true));
        $observacion = request::getInstance()->getPost(incubadoraTableClass::getNameField(incubadoraTableClass::OBSERVACION, true));
        $direc = request::getInstance()->getPost(incubadoraTableClass::getNameField(incubadoraTableClass::DIRECCION, true));

        $ids = array(
            incubadoraTableClass::ID => $id
        );
        /**
         * VALIDACIONES
         */
        $this->Validations($localiza, $nombre, $direc, $observacion);
        /* ------------- */
        $data = array(
            incubadoraTableClass::LOCALIZACION_ID => $localiza,
            incubadoraTableClass::NOMBRE => $nombre,
            incubadoraTableClass::DIRECCION => $direc
        );
        if ($observacion != '') {
          $data[incubadoraTableClass::OBSERVACION] = $observacion;
        }
        incubadoraTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Actualización exitosa');

        routing::getInstance()->redirect('incubadora', 'index');
      } else {
        routing::getInstance()->redirect('incubadora', 'index');
      }
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La incubadora que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('incubadora', 'edit');
      //routing::getInstance()->forward('security', 'new');
    }
  }
  
  public function Validations($localiza,$nombre,$direc,$observacion) {
    
    if (!is_numeric($localiza)|| $localiza === "") {
      throw new PDOException('Seleccione una Localizacion Valida', 00010);
    }
    if (strlen($observacion) > incubadoraTableClass::OBSERVACION_LENGTH) {
      throw new PDOException('La descripcion no pude ser mayor a ' . incubadoraTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
    }
    if ($nombre === "") {
      throw new PDOException('El nombre no puede ir Vacio', 00007);
    }
    if (strlen($nombre) > incubadoraTableClass::NOMBRE_LENGTH) {
      throw new PDOException('El nombre no pude ser mayor a ' . incubadoraTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
    }
    if (strlen($observacion) > incubadoraTableClass::OBSERVACION_LENGTH) {
      throw new PDOException('La descripcion no pude ser mayor a ' . incubadoraTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
    }
    if ($direc === "") {
      throw new PDOException('El nombre no puede ir Vacio', 00007);
    }
    if (strlen($direc) > incubadoraTableClass::DIRECCION_LENGTH) {
      throw new PDOException('El nombre no pude ser mayor a ' . incubadoraTableClass::DIRECCION_LENGTH . ' caracteres', 00006);
    }
  }
}
