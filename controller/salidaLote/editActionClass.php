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
 * @author Aleyda Mina  <aleminac@gmail.com>
 */
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet('id')) {
        $id = request::getInstance()->getGet('id');
        $this->SalidaLote = salidaLoteTableClass::getSalidaLoteById($id);
        $this->edit = true;
        $this->objAmbienteHistorial = ambienteHistorialLoteTableClass::getAmbienteHistLote();
        $fieldsRazonSalida = array(
            razonSalidaTableClass::ID,
            razonSalidaTableClass::RAZON
        );
        $this->objRazonSalida = razonSalidaTableClass::getAll($fieldsRazonSalida, true, array(razonSalidaTableClass::RAZON), 'ASC');
        
        $fieldsEmpleado = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
        );
        $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado, true, array(empleadoTableClass::NOMBRE), 'ASC');

        $this->defineView('edit', 'salidaLote', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('salidaLote', 'index');
     }
            session::getInstance()->deleteAttribute('form');
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La Salida Lote que intenta registar ya existe en la base de datos');
          break;
        case 00006:
          session::getInstance()->setWarning($exc->getMessage());
          break;
//        case '22P02':
//          session::getInstance()->setWarning('Ingresar datos validos');
//          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('salidaLote', 'edit');
      //routing::getInstance()->forward('security', 'new');
    }
  }

}
