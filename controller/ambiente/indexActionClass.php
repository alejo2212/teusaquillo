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
 * @author Aleyda Mina Caicedo <aleminac@gmail.com>
 */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      session::getInstance()->deleteAttribute('form');
      $fields = array(
          ambienteTableClass::ID,
          ambienteTableClass::NOMBRE,
          ambienteTableClass::OBSERVACION,
          ambienteTableClass::TIPO_AMBIENTE_ID,
          ambienteTableClass::DELETED_AT
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

      $this->countPages = ambienteTableClass::getCountPagesByWhere($where);

//      $this->countPages = ambienteTableClass::getCountPages();
      $this->objAmbiente = ambienteTableClass::getAll($fields, true, array(ambienteTableClass::NOMBRE), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);


      $fieldsTipoAmb = array(
          tipoAmbienteTableClass::ID,
          tipoAmbienteTableClass::NOMBRE
      );
      $this->objTipoAmb = tipoAmbienteTableClass::getAll($fieldsTipoAmb, true, array(tipoAmbienteTableClass::NOMBRE), 'ASC');


      $this->defineView('index', 'ambiente', session::getInstance()->getFormatOutput());
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
      routing::getInstance()->redirect('ambiente', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true))
            and
            request::getInstance()->getPost(ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true)) !== ''
    ) {
      $where[ambienteTableClass::getNameField(ambienteTableClass::NOMBRE)] = request::getInstance()->getPost(ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true));
    }
    if (
            request::getInstance()->hasPost(ambienteTableClass::getNameField(ambienteTableClass::TIPO_AMBIENTE_ID, true))
            and
            request::getInstance()->getPost(ambienteTableClass::getNameField(ambienteTableClass::TIPO_AMBIENTE_ID, true)) !== ''
    ) {
      $where[ambienteTableClass::getNameField(ambienteTableClass::TIPO_AMBIENTE_ID)] = request::getInstance()->getPost(ambienteTableClass::getNameField(ambienteTableClass::TIPO_AMBIENTE_ID, true));
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
