<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of newActionClass
 *
  @author jhon fernando hoyos diaz <aprendiz.jhonfernandohoyosdiaz@gmail.com> */
class newActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        if (session::getInstance()->hasAttribute('form')) {
            $insumo = session::getInstance()->getAttribute('form');
            session::getInstance()->setFlash('insumo', $insumo);
        }
        $fieldstipoinsu = array(
            tipoInsumoTableClass::ID,
            tipoInsumoTableClass::NOMBRE
        );
        $fieldspresen = array(
            presentacionTableClass::ID,
            presentacionTableClass::NOMBRE
        );
        $fieldsunimedida = array(
            unidadMedidaTableClass::ID,
            unidadMedidaTableClass::NOMBRE
        );
        $this->objtipoinsumo = tipoInsumoTableClass::getAll($fieldstipoinsu, true, array(tipoInsumoTableClass::NOMBRE), 'ASC');
        $this->objpresentacion = presentacionTableClass::getAll($fieldspresen, true, array(presentacionTableClass::NOMBRE), 'ASC');
        $this->objunidadmedida = unidadMedidaTableClass::getAll($fieldsunimedida, true, array(unidadMedidaTableClass::NOMBRE), 'ASC');
        $this->defineView('new', 'insumo', session::getInstance()->getFormatOutput());
    }

}
