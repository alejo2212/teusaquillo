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
 * @author Patricia Arteaga <aprendiz.patricia-819@hotmail.com>
 */
class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $numero = request::getInstance()->getPost(cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::NUMERO, true));
                $observacion = request::getInstance()->getPost(cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::OBSERVACION, true));

                $post = array(
                    cajonCompostajeTableClass::NUMERO => $numero,
                    cajonCompostajeTableClass::OBSERVACION => $observacion
                );
                session::getInstance()->setAttribute('form', $post);

                /**
                 * VALIDACIONES
                 */
                // usuarioTableClass::USER_LENGTH
                $this->Validations($numero, $observacion);
                /* ------------- */


                session::getInstance()->setAttribute(cajonCompostajeTableClass::getNameField(cajonCompostajeTableClass::NUMERO, true), $numero);

                $data = array(
                    cajonCompostajeTableClass::NUMERO => $numero,
                    cajonCompostajeTableClass::OBSERVACION => $observacion
                );
                cajonCompostajeTableClass::insert($data);
                session::getInstance()->setSuccess('Registro exitoso');

                routing::getInstance()->redirect('cajonCompostaje', 'index');
            } else {
                routing::getInstance()->redirect('cajonCompostaje', 'index');
            }
            session::getInstance()->deleteAttribute('form');
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El cajon Compostaje que intenta registar ya existe en la base de datos');
                    break;
                case 00006:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                case '22P02':
                    session::getInstance()->setWarning('Ingresar datos validos');
                    break;
                default:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
            }
            routing::getInstance()->redirect('cajonCompostaje', 'new');
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
