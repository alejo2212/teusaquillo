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
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        $fields = array(
        tipoAmbienteTableClass::ID,
        tipoAmbienteTableClass::NOMBRE,
        tipoAmbienteTableClass::DESCRIPCION,
        tipoAmbienteTableClass::OBSERVACION,
        tipoAmbienteTableClass::DELETED_AT
                
        );
        $this->objTipoambiente = tipoAmbienteTableClass::getAll($fields, true, array(tipoAmbienteTableClass::NOMBRE), 'ASC');
        $this->defineView('index', 'tipoAmbiente', session::getInstance()->getFormatOutput());
    }

}
