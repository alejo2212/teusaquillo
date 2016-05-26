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
 * @author Jhonny Alejandro Diaz <Jhonny2212@hotmail.com>
 */
class ajaxValCantInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

        $id = request::getInstance()->getPost('id');
        $idlote = request::getInstance()->getPost('lote');
        $idClasiBo = request::getInstance()->getPost('idclasi');
        $idsalinsu = request::getInstance()->getPost('idsalinsu');
//        exit();
        $this->data = salidaInsumoDetalleTableClass::getCantInsumoById($idClasiBo, $idlote, $id, $idsalinsu);
//          print_r($this->data);
//          exit();
        $this->defineView('ajaxValCantInsumo', 'salidaInsumoDetalle', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('salidaInsumo', 'index');
      }
    } catch (Exception $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('Registro duplicado');
          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('salidaInsumo', 'index');
    }
  }

}
