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
 * @author Jhonny Alejandro Diaz <Jhonny2212@hotmail.com>
 */
class newActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    if (session::getInstance()->hasAttribute('form')) {
      $detallePostu = session::getInstance()->getAttribute('form');
      session::getInstance()->setFlash('detallePostu', $detallePostu);
    }
    $this->idPostura = request::getInstance()->getRequest('idPostura');
    
//    exit();
    $fieldsEmple = array(
        empleadoTableClass::ID,
        empleadoTableClass::NOMBRE
    );
    $this->objclasi = clasificacionPosturaTableClass::getClasificacionPostura();
    $this->contadorclasi = posturaDetalleTableClass::getNumeroClasificaciones($this->idPostura);
//    print_r($this->contadorclasi);
//    foreach ($this->contadorclasi as $datos):
//      echo $datos->clasificacion;
//    endforeach;
//    exit();
    $this->objEmpleado = empleadoTableClass::getAll($fieldsEmple, true, array(empleadoTableClass::NOMBRE), 'ASC');

    $this->defineView('new', 'posturaDetalle', session::getInstance()->getFormatOutput());
  }

}
