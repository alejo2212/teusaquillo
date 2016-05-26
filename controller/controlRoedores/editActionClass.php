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
        $this->objcontrolRoedores = controlRoedoresTableClass::getControlRoedoresById($id);
        $this->edit = true;
        $this->objAdmin = empleadoTableClass::getAdministrador();
        $this->objVeterinario = empleadoTableClass::getVeterinario();
        $fieldsResponsable = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
        );
        
        $this->objEmpleado = empleadoTableClass::getAll($fieldsResponsable, true, array(empleadoTableClass::NOMBRE), 'ASC');
       
        
        $this->defineView('edit', 'controlRoedores', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('controlRoedores', 'index');
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
            routing::getInstance()->redirect('controlRoedores', 'index');
            //routing::getInstance()->forward('security', 'new');
        }
  }

}
