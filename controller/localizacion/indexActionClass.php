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
          localidadTableClass::ID,
          localidadTableClass::NOMBRE,
          localidadTableClass::LOCALIDAD_ID,
          localidadTableClass::DELETED_AT
      );

      $where = $this->filters();
      
// ************************** paginado para del filtro ****************************
      if (request::getInstance()->hasGet('r') == 'true') {
        session::getInstance()->deleteAttribute('where');
      }
      if (session::getInstance()->hasAttribute('where')) {
        $where = session::getInstance()->getAttribute('where');
//        echo 'hay atributo';
      } else {
        if ($where != null) {
          session::getInstance()->setAttribute('where', $where);
//          echo 'creo atributo';
        }
      }
      
      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        echo $this->page = (request::getInstance()->getGet('page') - 1);
      }

      $this->countPages = localidadTableClass::getCountPagesByWhere($where);
// ************************** Fin paginado para del filtro ****************************
//exit();
      $this->objDeptos = localidadTableClass::getLocalidades();
      $this->objLocalidad = localidadTableClass::getAll($fields, true, array(localidadTableClass::NOMBRE), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);
      
      $this->defineView('index', 'localizacion', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El cargo que intenta registar ya existe en la base de datos');
          break;
        case 00006:
          session::getInstance()->setWarning($exc->getMessage());
          break;
//        case '22P02':
//          session::getInstance()->setWarning('Seleccione un departamento Valido');
//          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('localizacion', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();
    if (
            request::getInstance()->hasPost(localidadTableClass::getNameField(localidadTableClass::NOMBRE, true))
            and
            request::getInstance()->getPost(localidadTableClass::getNameField(localidadTableClass::NOMBRE, true)) !== ''
    ) {
      $where[localidadTableClass::getNameField(localidadTableClass::NOMBRE)] = request::getInstance()->getPost(localidadTableClass::getNameField(localidadTableClass::NOMBRE, true));
    }

    if (
            request::getInstance()->hasPost(localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID, true))
            and
            request::getInstance()->getPost(localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID, true)) !== ''
    ) {
      $where[localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID)] = request::getInstance()->getPost(localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID, true));
    }
//      $where[localidadTableClass::getNameField(localidadTableClass::LOCALIDAD_ID)] <> 0;
    return $where;
  }

}
