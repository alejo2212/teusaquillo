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
  @author jhon fernando hoyos diaz <aprendiz.jhonfernandohoyosdiaz@gmail.com> */
class editActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasGet('id')) {
                $id = request::getInstance()->getGet('id');
                $this->objinsumo = insumoTableClass::getInsumoById($id);
                $this->edit = true;
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
                $this->defineView('edit', 'insumo', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('insumo', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('insumo', 'index');
        }
    }

}
