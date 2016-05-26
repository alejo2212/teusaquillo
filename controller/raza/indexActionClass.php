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
 * @author Aleyda Mina Caicedo <aleminac@gmail.com>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      session::getInstance()->deleteAttribute('form');
      $fields = array(
          razaTableClass::ID,
          razaTableClass::NOMBRE,
          razaTableClass::DESCRIPCION,
          razaTableClass::FOTO,
          razaTableClass::DELETED_AT
      );
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }
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

      $this->countPages = razaTableClass::getCountPagesByWhere($where);
//      $this->countPages = razaTableClass::getCountPages();
      $this->objRaza = razaTableClass::getAll($fields, true, array(razaTableClass::ID), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->defineView('index', 'raza', session::getInstance()->getFormatOutput());
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
      routing::getInstance()->redirect('raza', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(razaTableClass::getNameField(razaTableClass::NOMBRE, true))
            and
            request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::NOMBRE, true)) !== ''
    ) {
      $where[razaTableClass::getNameField(razaTableClass::NOMBRE)] = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::NOMBRE, true));
    }
    if (
            request::getInstance()->hasPost(razaTableClass::getNameField(razaTableClass::DESCRIPCION, true))
            and
            request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::DESCRIPCION, true)) !== ''
    ) {
      $where[razaTableClass::getNameField(razaTableClass::DESCRIPCION)] = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::DESCRIPCION, true));
    }


//        if (
//                (
//                request::getInstance()->hasPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_ini')
//                and
//                request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_ini') !== ''
//                )
//                and (
//                request::getInstance()->hasPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_fin')
//                and
//                request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_fin') !== ''
//                )
//        ) {
//            $where[usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT)] = array(
//                request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_ini'),
//                request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT, true) . '_fin'),
//            );
//        }


    return $where;
  }

}
