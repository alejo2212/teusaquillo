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
 * @author Aleyda Mina  <aleminac@gmail.com>
 */
class editActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            
            if (request::getInstance()->hasGet('id')) {
                $id = request::getInstance()->getGet('id');
                $this->TipoAmbiente = tipoAmbienteTableClass::getTipoAmbienteById($id);
                $this->edit = true;
                $this->defineView('edit', 'tipoAmbiente', session::getInstance()->getFormatOutput());
            } else {
                routing::getInstance()->redirect('tipoAmbiente', 'index');
            }
            session::getInstance()->deleteAttribute('form');
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El Tipo de Ambiente  que intenta registar ya existe en la base de datos');
                    break;
                case 00006:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                case 00008:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                case '22P02':
                    session::getInstance()->setWarning('Ingresar datos validos');
                    break;
                default:
                    session::getInstance()->setError($exc->getMessage());
                    break;
            }
            routing::getInstance()->redirect('tipoAmbiente', 'edit');
            //routing::getInstance()->forward('security', 'new');
        }
    }

}
