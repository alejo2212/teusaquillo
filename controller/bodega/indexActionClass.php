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
          bodegaTableClass::ID,
          bodegaTableClass::LOTE_ID,
          bodegaTableClass::BODEGA_CLASIFICACION_ID,
          bodegaTableClass::INSUMO_ID,
          bodegaTableClass::ENTRADA_BODEGA_ID,
          bodegaTableClass::FECHA_VENCIMIENTO,
          bodegaTableClass::CANTIDAD,
          bodegaTableClass::ACTIVO
      );

      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//            $this->countPages = bodegaTableClass::getCountPages();

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

      $this->countPages = bodegaTableClass::getCountPagesByWhere($where);

      $fieldslote = array(
          loteTableClass::ID,
          loteTableClass::LOTE
      );
      $fieldsbodegaclasi = array(
          bodegaClasificacionTableClass::ID,
          bodegaClasificacionTableClass::NOMBRE
      );
      $fieldsinsumo = array(
          insumoTableClass::ID,
          insumoTableClass::NOMBRE
      );

      $this->objlote = loteTableClass::getAll($fieldslote, true, array(loteTableClass::LOTE), 'ASC');
      $this->objclasibodega = bodegaClasificacionTableClass::getAll($fieldsbodegaclasi, true, array(bodegaClasificacionTableClass::NOMBRE), 'ASC');
      $this->objinsu = insumoTableClass::getAll($fieldsinsumo, true, array(insumoTableClass::NOMBRE), 'ASC');

//      $where = array(
//        usuarioTableClass::getNameField(usuarioTableClass::USER) => 'jhon',
//        usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT) => array(
//          '2014-10-30' . ' 00:00',
//          '2014-10-31' . ' 23:59'
//        )
//      );

      $this->objbodega = bodegaTableClass::getAll($fields, true, array(bodegaTableClass::ID), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where); // no olvidemos borrar la variable where
      $this->defineView('index', 'bodega', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('bodega', 'index');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(bodegaTableClass::getNameField(bodegaTableClass::LOTE_ID, true))
            and
            request::getInstance()->getPost(bodegaTableClass::getNameField(bodegaTableClass::LOTE_ID, true)) !== ''
    ) {
      $where[bodegaTableClass::getNameField(bodegaTableClass::LOTE_ID)] = request::getInstance()->getPost(bodegaTableClass::getNameField(bodegaTableClass::LOTE_ID, true));
    }
    if (
            request::getInstance()->hasPost(bodegaTableClass::getNameField(bodegaTableClass::BODEGA_CLASIFICACION_ID, true))
            and
            request::getInstance()->getPost(bodegaTableClass::getNameField(bodegaTableClass::BODEGA_CLASIFICACION_ID, true)) !== ''
    ) {
      $where[bodegaTableClass::getNameField(bodegaTableClass::BODEGA_CLASIFICACION_ID)] = request::getInstance()->getPost(bodegaTableClass::getNameField(bodegaTableClass::BODEGA_CLASIFICACION_ID, true));
    }
    if (
            request::getInstance()->hasPost(bodegaTableClass::getNameField(bodegaTableClass::INSUMO_ID, true))
            and
            request::getInstance()->getPost(bodegaTableClass::getNameField(bodegaTableClass::INSUMO_ID, true)) !== ''
    ) {
      $where[bodegaTableClass::getNameField(bodegaTableClass::INSUMO_ID)] = request::getInstance()->getPost(bodegaTableClass::getNameField(bodegaTableClass::INSUMO_ID, true));
    }

//        if (
//                request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::PRESENTACION_ID, true))
//                and
//                request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::PRESENTACION_ID, true)) !== ''
//        ) {
//            $where[insumoTableClass::getNameField(insumoTableClass::PRESENTACION_ID)] = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::PRESENTACION_ID, true));
//        }
//        if (
//                request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::UNIDAD_MEDIDA_ID, true))
//                and
//                request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::UNIDAD_MEDIDA_ID, true)) !== ''
//        ) {
//            $where[insumoTableClass::getNameField(insumoTableClass::UNIDAD_MEDIDA_ID)] = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::UNIDAD_MEDIDA_ID, true));
//        }
    return $where;
  }

}
