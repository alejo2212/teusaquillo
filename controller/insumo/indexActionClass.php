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
            insumoTableClass::ID,
            insumoTableClass::ACTIVO,
            insumoTableClass::DELETED_AT,
            insumoTableClass::NOMBRE,
            insumoTableClass::TIPO_INSUMO_ID,
            insumoTableClass::PRESENTACION_ID,
            insumoTableClass::UNIDAD_MEDIDA_ID,
            insumoTableClass::INVENTARIO_BODEGA
        );
        $this->objtipoInsumo = insumoTableClass::getAll($fields, true, array(insumoTableClass::NOMBRE), 'ASC');
        $this->defineView('index', 'insumo', session::getInstance()->getFormatOutput());
    }

}
