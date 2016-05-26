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
          registroAlistamientoTableClass::ID,
          registroAlistamientoTableClass::EMPLEADO_ID,
          registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID,
          registroAlistamientoTableClass::FECHA_INICIO,
          registroAlistamientoTableClass::FECHA_FIN,
          registroAlistamientoTableClass::LOTE_ID,
          registroAlistamientoTableClass::FECHA_INICIO_CORTINA,
          registroAlistamientoTableClass::FECHA_FIN_CORTINA,
          registroAlistamientoTableClass::FECHA_ENTRADA_CAMA,
          registroAlistamientoTableClass::FECHA_TERMINO_CAMA,
          registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO
      );

      $where = $this->filters();
//
      $this->objregistroAlistamiento = registroAlistamientoTableClass::getAll($fields, true, array(registroAlistamientoTableClass::ID), 'DESC', null, null, $where);
      $this->defineView('informe', 'registroAlistamiento', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('registroAlistamiento', 'index');
    }
  }
    private function filters() {
      $where = array();
      if (
              request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::EMPLEADO_ID, true))
              and
              request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::EMPLEADO_ID, true)) !== ''
      ) {
        $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::EMPLEADO_ID)] = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::EMPLEADO_ID, true));
      }
      if (
              request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID, true))
              and
              request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID, true)) !== ''
      ) {
        $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID)] = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::SALIDA_INSUMO_DETALLE_ID, true));
      }
      if (
              request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::LOTE_ID, true))
              and
              request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::LOTE_ID, true)) !== ''
      ) {
        $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::LOTE_ID)] = request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::LOTE_ID, true));
      }


      if (
              (
              request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) . '_ini')
              and
              request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) . '_ini') !== ''
              )
              and (
              request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) . '_fin')
              and
              request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) . '_fin') !== ''
              )
      ) {
        $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO)] = array(
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) . '_ini'),
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO, true) . '_fin'),
        );
      }
      if (
              (
              request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) . '_ini')
              and
              request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) . '_ini') !== ''
              )
              and (
              request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) . '_fin')
              and
              request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) . '_fin') !== ''
              )
      ) {
        $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN)] = array(
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) . '_ini'),
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN, true) . '_fin'),
        );
      }
      if (
              (
              request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) . '_ini')
              and
              request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) . '_ini') !== ''
              )
              and (
              request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) . '_fin')
              and
              request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) . '_fin') !== ''
              )
      ) {
        $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA)] = array(
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) . '_ini'),
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_INICIO_CORTINA, true) . '_fin'),
        );
      }
      if (
              (
              request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) . '_ini')
              and
              request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) . '_ini') !== ''
              )
              and (
              request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) . '_fin')
              and
              request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) . '_fin') !== ''
              )
      ) {
        $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA)] = array(
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) . '_ini'),
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_FIN_CORTINA, true) . '_fin'),
        );
      }
      if (
              (
              request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) . '_ini')
              and
              request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) . '_ini') !== ''
              )
              and (
              request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) . '_fin')
              and
              request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) . '_fin') !== ''
              )
      ) {
        $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA)] = array(
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) . '_ini'),
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_CAMA, true) . '_fin'),
        );
      }
      if (
              (
              request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) . '_ini')
              and
              request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) . '_ini') !== ''
              )
              and (
              request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) . '_fin')
              and
              request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) . '_fin') !== ''
              )
      ) {
        $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA)] = array(
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) . '_ini'),
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_TERMINO_CAMA, true) . '_fin'),
        );
      }
      if (
              (
              request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) . '_ini')
              and
              request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) . '_ini') !== ''
              )
              and (
              request::getInstance()->hasPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) . '_fin')
              and
              request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) . '_fin') !== ''
              )
      ) {
        $where[registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO)] = array(
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) . '_ini'),
            request::getInstance()->getPost(registroAlistamientoTableClass::getNameField(registroAlistamientoTableClass::FECHA_ENTRADA_EQUIPO, true) . '_fin'),
        );
      }
      return $where;
    }

  }
