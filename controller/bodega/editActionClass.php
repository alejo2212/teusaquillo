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
                $this->objbodega = bodegaTableClass::getBodegaById($id);
                $this->edit = true;
                $fieldslote = array(
                    loteTableClass::ID,
                    loteTableClass::LOTE
                );
                $fieldsbodegaclasi = array(
                    bodegaClasificacionTableClass::ID,
                    bodegaClasificacionTableClass::NOMBRE
                );
                $fieldsinsumo = array(
                    insumoTableClass::ID,
                    insumoTableClass::NOMBRE
                );

                $this->objlote = loteTableClass::getAll($fieldslote, true, array(loteTableClass::LOTE), 'ASC');
                $this->objclasibodega = bodegaClasificacionTableClass::getAll($fieldsbodegaclasi, true, array(bodegaClasificacionTableClass::NOMBRE), 'ASC');
                $this->objinsu = insumoTableClass::getAll($fieldsinsumo, true, array(insumoTableClass::NOMBRE), 'ASC');
                $this->defineView('edit', 'bodega', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('bodega', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setError($exc->getMessage());
            routing::getInstance()->redirect('bodega', 'index');
        }
    }

}
