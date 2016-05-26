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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class detailActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasRequest('id')) {
        $id = request::getInstance()->getRequest('id');
        $fields = array(
            usuarioCredencialTableClass::ID,
            usuarioCredencialTableClass::USUARIO_ID,
            usuarioCredencialTableClass::CREDENCIAL_ID,
            usuarioCredencialTableClass::CREATED_AT
        );

        $this->page = 0;

        if (request::getInstance()->hasGet('page')) {
          $this->page = (request::getInstance()->getGet('page') - 1);
        }

        $this->countPages = usuarioCredencialTableClass::getCountPages();

        $where = array(
            usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID) => $id
        );

        $this->objUsuarioCredenciales = usuarioCredencialTableClass::getAll($fields, true, array(usuarioCredencialTableClass::CREDENCIAL_ID), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
        $this->defineView('indexUsuarioCredencial', 'security', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('security', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('security', 'index');
    }
  }

}
