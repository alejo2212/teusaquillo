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
 * @author Aleyda Mina Caicedo <aleminac@gmail.com>
 */
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet('id')) {
        $id = request::getInstance()->getGet('id');
        $this->raza = razaTableClass::getRazaById($id);
        $this->edit = true;
        $this->defineView('edit', 'raza', session::getInstance()->getFormatOutput());
        
      } else {
        routing::getInstance()->redirect('raza', 'index');
      }
            session::getInstance()->deleteAttribute('form');
            
    } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('La Raza que intenta registar ya existe en la base de datos');
                    break;
                case 00006:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                case '22P02':
                    session::getInstance()->setWarning('Ingresar datos validos');
                    break;
                  case 00009:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                  case 00010:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                default:
                    session::getInstance()->setError($exc->getMessage());
                    break;
            }
            routing::getInstance()->redirect('raza', 'edit');
            //routing::getInstance()->forward('security', 'new');
        }
    }

}
