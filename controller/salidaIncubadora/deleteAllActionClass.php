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
                salidaincubadoraTableClass::ID => $data
            );
            salidaincubadoraTableClass::delete($data, true);
          }


          session::getInstance()->setSuccess('Eliminacion Exitosa');
          routing::getInstance()->redirect('salidaIncubadora', 'index');
        } else {
          session::getInstance()->setWarning('Debe selecionar almenos un registro para eliminar');
          routing::getInstance()->redirect('salidaIncubadora', 'index');
        }
      } else {
        routing::getInstance()->redirect('salidaIncubadora', 'index');
      }
    } catch (PDOException $exc) {
      $this->answer = array(
          'code' => 500,
          'error' => $exc->getMessage()
      );
      routing::getInstance()->redirect('salidaIncubadora', 'index');
    }
  }

}
