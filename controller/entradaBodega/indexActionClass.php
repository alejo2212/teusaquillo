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
          entradaBodegaTableClass::ID,
          entradaBodegaTableClass::EMPLEADO_ID,
          entradaBodegaTableClass::TRANSPORTADOR_ID,
          entradaBodegaTableClass::FECHA_ENTRADA,
          entradaBodegaTableClass::REMISION,
          entradaBodegaTableClass::OBSERVACION
      );
//            echo 'entro';
//            exit();
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//            $this->countPages = entradaBodegaTableClass::getCountPages();

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

      $this->countPages = entradaBodegaTableClass::getCountPagesByWhere($where);

      $fieldsempleado = array(
          empleadoTableClass::ID,
          empleadoTableClass::NOMBRE
      );
      $fieldstransportador = array(
          transportadorTableClass::ID,
          transportadorTableClass::NOMBRE
      );

      $this->objempleado = empleadoTableClass::getAll($fieldsempleado, true, array(empleadoTableClass::NOMBRE), 'ASC');
      $this->objtransportador = transportadorTableClass::getAll($fieldstransportador, true, array(transportadorTableClass::NOMBRE), 'ASC');

//      $where = array(
//        usuarioTableClass::getNameField(usuarioTableClass::USER) => 'jhon',
//        usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT) => array(
//          '2014-10-30' . ' 00:00',
//          '2014-10-31' . ' 23:59'
//        )
//      );

      $this->objentradaBodega = entradaBodegaTableClass::getAll($fields, true, array(entradaBodegaTableClass::ID), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where); // no olvidemos borrar la variable where
      $this->defineView('index', 'entradaBodega', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('entradaBodega', 'index');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::REMISION, true))
            and
            request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::REMISION, true)) !== ''
    ) {
      $where[entradaBodegaTableClass::getNameField(entradaBodegaTableClass::REMISION)] = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::REMISION, true));
    }
    if (
            request::getInstance()->hasPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::EMPLEADO_ID, true))
            and
            request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::EMPLEADO_ID, true)) !== ''
    ) {
      $where[entradaBodegaTableClass::getNameField(entradaBodegaTableClass::EMPLEADO_ID)] = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::EMPLEADO_ID, true));
    }

    if (
            request::getInstance()->hasPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::TRANSPORTADOR_ID, true))
            and
            request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::TRANSPORTADOR_ID, true)) !== ''
    ) {
      $where[entradaBodegaTableClass::getNameField(entradaBodegaTableClass::TRANSPORTADOR_ID)] = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::TRANSPORTADOR_ID, true));
    }

    return $where;
  }

}
