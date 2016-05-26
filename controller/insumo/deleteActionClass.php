<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of de eliminar
 *
 * @author jhon fernando hoyos <aprendiz.jhonfernandohoyosdiaz@gmail.com>
 */
class deleteActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {
        $id = request::getInstance()->getPost('id');
        $ids = array(
          insumoTableClass::ID => $id
        );
        insumoTableClass::delete($ids,TRUE); //se cambio a true(verdadero)por que por defecto trae false(falso)y ese falso lo elimina total de la tabla y el true lo cambia de estado;
        $this->answer = array(
          'code' => 200
        );
        session::getInstance()->setSuccess('El registro fue eliminado satisfactoriamente');
        $this->defineView('delete', 'insumo', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('insumo', 'index');
      }
    } catch (PDOException $exc) {
      //session::getInstance()->setError($exc->getMessage());
      $this->answer = array(
        'code' => 500,
        'error' => $exc->getMessage()
      );
      //routing::getInstance()->redirect('security', 'index');
    }
  }

}
