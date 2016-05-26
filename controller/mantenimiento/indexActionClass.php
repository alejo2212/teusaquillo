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
          mantenimientoTableClass::ID,
          mantenimientoTableClass::MAQUINA_ID,
          mantenimientoTableClass::EMPLEADO_ID,
          mantenimientoTableClass::TIPO_MANTENIMIENTO_ID,
          mantenimientoTableClass::FECHA_INICIO,
          mantenimientoTableClass::FECHA_FIN,
          mantenimientoTableClass::CAUSA,
          mantenimientoTableClass::ARREGLO,
          mantenimientoTableClass::OBSERVACION
      );

      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//      $this->countPages = mantenimientoTableClass::getCountPages();
//      exit();
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
      
      $this->countPages = mantenimientoTableClass::getCountPagesByWhere($where);

      $fieldsTipoMante = array(
          tipoMantenimientoTableClass::ID,
          tipoMantenimientoTableClass::NOMBRE
      );
      $this->objTipoMante = tipoMantenimientoTableClass::getAll($fieldsTipoMante, true, array(tipoMantenimientoTableClass::NOMBRE), 'ASC');

      $fieldsMaquina = array(
          maquinaTableClass::ID,
          maquinaTableClass::DESCRIPCION
      );
      $this->objMaquina = maquinaTableClass::getAll($fieldsMaquina, true, array(maquinaTableClass::DESCRIPCION), 'ASC');

      $fieldsEmple = array(
          empleadoTableClass::ID,
          empleadoTableClass::NOMBRE
      );
      $this->objEmpleado = empleadoTableClass::getAll($fieldsEmple, true, array(empleadoTableClass::NOMBRE), 'ASC');


      $this->objMante = mantenimientoTableClass::getAll($fields, true, array(mantenimientoTableClass::ID), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->defineView('index', 'mantenimiento', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El Mantenimiento que intenta registar ya existe en la base de datos');
          break;
        case 00006:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case 00007:
          session::getInstance()->setWarning($exc->getMessage());
          break;
//        case '22P02':
//          session::getInstance()->setWarning('Ingresar datos validos');
//          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('mantenimiento', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::MAQUINA_ID, true))
            and
            request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::MAQUINA_ID, true)) !== ''
    ) {
      $where[mantenimientoTableClass::getNameField(mantenimientoTableClass::MAQUINA_ID)] = request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::MAQUINA_ID, true));
    }
    if (
            request::getInstance()->hasPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::EMPLEADO_ID, true))
            and
            request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::EMPLEADO_ID, true)) !== ''
    ) {
      $where[mantenimientoTableClass::getNameField(mantenimientoTableClass::EMPLEADO_ID)] = request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::EMPLEADO_ID, true));
    }
    if (
            request::getInstance()->hasPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::TIPO_MANTENIMIENTO_ID, true))
            and
            request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::TIPO_MANTENIMIENTO_ID, true)) !== ''
    ) {
      $where[mantenimientoTableClass::getNameField(mantenimientoTableClass::TIPO_MANTENIMIENTO_ID)] = request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::TIPO_MANTENIMIENTO_ID, true));
    }
    if (
            (
            request::getInstance()->hasPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_INICIO, true) . '_ini')
            and
            request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_INICIO, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_INICIO, true) . '_fin')
            and
            request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_INICIO, true) . '_fin') !== ''
            )
    ) {
      $where[mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_INICIO)] = array(
          request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_INICIO, true) . '_ini'),
          request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_INICIO, true) . '_fin'),
      );
    }
    if (
            (
            request::getInstance()->hasPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_FIN, true) . '_ini')
            and
            request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_FIN, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_FIN, true) . '_fin')
            and
            request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_FIN, true) . '_fin') !== ''
            )
    ) {
      $where[mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_FIN)] = array(
          request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_FIN, true) . '_ini'),
          request::getInstance()->getPost(mantenimientoTableClass::getNameField(mantenimientoTableClass::FECHA_FIN, true) . '_fin'),
      );
    }
    return $where;
  }

}
