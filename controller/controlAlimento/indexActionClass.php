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
          controlAlimentoTableClass::ID,
          controlAlimentoTableClass::AMBIENTE_HISTORIAL_LOTE_ID,
          controlAlimentoTableClass::SALIDA_INSUMO_DETALLE_ID,
          controlAlimentoTableClass::ID_EMPLEADO,
          controlAlimentoTableClass::SEXO,
          controlAlimentoTableClass::CANTIDAD,
          controlAlimentoTableClass::FECHA,
          controlAlimentoTableClass::SEMANA,
          controlAlimentoTableClass::OBSERVACION,
          controlAlimentoTableClass::DELETED_AT
      );

      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//      $this->countPages = controlAlimentoTableClass::getCountPages();
      $fieldsResponsable = array(
          empleadoTableClass::ID,
          empleadoTableClass::NOMBRE
      );
      $this->objEmpleado = empleadoTableClass::getAll($fieldsResponsable, true, array(empleadoTableClass::NOMBRE), 'ASC');

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
      
      $this->countPages = controlAlimentoTableClass::getCountPagesByWhere($where);
      
      $this->objControlAlimento = controlAlimentoTableClass::getAll($fields, true, array(controlAlimentoTableClass::FECHA), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->defineView('index', 'controlAlimento', session::getInstance()->getFormatOutput());
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
      routing::getInstance()->redirect('controlAlimento', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();
    if (
            request::getInstance()->hasPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID_EMPLEADO, true))
            and
            request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID_EMPLEADO, true)) !== ''
    ) {
      $where[controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID_EMPLEADO)] = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::ID_EMPLEADO, true));
    }

    if (
            request::getInstance()->hasPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEXO, true))
            and
            request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEXO, true)) !== ''
    ) {
      $where[controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEXO)] = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEXO, true));
    }
    if (
            request::getInstance()->hasPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEMANA, true))
            and
            request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEMANA, true)) !== ''
    ) {
      $where[controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEMANA)] = request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::SEMANA, true));
    }
    if (
            (
              request::getInstance()->hasPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA, true) . '_ini')
              and 
              request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA, true) . '_ini') !== ''
            )
            and
            (
              request::getInstance()->hasPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA, true) . '_fin')
              and
              request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA, true) . '_fin') !== ''
            )
       ) {
      $where[controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA)] = array(
          request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA, true) . '_ini'),
          request::getInstance()->getPost(controlAlimentoTableClass::getNameField(controlAlimentoTableClass::FECHA, true) . '_fin'),
      );
    }
    return $where;
  }

}
