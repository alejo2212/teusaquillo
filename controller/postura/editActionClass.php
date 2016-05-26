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
        $this->objPostura = posturaTableClass::getPostura($id);
        $this->edit = true;
        $fieldslote = array(
            loteTableClass::ID,
            loteTableClass::LOTE
        );
        $fieldsambiente = array(
            ambienteTableClass::ID,
            ambienteTableClass::NOMBRE
        );
        $this->objambiente = ambienteTableClass::getRamadas();
        $this->objlote = loteTableClass::getAll($fieldslote, true, array(loteTableClass::LOTE), 'ASC');
        $this->defineView('edit', 'postura', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('postura', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('postura', 'index');
    }
  }

}
