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
class deleteAllActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $chk = request::getInstance()->getPost('chk');
        if ($chk != '') {
          foreach ($chk as $data) {
            $data = array(
                tipoIdentificacionTableClass::ID => $data
            );
            tipoIdentificacionTableClass::delete($data, true);
          }


          session::getInstance()->setSuccess('Eliminacion Exitosa');
          routing::getInstance()->redirect('tipoid', 'index');
        } else {
          session::getInstance()->setWarning('Debe selecionar almenos un registro para eliminar');
          routing::getInstance()->redirect('tipoid', 'index');
        }
      } else {
//        session::getInstance()->setSuccess('Ocurrio un error durante la Eliminacion');
        routing::getInstance()->redirect('tipoid', 'index');
      }
    } catch (PDOException $exc) {
      $this->answer = array(
          'code' => 500,
          'error' => $exc->getMessage()
      );
      routing::getInstance()->redirect('tipoid', 'index');
    }
  }

}
