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
          cajonCompostajeTableClass::ID,
          cajonCompostajeTableClass::NUMERO,
          cajonCompostajeTableClass::OBSERVACION,
          cajonCompostajeTableClass::DELETED_AT
      );
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//            $this->countPages = cajonCompostajeTableClass::getCountPages();

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

      $this->countPages = cajonCompostajeTableClass::getCountPagesByWhere($where);

      $this->objcajonCompostaje = cajonCompostajeTableClass::getAll($fields, true, array(cajonCompostajeTableClass::NUMERO), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->defineView('index', 'cajonCompostaje', session::getInstance()->getFormatOutput());
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
      routing::getInstance()->redirect('cajonCompostaje', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::NUMERO, true))
            and
            request::getInstance()->getPost(cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::NUMERO, true)) !== ''
    ) {
      $where[cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::NUMERO)] = request::getInstance()->getPost(cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::NUMERO, true));
    }

    return $where;
  }

}
