<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Patricia Arteaga <patricia-819@hotmail.com>
 */
class deleteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {
        $id = request::getInstance()->getPost('id');
        $ids = array(
          tipoDesinfeccionTableClass::ID => $id
        );
        tipoDesinfeccionTableClass::delete($ids, true);//el true sirve para borrar logicamente
        $this->answer = array(
          'code' => 200
        );
        session::getInstance()->setSuccess('El registro fue eliminado satisfactoriamente');
        $this->defineView('delete', 'tipoDesinfeccion', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('tipoDesinfeccion', 'index');
      }
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
            routing::getInstance()->redirect('tipoDesinfeccion', 'index');
            //routing::getInstance()->forward('security', 'new');
        }
  }

}
