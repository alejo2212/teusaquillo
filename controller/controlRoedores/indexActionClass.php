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
  @author Patricia Arteaga<aprendiz.patricia-819@hotmail.com> */
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      session::getInstance()->deleteAttribute('form');
      $fields = array(
          controlRoedoresTableClass::ID,
          controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR,
          controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO,
          controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE,
          controlRoedoresTableClass::FECHA_REALIZACION,
          controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID,
          controlRoedoresTableClass::PELLETS,
          controlRoedoresTableClass::BLOQUES,
          controlRoedoresTableClass::EVIDENCIA_CONSUMO,
          controlRoedoresTableClass::LUGAR,
          controlRoedoresTableClass::OBSERVACION,
          controlRoedoresTableClass::DELETED_AT,
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

//      $this->countPages = controlRoedoresTableClass::getCountPages();

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
      
      $this->countPages = controlRoedoresTableClass::getCountPagesByWhere($where);
      
      $this->objcontrolRoedores = controlRoedoresTableClass::getAll($fields, true, array(controlRoedoresTableClass::ID), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->defineView('index', 'controlRoedores', session::getInstance()->getFormatOutput());
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
      routing::getInstance()->redirect('controlRoedores', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR, true))
            and
            request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR, true)) !== ''
    ) {
      $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_ADMINISTRADOR, true));
    }

    if (
            request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO, true))
            and
            request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO, true)) !== ''
    ) {
      $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_VETERINARIO, true));
    }

    if (
            request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE, true))
            and
            request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE, true)) !== ''
    ) {
      $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EMPLEADO_ID_RESPONSABLE, true));
    }


    if (
            request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true))
            and
            request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true)) !== ''
    ) {
      $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true));
    }

    if (
            request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID, true))
            and
            request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID, true)) !== ''
    ) {
      $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::SALIDA_INSUMO_DETALLE_ID, true));
    }

    if (
            request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::PELLETS, true))
            and
            request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::PELLETS, true)) !== ''
    ) {
      $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::PELLETS)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::PELLETS, true));
    }

    if (
            request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::BLOQUES, true))
            and
            request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::BLOQUES, true)) !== ''
    ) {
      $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::BLOQUES)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::BLOQUES, true));
    }

    if (
            request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EVIDENCIA_CONSUMO, true))
            and
            request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EVIDENCIA_CONSUMO, true)) !== ''
    ) {
      $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EVIDENCIA_CONSUMO)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::EVIDENCIA_CONSUMO, true));
    }

    if (
            request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::LUGAR, true))
            and
            request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::LUGAR, true)) !== ''
    ) {
      $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::LUGAR)] = request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::LUGAR, true));
    }
    if (
            (
            request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) . '_ini')
            and
            request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) . '_fin')
            and
            request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) . '_fin') !== ''
            )
    ) {
      $where[controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION)] = array(
          request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) . '_ini'),
          request::getInstance()->getPost(controlRoedoresTableClass::getNameField(controlRoedoresTableClass::FECHA_REALIZACION, true) . '_fin'),
      );
    }

    return $where;
  }

}
