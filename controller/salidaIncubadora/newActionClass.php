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
      $salida = session::getInstance()->getAttribute('form');
      session::getInstance()->setFlash('salida', $salida);
    }

    $id = salidaincubadoraTableClass::getIdSalida();
    $this->idanual = salidaincubadoraTableClass::getIdAnual($id);

    $fechahoy = strftime('%Y-%m-%dT%H:%M:%S', strtotime(date(config::getFormatTimestamp())));
    $newLeng = strlen($fechahoy) - 15;
    $anoActual = substr($fechahoy, 0, $newLeng);

    $fechaRegistro = salidaincubadoraTableClass::getFechaById($id);
    $newLeng = strlen($fechaRegistro) - 15;
    $anoUltimoRegistro = substr($fechaRegistro, 0, $newLeng);
//    print_r($this->idanual);
//    exit();
    if ($this->idanual->idanual == '') {
      $this->idanual->idanual = 1;
    } else {
      if ($anoActual == $anoUltimoRegistro) {
        $this->idanual->idanual = $this->idanual->idanual + 1;
      }  else {
        $this->idanual->idanual = 1;
      }
    }
//    if ($this->idanual->idanual != 365) {
//      if ($this->idanual->idanual == '') {
//        $this->idanual->idanual = 1;
//      } else {
//        $this->idanual->idanual = $this->idanual->idanual + 1;
//      }
//    } else {
//      $this->idanual->idanual = 1;
//    }

//    exit();
    $this->Npedido = (salidaincubadoraTableClass::getNpedido()) + 1;

    $fieldsResponsable = array(
        empleadoTableClass::ID,
        empleadoTableClass::NOMBRE
    );
    $this->objEmpleado = empleadoTableClass::getAll($fieldsResponsable, true, array(empleadoTableClass::NOMBRE), 'ASC');
//    $fields = array(
//        incubadoraTableClass::ID,
//        incubadoraTableClass::NOMBRE
//    );
//    $this->objincubadora = incubadoraTableClass::getAll($fields, true, array(incubadoraTableClass::NOMBRE), 'ASC');

    $this->defineView('new', 'salidaIncubadora', session::getInstance()->getFormatOutput());
  }

}
