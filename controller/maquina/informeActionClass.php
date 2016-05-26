<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of defaultClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class informeActionClass extends controllerClass implements controllerActionInterface {

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

      $where = $this->filters();
//
      $this->objMaquina = maquinaTableClass::getAll($fields, true, array(maquinaTableClass::FECHA_INGRESO), 'DESC', null, null, $where);
    $this->objClasiMaquina = clasificacionMaquinaTableClass::getAll($fieldsMaquina, true, array(clasificacionMaquinaTableClass::NOMBRE), 'ASC');
      $this->defineView('informe', 'maquina', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('maquina', 'index');
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
