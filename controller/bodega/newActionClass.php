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
            $bodega = session::getInstance()->getAttribute('form');
            session::getInstance()->setFlash('bodega', $bodega);
        }


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
        $this->defineView('new', 'bodega', session::getInstance()->getFormatOutput());
    }

}
