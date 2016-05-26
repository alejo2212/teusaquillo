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
        $this->objSalida = salidaincubadoraTableClass::getSalidaIncubadora($id);
        $this->edit = true;

        $this->idanual = salidaincubadoraTableClass::getIdAnual($id);
//    print_r($this->idanual);
//    exit();
        if ($this->idanual->idanual != 365) {
          if ($this->idanual->idanual == '') {
            $this->idanual->idanual = 1;
          } else {
            $this->idanual->idanual = $this->idanual->idanual + 1;
          }
        } else {
          $this->idanual->idanual = 1;
        }

        $fieldsResponsable = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
        );
        $this->objEmpleado = empleadoTableClass::getAll($fieldsResponsable, true, array(empleadoTableClass::NOMBRE), 'ASC');
//        $fields = array(
//            incubadoraTableClass::ID,
//            incubadoraTableClass::NOMBRE
//        );
//        $this->objincubadora = incubadoraTableClass::getAll($fields, true, array(incubadoraTableClass::NOMBRE), 'ASC');
        $this->defineView('edit', 'salidaIncubadora', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('salidaIncubadora', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('salidaIncubadora', 'index');
    }
  }

}
