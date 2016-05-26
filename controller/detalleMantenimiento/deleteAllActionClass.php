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
        $id = request::getInstance()->getGet('id');
        if($chk != ''){
        foreach ($chk as $data){
            $data = array(
                detalleMantenimientoTableClass::ID => $data
            );
            detalleMantenimientoTableClass::delete($data, true);
        }
        
        
        session::getInstance()->setSuccess('Eliminacion Exitosa');
        routing::getInstance()->redirect('mantenimiento', 'detail',array('id'=>$id));
        }else{
          session::getInstance()->setWarning('Debe selecionar almenos un registro para eliminar');
          routing::getInstance()->redirect('mantenimiento', 'detail',array('id'=>$id));
        }
         
      } else {
        routing::getInstance()->redirect('mantenimiento', 'detail',array('id'=>$id));
      }
    } catch (PDOException $exc) {
      $this->answer = array(
        'code' => 500,
        'error' => $exc->getMessage()
      );
      routing::getInstance()->redirect('mantenimiento', 'detail',array('id'=>$id));
    }
  }

}
