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
          clasificacionPosturaTableClass::ID,
//          clasificacionPosturaTableClass::CLASIFICACION_POSTURA_ID,
          clasificacionPosturaTableClass::NOMBRE,
          clasificacionPosturaTableClass::DESCRIPCION,
          clasificacionPosturaTableClass::OBSERVACION
      );
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//      $this->countPages = clasificacionPosturaTableClass::getCountPages();

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

      $this->countPages = clasificacionPosturaTableClass::getCountPagesByWhere($where);

      $this->objclasificacionPostura = clasificacionPosturaTableClass::getAll($fields, true, array(clasificacionPosturaTableClass::NOMBRE), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);

//      $this->objclasi = clasificacionPosturaTableClass::getClasificaciones();

      $this->defineView('index', 'clasificacionPostura', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El cargo que intenta registar ya existe en la base de datos');
          break;
        case 00006:
          session::getInstance()->setWarning($exc->getMessage());
          break;
//        case '22P02':
//          session::getInstance()->setWarning('Seleccione una clasificacion de Postura Valido');
//          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('clasificacionPostura', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();
    if (
            request::getInstance()->hasPost(clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::NOMBRE, true))
            and
            request::getInstance()->getPost(clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::NOMBRE, true)) !== ''
    ) {
      $where[clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::NOMBRE)] = request::getInstance()->getPost(clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::NOMBRE, true));
    }
//    if (
//            request::getInstance()->hasPost(clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::CLASIFICACION_POSTURA_ID, true))
//            and
//            request::getInstance()->getPost(clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::CLASIFICACION_POSTURA_ID, true)) !== ''
//    ) {
//      $where[clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::CLASIFICACION_POSTURA_ID)] = request::getInstance()->getPost(clasificacionPosturaTableClass::getNameField(clasificacionPosturaTableClass::CLASIFICACION_POSTURA_ID, true));
//    }
//      $where[localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID)] <> 0;
    return $where;
  }

}
