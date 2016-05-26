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
          incubadoraTableClass::ID,
          incubadoraTableClass::LOCALIZACION_ID,
          incubadoraTableClass::NOMBRE,
          incubadoraTableClass::DIRECCION,
          incubadoraTableClass::OBSERVACION
      );

      $this->page = 0;

      if (request::getInstance()->hasGet('page')) {
        $this->page = (request::getInstance()->getGet('page') - 1);
      }

//      $this->countPages = incubadoraTableClass::getCountPages();

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
      
      $this->countPages = incubadoraTableClass::getCountPagesByWhere($where);
      
      $fieldsciu = array(
        localidadTableClass::ID,
        localidadTableClass::NOMBRE
     );
        $this->objlocalidad = localidadTableClass::getAll($fieldsciu, true, array(localidadTableClass::NOMBRE), 'ASC');
        
      $this->objincubadora = incubadoraTableClass::getAll($fields, true, array(incubadoraTableClass::NOMBRE), 'ASC', config::getRowGrid(), ($this->page * config::getRowGrid()), $where);

      $this->defineView('index', 'incubadora', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La incubadora que intenta registar ya existe en la base de datos');
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
      routing::getInstance()->redirect('incubadora', 'index');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function filters() {
    $where = array();
    if (
            request::getInstance()->hasPost(incubadoraTableClass::getNameField(incubadoraTableClass::LOCALIZACION_ID, true))
            and
            request::getInstance()->getPost(incubadoraTableClass::getNameField(incubadoraTableClass::LOCALIZACION_ID, true)) !== ''
    ) {
      $where[incubadoraTableClass::getNameField(incubadoraTableClass::LOCALIZACION_ID)] = request::getInstance()->getPost(incubadoraTableClass::getNameField(incubadoraTableClass::LOCALIZACION_ID, true));
    }
    if (
            request::getInstance()->hasPost(incubadoraTableClass::getNameField(incubadoraTableClass::NOMBRE, true))
            and
            request::getInstance()->getPost(incubadoraTableClass::getNameField(incubadoraTableClass::NOMBRE, true)) !== ''
    ) {
      $where[incubadoraTableClass::getNameField(incubadoraTableClass::NOMBRE)] = request::getInstance()->getPost(incubadoraTableClass::getNameField(incubadoraTableClass::NOMBRE, true));
    }
    
    return $where;
  }

}
