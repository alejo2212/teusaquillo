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
        $this->objMante = mantenimientoTableClass::getMantenimiento($id);
        $this->edit = true;
        $fieldsTipoMante = array(
            tipoMantenimientoTableClass::ID,
            tipoMantenimientoTableClass::NOMBRE
        );
        $this->objTipoMante = tipoMantenimientoTableClass::getAll($fieldsTipoMante, true, array(tipoMantenimientoTableClass::NOMBRE), 'ASC');

        $fieldsMaquina = array(
            maquinaTableClass::ID,
            maquinaTableClass::DESCRIPCION
        );
        $this->objMaquina = maquinaTableClass::getAll($fieldsMaquina, true, array(maquinaTableClass::DESCRIPCION), 'ASC');

        $fieldsEmple = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
        );
        $this->objEmpleado = empleadoTableClass::getAll($fieldsEmple, true, array(empleadoTableClass::NOMBRE), 'ASC');

        $this->defineView('edit', 'mantenimiento', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('mantenimiento', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('mantenimiento', 'index');
    }
  }

}
