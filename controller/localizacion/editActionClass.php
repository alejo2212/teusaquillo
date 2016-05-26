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
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet('id')) {
        $id = request::getInstance()->getGet('id');
        $this->objLocalidadE = localidadTableClass::getLocalidadesById($id);
        $this->edit = true;
        $fields = array(
            localidadTableClass::ID,
            localidadTableClass::NOMBRE,
            localidadTableClass::LOCALIDAD_ID,
            localidadTableClass::DELETED_AT
        );
        $this->objLocalidad = localidadTableClass::getAll($fields, true, array(localidadTableClass::NOMBRE), 'ASC', null,null,null,null,'depto');
        $this->defineView('edit', 'localizacion', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('localizacion', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('localizacion', 'index');
    }
  }

}
