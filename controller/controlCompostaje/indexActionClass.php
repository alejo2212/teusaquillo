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
          controlCompostajeTableClass::ID,
          controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR,
          controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO,
          controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE,
          controlCompostajeTableClass::FECHA_REALIZACION,
          controlCompostajeTableClass::CAJON_COMPOSTAJE_ID,
          controlCompostajeTableClass::GALLINAZA_UTILIZADA,
          controlCompostajeTableClass::CANTIDAD_TOTAL_AVES,
          controlCompostajeTableClass::CANTIDAD_MACHOS,
          controlCompostajeTableClass::CANTIDAD_HEMBRAS,
          controlCompostajeTableClass::SALIDA_LOTE_ID,
          controlCompostajeTableClass::OBSERVACION,
          controlCompostajeTableClass::DELETED_AT,
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


//      $this->countPages = controlCompostajeTableClass::getCountPages();

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
      
      $this->countPages = controlCompostajeTableClass::getCountPagesByWhere($where);
      
      $fieldsCajon = array(
          cajonCompostajeTableClass::ID,
          cajonCompostajeTableClass::NUMERO
      );
      $this->objCajon = cajonCompostajeTableClass::getAll($fieldsCajon, true, array(cajonCompostajeTableClass::NUMERO), 'ASC');

      $fieldsSalidalote = array(
          salidaLoteTableClass::ID,
          salidaLoteTableClass::CANTIDAD_HEMBRAS,
          salidaLoteTableClass::CANTIDAD_MACHOS,
          salidaLoteTableClass::CANTIDAD_TOTAL
      );
      $this->objSalidalote = salidaLoteTableClass::getAll($fieldsSalidalote, true, array(salidaLoteTableClass::ID), 'ASC');

      $this->objcontrolCompostaje = controlCompostajeTableClass::getAll($fields, true, array(controlCompostajeTableClass::ID), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->defineView('index', 'controlCompostaje', session::getInstance()->getFormatOutput());
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
      routing::getInstance()->redirect('controlCompostaje', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR, true))
            and
            request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR, true)) !== ''
    ) {
      $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_ADMINISTRADOR, true));
    }

    if (
            request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO, true))
            and
            request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO, true)) !== ''
    ) {
      $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_VETERINARIO, true));
    }

    if (
            request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE, true))
            and
            request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE, true)) !== ''
    ) {
      $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::EMPLEADO_ID_RESPONSABLE, true));
    }
    if (
            (
            request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) . '_ini')
            and
            request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) . '_fin')
            and
            request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) . '_fin') !== ''
            )
    ) {
      $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION)] = array(
          request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) . '_ini'),
          request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::FECHA_REALIZACION, true) . '_fin'),
      );
    }

    if (
            request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CAJON_COMPOSTAJE_ID, true))
            and
            request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CAJON_COMPOSTAJE_ID, true)) !== ''
    ) {
      $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CAJON_COMPOSTAJE_ID)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CAJON_COMPOSTAJE_ID, true));
    }

    if (
            request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::GALLINAZA_UTILIZADA, true))
            and
            request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::GALLINAZA_UTILIZADA, true)) !== ''
    ) {
      $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::GALLINAZA_UTILIZADA)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::GALLINAZA_UTILIZADA, true));
    }
    if (
            request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_TOTAL_AVES, true))
            and
            request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_TOTAL_AVES, true)) !== ''
    ) {
      $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_TOTAL_AVES)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_TOTAL_AVES, true));
    }
    if (
            request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_MACHOS, true))
            and
            request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_MACHOS, true)) !== ''
    ) {
      $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_MACHOS)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_MACHOS, true));
    }
    if (
            request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_HEMBRAS, true))
            and
            request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_HEMBRAS, true)) !== ''
    ) {
      $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_HEMBRAS)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::CANTIDAD_HEMBRAS, true));
    }
    if (
            request::getInstance()->hasPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::SALIDA_LOTE_ID, true))
            and
            request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::SALIDA_LOTE_ID, true)) !== ''
    ) {
      $where[controlCompostajeTableClass::getNameField(controlCompostajeTableClass::SALIDA_LOTE_ID)] = request::getInstance()->getPost(controlCompostajeTableClass::getNameField(controlCompostajeTableClass::SALIDA_LOTE_ID, true));
    }

    return $where;
  }

}
