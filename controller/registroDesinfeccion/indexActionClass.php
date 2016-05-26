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
          registroDesinfeccionTableClass::ID,
          registroDesinfeccionTableClass::FECHA_REALIZACION,
          registroDesinfeccionTableClass::FECHA_TERMINADO,
          registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE,
          registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR,
          registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID,
          registroDesinfeccionTableClass::SOLUCION,
          registroDesinfeccionTableClass::OBSERVACION,
          registroDesinfeccionTableClass::TIPO_DESINFECCION_ID,
          registroDesinfeccionTableClass::CANT_PEDILUVIOS,
          registroDesinfeccionTableClass::DES_BODEGA,
          registroDesinfeccionTableClass::DES_PEDILUVIOS,
          registroDesinfeccionTableClass::DES_RAMDAS,
          registroDesinfeccionTableClass::DELETED_AT
      );
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//      $this->countPages = registroDesinfeccionTableClass::getCountPages();

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
      
      $this->countPages = registroDesinfeccionTableClass::getCountPagesByWhere($where);
      
      $fieldsResponsable = array(
          empleadoTableClass::ID,
          empleadoTableClass::NOMBRE
      );
      $this->objEmpleado = empleadoTableClass::getAll($fieldsResponsable, true, array(empleadoTableClass::NOMBRE), 'ASC');

      $this->objEmpleadoVeri = empleadoTableClass::getAdministrador();
      
      $fieldsTipoDesinfeccion = array(
          tipoDesinfeccionTableClass::ID,
          tipoDesinfeccionTableClass::NOMBRE
      );
      $this->objtipoDesinfeccion = tipoDesinfeccionTableClass::getAll($fieldsTipoDesinfeccion, true, array(tipoDesinfeccionTableClass::NOMBRE), 'ASC');

      $this->objregistroDesinfeccion = registroDesinfeccionTableClass::getAll($fields, true, array(registroDesinfeccionTableClass::FECHA_REALIZACION), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->defineView('index', 'registroDesinfeccion', session::getInstance()->getFormatOutput());
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
      routing::getInstance()->redirect('registroDesinfeccion', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();

    if (
            (
            request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) . '_ini')
            and
            request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) . '_fin')
            and
            request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) . '_fin') !== ''
            )
    ) {
      $where[registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION)] = array(
          request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) . '_ini'),
          request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true) . '_fin'),
      );
    }

    if (
            (
            request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) . '_ini')
            and
            request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) . '_fin')
            and
            request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) . '_fin') !== ''
            )
    ) {
      $where[registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO)] = array(
          request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) . '_ini'),
          request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true) . '_fin'),
      );
    }

    if (
            request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE, true))
            and
            request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE, true)) !== ''
    ) {
      $where[registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE)] = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE, true));
    }


    if (
            request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR, true))
            and
            request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR, true)) !== ''
    ) {
      $where[registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR)] = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR, true));
    }

    if (
            request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID, true))
            and
            request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID, true)) !== ''
    ) {
      $where[registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID)] = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID, true));
    }

    if (
            request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SOLUCION, true))
            and
            request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SOLUCION, true)) !== ''
    ) {
      $where[registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SOLUCION)] = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SOLUCION, true));
    }

    if (
            request::getInstance()->hasPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::TIPO_DESINFECCION_ID, true))
            and
            request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::TIPO_DESINFECCION_ID, true)) !== ''
    ) {
      $where[registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::TIPO_DESINFECCION_ID)] = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::TIPO_DESINFECCION_ID, true));
    }

    return $where;
  }

}
