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
 * @author Jhonny Alejandro Diaz <jhonny2212@hotmail.com>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        $fields = array(
            sesionTableClass::ID,
            sesionTableClass::USUARIO_ID,
            sesionTableClass::CREATED_AT,
            sesionTableClass::HASH_COOKIE,
            sesionTableClass::IP_ADDRESS
            //usuarioTableClass::USER
        );
        $this->objSesion = sesionTableClass::getAll($fields, true, array(sesionTableClass::ID), 'ASC');
        //$this->objSesion = sesionTableClass::getUserAndPassword(sesionTableClass::IP_ADDRESS, sesionTableClass::HASH_COOKIE);
        $this->defineView('index', 'sesion', session::getInstance()->getFormatOutput());
    }

}
