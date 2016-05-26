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
        $this->objdevolucion = devolucionIncubadoraTableClass::getSalidaIncu($id);
        $this->edit = true;
        $fieldsEmple = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
        );
        $this->objEmpleado = empleadoTableClass::getAll($fieldsEmple, true, array(empleadoTableClass::NOMBRE), 'ASC');

        $this->defineView('edit', 'devolucionIncubadora', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('devolucionIncubadora', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('devolucionIncubadora', 'index');
    }
  }

}
