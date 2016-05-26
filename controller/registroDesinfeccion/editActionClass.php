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
@author Patricia Arteaga <aprendiz.patricia-819@hotmail.com> */
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet('id')) {
        $id = request::getInstance()->getGet('id');
        $this->objregistroDesinfeccion = registroDesinfeccionTableClass::getRegistroDesinfeccionById($id);
        $this->edit = true;
        
        $this->objVerificador = empleadoTableClass::getAdministrador();
        
        $fieldsResponsable = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
        );
        
        $this->objRespon = empleadoTableClass::getAll($fieldsResponsable, true, array(empleadoTableClass::NOMBRE), 'ASC');
       
        $fieldsTipoDesinfeccion = array(
            tipoDesinfeccionTableClass::ID,
            tipoDesinfeccionTableClass::NOMBRE
        );
        
        $this->objtipoDesinfeccion = tipoDesinfeccionTableClass::getAll($fieldsTipoDesinfeccion, true, array(tipoDesinfeccionTableClass::NOMBRE), 'ASC');
        $this->numramadas = ambienteTableClass::getNumRamadas();
        
        
        $this->defineView('edit', 'registroDesinfeccion', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('registroDesinfeccion', 'index');
      }
    } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El cargo que intenta registar ya existe en la base de datos');
                    break;
                case 00006:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                case '22P02':
                    session::getInstance()->setWarning('Ingresar datos validos');
                    break;
                default:
                    session::getInstance()->setError($exc->getMessage());
                    break;
            }
            routing::getInstance()->redirect('registroDesinfeccion', 'index');
            //routing::getInstance()->forward('security', 'new');
        }
  }

}
