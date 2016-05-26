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
  @author jhon fernando hoyos diaz <aprendiz.jhonfernandohoyosdiaz@gmail.com> */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      session::getInstance()->deleteAttribute('form');
      $fields = array(
          alistamientoReparacionTableClass::ID,
          alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID,
          alistamientoReparacionTableClass::TIPO_REPARACION_ID,
          alistamientoReparacionTableClass::FECHA_INICIO,
          alistamientoReparacionTableClass::FECHA_FIN,
      );
//            echo 'entro';
//            exit();
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//            $this->countPages = alistamientoReparacionTableClass::getCountPages();

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

      $this->countPages = alistamientoReparacionTableClass::getCountPagesByWhere($where);

      $fieldstiporepa = array(
          tipoReparacionTableClass::ID,
          tipoReparacionTableClass::NOMBRE
      );

      $this->objtiporepa = tipoReparacionTableClass::getAll($fieldstiporepa, true, array(tipoReparacionTableClass::NOMBRE), 'ASC');

//      $where = array(
//        usuarioTableClass::getNameField(usuarioTableClass::USER) => 'jhon',
//        usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT) => array(
//          '2014-10-30' . ' 00:00',
//          '2014-10-31' . ' 23:59'
//        )
//      );

      $this->objalistamientoReparacion = alistamientoReparacionTableClass::getAll($fields, true, array(alistamientoReparacionTableClass::ID), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where); // no olvidemos borrar la variable where
      $this->defineView('index', 'alistamientoReparacion', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('alistamientoReparacion', 'index');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID, true))
            and
            request::getInstance()->getPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID, true)) !== ''
    ) {
      $where[alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID)] = request::getInstance()->getPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::REGISTRO_ALISTAMIENTO_ID, true));
    }
    if (
            request::getInstance()->hasPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::TIPO_REPARACION_ID, true))
            and
            request::getInstance()->getPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::TIPO_REPARACION_ID, true)) !== ''
    ) {
      $where[alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::TIPO_REPARACION_ID)] = request::getInstance()->getPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::TIPO_REPARACION_ID, true));
    }

    if (
            request::getInstance()->hasPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_INICIO, true))
            and
            request::getInstance()->getPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_INICIO, true)) !== ''
    ) {
      $where[alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_INICIO)] = request::getInstance()->getPost(alistamientoReparacionTableClass::getNameField(alistamientoReparacionTableClass::FECHA_INICIO, true));
    }

    return $where;
  }

}
