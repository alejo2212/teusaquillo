<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of ejemploClass
 *
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        
        $user = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::USER, true));
        $pass1 = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD, true));
        $pass2 = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::PASSWORD."2", true));
        
//        exit();
        
        $post = array(
            usuarioTableClass::USER => $user,
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        // usuarioTableClass::USER_LENGTH
        if (strlen($user) > usuarioTableClass::USER_LENGTH) {
          throw new PDOException('El nombre de usuario no pude ser mayor a ' . usuarioTableClass::USER_LENGTH . ' caracteres', 00006);
        }
        /* ------------- */


        session::getInstance()->setAttribute(usuarioTableClass::getNameField(usuarioTableClass::USER, true), $user);

        if ($pass1 !== $pass2) {
          throw new PDOException('Las contraseñas son diferentes', 2345);
        }

        $data = array(
            usuarioTableClass::USER => $user,
            usuarioTableClass::PASSWORD => md5($pass1),
            usuarioTableClass::ACTIVED => 't',
            usuarioTableClass::CREATED_AT => date(config::getFormatTimestamp()),
            usuarioTableClass::LAST_LOGIN_AT => date(config::getFormatTimestamp()),
            '__sequence' => 'usuario_id_seq'
        );
        $idRegister = usuarioTableClass::insert($data);
        
        session::getInstance()->setSuccess('Registro exitoso');
        log::register('insertar', usuarioTableClass::getNameTable(), null, $idRegister);

        $fields = array(usuarioTableClass::ID);
        $campo = usuarioTableClass::ID;
        $datas = array(
            usuarioTableClass::USER => $user,
            usuarioTableClass::PASSWORD => md5($pass1),
            usuarioTableClass::ACTIVED => 't',
            usuarioTableClass::CREATED_AT => date(config::getFormatTimestamp()),
            usuarioTableClass::LAST_LOGIN_AT => date(config::getFormatTimestamp())
        );
        $id = usuarioTableClass::getAll($fields, true, null, null, null, null, $datas);

//        routing::getInstance()->redirect('security', 'edit', array('id' => $id[0]->$campo));
//      } else {
        routing::getInstance()->redirect('security', 'index');
      }
      
      /**
       * Limipiar variables en sessión correspondientes al formulario
       */
      session::getInstance()->deleteAttribute('form');
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El usuario que intenta registar ya existe en la base de datos');
          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('security', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }

}
