<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of defaultClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class informeActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {

    try {
      session::getInstance()->deleteAttribute('form');
      $lote = request::getInstance()->getPost(posturaTableClass::getNameField(posturaTableClass::LOTE_ID, true));
      
      $this->Validations($lote);
      
      $fields = array(
          posturaTableClass::ID,
          posturaTableClass::LOTE_ID,
          posturaTableClass::AMBIENTE_ID,
          posturaTableClass::FECHA
      );
      $fieldslote = array(
          loteTableClass::ID,
          loteTableClass::LOTE
      );
      $fieldsambiente = array(
          ambienteTableClass::ID,
          ambienteTableClass::NOMBRE
      );
      $where = $this->filters();

//      print_r($where);
//      foreach ($where as $data):
//        $fIni = $data[0];
//        $fFin = $data[1];
//      endforeach;
//      exit();
      $this->objambiente = ambienteTableClass::getRamadas();
      $this->objlote = loteTableClass::getAll($fieldslote, true, array(loteTableClass::LOTE), 'ASC');
//      $this->objPostura = posturaTableClass::getAll($fields, true, array(posturaTableClass::FECHA), 'DESC', null, null, $where);
//      $this->objPostura = posturaTableClass::getPostuIncuConsu($fIni, $fFin);
      $this->objPostura = $where;
//      print_r($this->objPostura);
      $this->olote = $this->objPostura['postura.lote_id'];
      $this->obfecha = $this->objPostura['postura.fecha'];
//      print_r($this->obfecha);
//      exit();
      $this->defineView('informe', 'postura', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 00010:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('postura', 'index');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(posturaTableClass::getNameField(posturaTableClass::LOTE_ID, true))
            and
            request::getInstance()->getPost(posturaTableClass::getNameField(posturaTableClass::LOTE_ID, true)) !== ''
    ) {
      $where[posturaTableClass::getNameField(posturaTableClass::LOTE_ID)] = request::getInstance()->getPost(posturaTableClass::getNameField(posturaTableClass::LOTE_ID, true));
    }
    if (
            request::getInstance()->hasPost(posturaTableClass::getNameField(posturaTableClass::AMBIENTE_ID, true))
            and
            request::getInstance()->getPost(posturaTableClass::getNameField(posturaTableClass::AMBIENTE_ID, true)) !== ''
    ) {
      $where[posturaTableClass::getNameField(posturaTableClass::AMBIENTE_ID)] = request::getInstance()->getPost(posturaTableClass::getNameField(posturaTableClass::AMBIENTE_ID, true));
    }
    if (
            (
            request::getInstance()->hasPost(posturaTableClass::getNameField(posturaTableClass::FECHA, true) . '_ini')
            and
            request::getInstance()->getPost(posturaTableClass::getNameField(posturaTableClass::FECHA, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(posturaTableClass::getNameField(posturaTableClass::FECHA, true) . '_fin')
            and
            request::getInstance()->getPost(posturaTableClass::getNameField(posturaTableClass::FECHA, true) . '_fin') !== ''
            )
    ) {
      $where[posturaTableClass::getNameField(posturaTableClass::FECHA)] = array(
          request::getInstance()->getPost(posturaTableClass::getNameField(posturaTableClass::FECHA, true) . '_ini'),
          request::getInstance()->getPost(posturaTableClass::getNameField(posturaTableClass::FECHA, true) . '_fin')
      );
    }
    return $where;
  }
  
  public function Validations($lote) {

    if (!is_numeric($lote) || $lote === "") {
      throw new PDOException('Seleccione un Lote Valido', 00010);
    }
  }

}
