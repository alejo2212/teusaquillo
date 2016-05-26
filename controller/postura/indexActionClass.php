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
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      session::getInstance()->deleteAttribute('form');
      $fields = array(
          posturaTableClass::ID,
          posturaTableClass::LOTE_ID,
          posturaTableClass::AMBIENTE_ID,
          posturaTableClass::FECHA
      );
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//      $this->countPages = posturaTableClass::getCountPages();
      $where = $this->filters();
      
      if (request::getInstance()->hasGet('r') == 'true') {
        session::getInstance()->deleteAttribute('where');
      }
      if (session::getInstance()->hasAttribute('where')) {
        $where = session::getInstance()->getAttribute('where');
//        session::getInstance()->setFlash('where', $where);
//        echo 'hay atributo';
      } else {
        if ($where != null) {
          session::getInstance()->setAttribute('where', $where);
//          echo 'creo atributo';
        }
      }
      
      $this->countPages = posturaTableClass::getCountPagesByWhere($where);
      
      $fieldslote = array(
          loteTableClass::ID,
          loteTableClass::LOTE
      );
      $fieldsambiente = array(
          ambienteTableClass::ID,
          ambienteTableClass::NOMBRE
      );
      $this->objambiente = ambienteTableClass::getRamadas();
      $this->objPostura = posturaTableClass::getAll($fields, true, array(posturaTableClass::FECHA), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->objlote = loteTableClass::getAll($fieldslote, true, array(loteTableClass::LOTE), 'ASC');
      
      $this->defineView('index', 'postura', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La Postura que intenta registar ya existe en la base de datos');
          break;
        case 00006:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case 00007:
          session::getInstance()->setWarning($exc->getMessage());
          break;
//        case '22P02':
//          session::getInstance()->setWarning('Ingresar datos validos');
//          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('postura', 'new');
      //routing::getInstance()->forward('security', 'new');
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
          request::getInstance()->getPost(posturaTableClass::getNameField(posturaTableClass::FECHA, true) . '_fin'),
      );
    }
    return $where;
  }

}
