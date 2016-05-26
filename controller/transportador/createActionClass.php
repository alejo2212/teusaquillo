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
  @author jhon fernando hoyos diaz <aprendiz.jhonfernandohoyosdiaz@gmail.com> */
class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $nombre = request::getInstance()->getPost(transportadorTableClass::getNameField(transportadorTableClass::NOMBRE, true));
                $placa = request::getInstance()->getPost(transportadorTableClass::getNameField(transportadorTableClass::PLACA_VAHICULO, true));
                $observacion = request::getInstance()->getPost(transportadorTableClass::getNameField(transportadorTableClass::OBSERVACION, true));
                

                $post = array(
                    transportadorTableClass::NOMBRE => $nombre,
                    transportadorTableClass::PLACA_VAHICULO => $placa,
                    transportadorTableClass::OBSERVACION => $observacion
                );
                session::getInstance()->setAttribute('form', $post);
               
                /**
                 * VALIDACIONES
                 */
                $this->Validations($nombre,$observacion,$placa);

                /* ------------- */


                session::getInstance()->setAttribute(transportadorTableClass::getNameField(transportadorTableClass::NOMBRE, true), $nombre);
                session::getInstance()->setAttribute(transportadorTableClass::getNameField(transportadorTableClass::OBSERVACION, true), $observacion);



                $data = array(
                    transportadorTableClass::NOMBRE => $nombre,
                    transportadorTableClass::PLACA_VAHICULO => $placa,
                    transportadorTableClass::OBSERVACION => $observacion
                );
                transportadorTableClass::insert($data);
                session::getInstance()->setSuccess('Registro exitoso');

                routing::getInstance()->redirect('transportador', 'index');
            } else {
                routing::getInstance()->redirect('transportador', 'index');
            }
            session::getInstance()->deleteAttribute('form');
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El transportador que intenta registar ya existe en la base de datos');
                    break;
                case 00006:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                case 00007:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                case 00008:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                default:
                    session::getInstance()->setError($exc->getMessage());
                    break;
            }
            routing::getInstance()->redirect('transportador', 'new');
            //routing::getInstance()->forward('security', 'new');
        }
    }

    private function Validations($nombre,$observacion, $placa) {
        if (strlen($nombre) > transportadorTableClass::NOMBRE_LENGTH) {
            throw new PDOException('El nombre  no pude ser mayor a ' . transportadorTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
        }
        if ($nombre === "") {
            throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
            echo "entro";
        }
        if ($placa === "") {
            throw new PDOException('La Placa del vehiculo no puede ir Vacio', 00007);
        }
        if (strlen($placa) > transportadorTableClass::PLACA_LENGTH) {
            throw new PDOException('La Placa  no pude ser mayor a ' . transportadorTableClass::PLACA_LENGTH . ' caracteres', 00006);
        }

//        if (!ereg("^[A-Za-z_]*$", $nombre)) {
//            throw new PDOException('no pueden llevar el Nombre campos numericos', 00008);
//            echo "entro";
//        }

        if (strlen($observacion) > transportadorTableClass::OBSERVACION_LENGTH) {
            throw new PDOException('La observacion  no pude ser mayor a ' . transportadorTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
        }
    }

}
