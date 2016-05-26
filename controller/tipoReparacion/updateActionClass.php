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
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(tipoReparacionTableClass::getNameField(tipoReparacionTableClass::ID, true));
                $nombre = request::getInstance()->getPost(tipoReparacionTableClass::getNameField(tipoReparacionTableClass::NOMBRE, true));
                $observacion = request::getInstance()->getPost(tipoReparacionTableClass::getNameField(tipoReparacionTableClass::OBSERVACION, true));
                $ids = array(
                    tipoReparacionTableClass::ID => $id
                );

                $this->Validations($nombre, $observacion);

                $data = array(
                    tipoReparacionTableClass::NOMBRE => $nombre,
                    tipoReparacionTableClass::OBSERVACION => $observacion
                );
                tipoReparacionTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Actualización exitosa');

                routing::getInstance()->redirect('tipoReparacion', 'index');
            } else {
                routing::getInstance()->redirect('tipoReparacion', 'index');
            }
            session::getInstance()->deleteAttribute('form');
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El Tipo de Reparacion que intenta registar ya existe en la base de datos');
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
            routing::getInstance()->redirect('tipoReparacion', 'edit', array(tipoReparacionTableClass::ID => $id));
            //routing::getInstance()->forward('security', 'new');
        }
    }

    private function Validations($nombre, $observacion) {
        if (strlen($nombre) > tipoReparacionTableClass::NOMBRE_LENGTH) {
            throw new PDOException('El nombre  no pude ser mayor a ' . tipoReparacionTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
        }
        if ($nombre === "") {
            throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
            echo "entro";
        }

//        if (!ereg("^[A-Za-z_]*$", $nombre)) {
//            throw new PDOException('no pueden llevar el Nombre campos numericos', 00008);
//            echo "entro";
//        }

        if (strlen($observacion) > tipoReparacionTableClass::OBSERVACION_LENGTH) {
            throw new PDOException('La observacion  no pude ser mayor a ' . tipoReparacionTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
        }
    }

}
