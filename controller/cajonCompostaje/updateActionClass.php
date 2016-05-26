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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::ID, true));
                $numero = request::getInstance()->getPost(cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::NUMERO, true));
                $observacion = request::getInstance()->getPost(cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::OBSERVACION, true));
               
                /**
                 * VALIDACIONES
                 */
                // usuarioTableClass::USER_LENGTH
                //
                $this->Validations($numero, $observacion);
                /* ------------- */
                
                
                $ids = array(
                    cajonCompostajeTableClass::ID => $id
                );

                $data = array(
                    cajonCompostajeTableClass::NUMERO => $numero,
                    cajonCompostajeTableClass::OBSERVACION=> $observacion
                );
                cajonCompostajeTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Actualización exitosa');

                routing::getInstance()->redirect('cajonCompostaje', 'index');
            } else {
                routing::getInstance()->redirect('cajonCompostaje', 'index');
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El cargo que intenta registar ya existe en la base de datos');
                    break;
                case 00006:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
//                case '22P02':
//                    session::getInstance()->setWarning('Ingresar datos validos');
//                    break;
                default:
                    session::getInstance()->setError($exc->getMessage());
                    break;
            }
            routing::getInstance()->redirect('cajonCompostaje', 'edit', array(cajonCompostajeTableClass::ID => $id));
            //routing::getInstance()->forward('security', 'new');
        }
    }
    private function Validations($numero, $observacion) {
        if (!is_numeric($numero)) {
            throw new PDOException('El campo Numero solo puede contener caracteres numericos', 00008);
        }

        if ($numero === "") {
            throw new PDOException('El campo Numero no puede ir Vacio', 00007);
        }

        if (strlen($observacion) > cajonCompostajeTableClass::OBSERVACION_LENGTH) {
            throw new PDOException('Las observaciones  no pueden ser mayor a ' . cajonCompostajeTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
        }
    }

}
