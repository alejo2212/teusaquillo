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
          maquinaTableClass::ID,
          maquinaTableClass::CLASIFICACION_MAQUINA_ID,
          maquinaTableClass::FECHA_INGRESO,
          maquinaTableClass::DESCRIPCION,
          maquinaTableClass::CODIGO,
          maquinaTableClass::REFERENCIA,
          maquinaTableClass::FECHA_MANTENIMIENTO,
          maquinaTableClass::INTERVALO_MANTENIMIENTO,
          maquinaTableClass::ACTIVADO,
          maquinaTableClass::VALOR
      );
      $fieldsMaquina = array(
          clasificacionMaquinaTableClass::ID,
          clasificacionMaquinaTableClass::NOMBRE
      );

      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//      $this->countPages = maquinaTableClass::getCountPages();

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

      $this->countPages = maquinaTableClass::getCountPagesByWhere($where);

      $this->objMaquina = maquinaTableClass::getAll($fields, true, array(maquinaTableClass::FECHA_INGRESO), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      $this->objClasiMaquina = clasificacionMaquinaTableClass::getAll($fieldsMaquina, true, array(clasificacionMaquinaTableClass::NOMBRE), 'ASC');
      $this->defineView('index', 'maquina', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La Maquina que intenta registar ya existe en la base de datos');
          break;
        case 00006:
          session::getInstance()->setWarning($exc->getMessage());
          break;
//        case '22P02':
//          session::getInstance()->setWarning('Ingresar datos validos');
//          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('maquina', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();
    if (
            (
            request::getInstance()->hasPost(maquinaTableClass::getNameField(maquinaTableClass::FECHA_MANTENIMIENTO, true) . '_ini')
            and
            request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::FECHA_MANTENIMIENTO, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(maquinaTableClass::getNameField(maquinaTableClass::FECHA_MANTENIMIENTO, true) . '_fin')
            and
            request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::FECHA_MANTENIMIENTO, true) . '_fin') !== ''
            )
    ) {
      $where[maquinaTableClass::getNameField(maquinaTableClass::FECHA_MANTENIMIENTO)] = array(
          request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::FECHA_MANTENIMIENTO, true) . '_ini'),
          request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::FECHA_MANTENIMIENTO, true) . '_fin'),
      );
    }
    if (
            (
            request::getInstance()->hasPost(maquinaTableClass::getNameField(maquinaTableClass::FECHA_INGRESO, true) . '_ini')
            and
            request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::FECHA_INGRESO, true) . '_ini') !== ''
            )
            and (
            request::getInstance()->hasPost(maquinaTableClass::getNameField(maquinaTableClass::FECHA_INGRESO, true) . '_fin')
            and
            request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::FECHA_INGRESO, true) . '_fin') !== ''
            )
    ) {
      $where[maquinaTableClass::getNameField(maquinaTableClass::FECHA_INGRESO)] = array(
          request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::FECHA_INGRESO, true) . '_ini'),
          request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::FECHA_INGRESO, true) . '_fin'),
      );
    }
    if (
            request::getInstance()->hasPost(maquinaTableClass::getNameField(maquinaTableClass::CLASIFICACION_MAQUINA_ID, true))
            and
            request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::CLASIFICACION_MAQUINA_ID, true)) !== ''
    ) {
      $where[maquinaTableClass::getNameField(maquinaTableClass::CLASIFICACION_MAQUINA_ID)] = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::CLASIFICACION_MAQUINA_ID, true));
    }
    if (
            request::getInstance()->hasPost(maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true))
            and
            request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true)) !== ''
    ) {
      $where[maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION)] = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true));
    }
    if (
            request::getInstance()->hasPost(maquinaTableClass::getNameField(maquinaTableClass::CODIGO, true))
            and
            request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::CODIGO, true)) !== ''
    ) {
      $where[maquinaTableClass::getNameField(maquinaTableClass::CODIGO)] = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::CODIGO, true));
    }
    if (
            request::getInstance()->hasPost(maquinaTableClass::getNameField(maquinaTableClass::REFERENCIA, true))
            and
            request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::REFERENCIA, true)) !== ''
    ) {
      $where[maquinaTableClass::getNameField(maquinaTableClass::REFERENCIA)] = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::REFERENCIA, true));
    }
    if (
            request::getInstance()->hasPost(maquinaTableClass::getNameField(maquinaTableClass::INTERVALO_MANTENIMIENTO, true))
            and
            request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::INTERVALO_MANTENIMIENTO, true)) !== ''
    ) {
      $where[maquinaTableClass::getNameField(maquinaTableClass::INTERVALO_MANTENIMIENTO)] = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::INTERVALO_MANTENIMIENTO, true));
    }
    if (
            request::getInstance()->hasPost(maquinaTableClass::getNameField(maquinaTableClass::ACTIVADO, true))
            and
            request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::ACTIVADO, true)) !== ''
    ) {
      $where[maquinaTableClass::getNameField(maquinaTableClass::ACTIVADO)] = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::ACTIVADO, true));
    }
    if (
            request::getInstance()->hasPost(maquinaTableClass::getNameField(maquinaTableClass::VALOR, true))
            and
            request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::VALOR, true)) !== ''
    ) {
      $where[maquinaTableClass::getNameField(maquinaTableClass::VALOR)] = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::VALOR, true));
    }

    return $where;
  }

}
