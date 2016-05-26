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
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet('id')) {
        $id = request::getInstance()->getGet('id');
        $this->objincubadora = incubadoraTableClass::getIncubadora($id);
        
        $fields = array(
        localidadTableClass::ID,
        localidadTableClass::NOMBRE
     );
        $this->objlocalidad = localidadTableClass::getAll($fields, true, array(localidadTableClass::NOMBRE), 'ASC');
        $this->edit = true;
        $this->defineView('edit', 'incubadora', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('incubadora', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('incubadora', 'index');
    }
  }

}
