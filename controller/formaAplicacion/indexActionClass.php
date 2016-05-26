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
 * @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      session::getInstance()->deleteAttribute('form');
      $fields = array(
          formaAplicacionTableClass::ID,
          formaAplicacionTableClass::NOMBRE,
          formaAplicacionTableClass::DESCRIPCION,
          formaAplicacionTableClass::DELETED_AT
      );
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//           $this->countPages = formaAplicacionTableClass::getCountPages(); 

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

      $this->countPages = formaAplicacionTableClass::getCountPagesByWhere($where);

      $this->objformaAplicacion = formaAplicacionTableClass::getAll($fields, true, array(formaAplicacionTableClass::NOMBRE), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->defineView('index', 'formaAplicacion', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El cargo que intenta registar ya existe en la base de datos');
          break;
        case 00006:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case '22P02':
          session::getInstance()->setWarning('Ingresar datos validos');
          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('formaAplicacion', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(formaAplicacionTableClass::getNameField(formaAplicacionTableClass::NOMBRE, true))
            and
            request::getInstance()->getPost(formaAplicacionTableClass::getNameField(formaAplicacionTableClass::NOMBRE, true)) !== ''
    ) {
      $where[formaAplicacionTableClass::getNameField(formaAplicacionTableClass::NOMBRE)] = request::getInstance()->getPost(formaAplicacionTableClass::getNameField(formaAplicacionTableClass::NOMBRE, true));
    }

    if (
            request::getInstance()->hasPost(formaAplicacionTableClass::getNameField(formaAplicacionTableClass::DESCRIPCION, true))
            and
            request::getInstance()->getPost(formaAplicacionTableClass::getNameField(formaAplicacionTableClass::DESCRIPCION, true)) !== ''
    ) {
      $where[formaAplicacionTableClass::getNameField(formaAplicacionTableClass::DESCRIPCION)] = request::getInstance()->getPost(formaAplicacionTableClass::getNameField(formaAplicacionTableClass::DESCRIPCION, true));
    }

    return $where;
  }

}
