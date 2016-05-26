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
  @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com> */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      session::getInstance()->deleteAttribute('form');
      $fields = array(
          controlCucarronTableClass::ID,
          controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR,
          controlCucarronTableClass::EMPLEADO_ID_VETERINARIO,
          controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE,
          controlCucarronTableClass::FECHA_REALIZACION,
          controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID,
          controlCucarronTableClass::SOLUCION,
          controlCucarronTableClass::FORMA_APLICACION_ID,
          controlCucarronTableClass::AREA_TRATADA,
          controlCucarronTableClass::OBSERVACION,
          controlCucarronTableClass::DELETED_AT,
      );
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

      $this->objEmpleadoV = empleadoTableClass::getVeterinario();
      $this->objEmpleadoA = empleadoTableClass::getAdministrador();

      $fieldsEmpleado = array(
          empleadoTableClass::ID,
          empleadoTableClass::NOMBRE
      );
      $this->objEmpleado = empleadoTableClass::getAll($fieldsEmpleado, true, array(empleadoTableClass::NOMBRE), 'ASC');


//      $this->countPages = controlCucarronTableClass::getCountPages();

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
      
      $this->countPages = controlCucarronTableClass::getCountPagesByWhere($where);
      
      $fieldsFormaAplicacion = array(
          formaAplicacionTableClass::ID,
          formaAplicacionTableClass::NOMBRE
      );
      $this->objformaAplicacion = formaAplicacionTableClass::getAll($fieldsFormaAplicacion, true, array(formaAplicacionTableClass::NOMBRE), 'ASC');

      $this->objcontrolCucarron = controlCucarronTableClass::getAll($fields, true, array(controlCucarronTableClass::ID), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->defineView('index', 'controlCucarron', session::getInstance()->getFormatOutput());
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
      routing::getInstance()->redirect('controlCucarron', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR, true))
            and
            request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR, true)) !== ''
    ) {
      $where[controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR)] = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_ADMINISTRADOR, true));
    }

    if (
            request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_VETERINARIO, true))
            and
            request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_VETERINARIO, true)) !== ''
    ) {
      $where[controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_VETERINARIO)] = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_VETERINARIO, true));
    }

    if (
            request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE, true))
            and
            request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE, true)) !== ''
    ) {
      $where[controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE)] = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::EMPLEADO_ID_RESPONSABLE, true));
    }
    if (
            (
            request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) . '_ini')
            and
            request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) . '_fin')
            and
            request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) . '_fin') !== ''
            )
    ) {
      $where[controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION)] = array(
          request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) . '_ini'),
          request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FECHA_REALIZACION, true) . '_fin'),
      );
    }

    if (
            request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID, true))
            and
            request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID, true)) !== ''
    ) {
      $where[controlCucarronTableClass::getNameField(controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID)] = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::SALIDA_INSUMO_DETALLE_ID, true));
    }

    if (
            request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::SOLUCION, true))
            and
            request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::SOLUCION, true)) !== ''
    ) {
      $where[controlCucarronTableClass::getNameField(controlCucarronTableClass::SOLUCION)] = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::SOLUCION, true));
    }

    if (
            request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FORMA_APLICACION_ID, true))
            and
            request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FORMA_APLICACION_ID, true)) !== ''
    ) {
      $where[controlCucarronTableClass::getNameField(controlCucarronTableClass::FORMA_APLICACION_ID)] = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::FORMA_APLICACION_ID, true));
    }

    if (
            request::getInstance()->hasPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::AREA_TRATADA, true))
            and
            request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::AREA_TRATADA, true)) !== ''
    ) {
      $where[controlCucarronTableClass::getNameField(controlCucarronTableClass::AREA_TRATADA)] = request::getInstance()->getPost(controlCucarronTableClass::getNameField(controlCucarronTableClass::AREA_TRATADA, true));
    }

    return $where;
  }

}
