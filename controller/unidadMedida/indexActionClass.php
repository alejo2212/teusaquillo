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
  @author jhon fernando hoyos diaz <aprendiz.jhonfernandohoyosdiaz@gmail.com> */
class indexActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        $fields = array(
            unidadMedidaTableClass::ID,
            unidadMedidaTableClass::NOMBRE,
            unidadMedidaTableClass::SIGLA,
            unidadMedidaTableClass::OBSERVACION,
            unidadMedidaTableClass::DELETED_AT
        );
        $this->objunidadMedida= unidadMedidaTableClass::getAll($fields, true, array(unidadMedidaTableClass::NOMBRE), 'ASC');
        $this->defineView('index', 'unidadMedida', session::getInstance()->getFormatOutput());
    }

}
