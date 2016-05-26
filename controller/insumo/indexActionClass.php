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
          insumoTableClass::ID,
          insumoTableClass::ACTIVO,
          insumoTableClass::DELETED_AT,
          insumoTableClass::NOMBRE,
          insumoTableClass::TIPO_INSUMO_ID,
          insumoTableClass::PRESENTACION_ID,
          insumoTableClass::UNIDAD_MEDIDA_ID,
          insumoTableClass::INVENTARIO_BODEGA
      );

      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//            $this->countPages = insumoTableClass::getCountPages();

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

      $this->countPages = insumoTableClass::getCountPagesByWhere($where);

      $fieldstipoinsu = array(
          tipoInsumoTableClass::ID,
          tipoInsumoTableClass::NOMBRE
      );
      $fieldspresen = array(
          presentacionTableClass::ID,
          presentacionTableClass::NOMBRE
      );
      $fieldsunimedida = array(
          unidadMedidaTableClass::ID,
          unidadMedidaTableClass::NOMBRE
      );
      $this->objtipoinsumo = tipoInsumoTableClass::getAll($fieldstipoinsu, true, array(tipoInsumoTableClass::NOMBRE), 'ASC');
      $this->objpresentacion = presentacionTableClass::getAll($fieldspresen, true, array(presentacionTableClass::NOMBRE), 'ASC');
      $this->objunidadmedida = unidadMedidaTableClass::getAll($fieldsunimedida, true, array(unidadMedidaTableClass::NOMBRE), 'ASC');

//      $where = array(
//        usuarioTableClass::getNameField(usuarioTableClass::USER) => 'jhon',
//        usuarioTableClass::getNameField(usuarioTableClass::CREATED_AT) => array(
//          '2014-10-30' . ' 00:00',
//          '2014-10-31' . ' 23:59'
//        )
//      );

      $this->objinsumo = insumoTableClass::getAll($fields, true, array(insumoTableClass::ID), 'DESC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where); // no olvidemos borrar la variable where
      $this->defineView('index', 'insumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setError($exc->getMessage());
      routing::getInstance()->redirect('insumo', 'index');
    }
  }

  private function filters() {
    $where = array();

    if (
            request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true))
            and
            request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true)) !== ''
    ) {
      $where[insumoTableClass::getNameField(insumoTableClass::NOMBRE)] = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true));
    }
    if (
            request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::INVENTARIO_BODEGA, true))
            and
            request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::INVENTARIO_BODEGA, true)) !== ''
    ) {
      $where[insumoTableClass::getNameField(insumoTableClass::INVENTARIO_BODEGA)] = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::INVENTARIO_BODEGA, true));
    }
    if (
            request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, true))
            and
            request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, true)) !== ''
    ) {
      $where[insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID)] = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, true));
    }

    if (
            request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::PRESENTACION_ID, true))
            and
            request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::PRESENTACION_ID, true)) !== ''
    ) {
      $where[insumoTableClass::getNameField(insumoTableClass::PRESENTACION_ID)] = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::PRESENTACION_ID, true));
    }
    if (
            request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::UNIDAD_MEDIDA_ID, true))
            and
            request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::UNIDAD_MEDIDA_ID, true)) !== ''
    ) {
      $where[insumoTableClass::getNameField(insumoTableClass::UNIDAD_MEDIDA_ID)] = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::UNIDAD_MEDIDA_ID, true));
    }
    return $where;
  }

}
