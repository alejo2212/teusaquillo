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
 * @author A <@gmail.com>
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::ID, true));
                $nombre = request::getInstance()->getPost(tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::NOMBRE, true));
                $descripcion = request::getInstance()->getPost(tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::DESCRIPCION, true));
                $observacion = request::getInstance()->getPost(tipoAmbienteTableClass::getNameField(tipoAmbienteTableClass::OBSERVACION, true));

                /**
                 * VALIDACIONES
                 */
// usuarioTableClass::USER_LENGTH
                $this->Validations($nombre, $observacion, $descripcion);

                /* ------------- */

                $ids = array(
                    tipoAmbienteTableClass::ID => $id
                );

                $data = array(
                    tipoAmbienteTableClass::NOMBRE => $nombre,
                    tipoAmbienteTableClass::DESCRIPCION => $descripcion,
                    tipoAmbienteTableClass::OBSERVACION => $observacion
                );
                tipoAmbienteTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Actualización exitosa');

                routing::getInstance()->redirect('tipoAmbiente', 'index');
            } else {
                routing::getInstance()->redirect('tipoAmbiente', 'index');
            }
            session::getInstance()->deleteAttribute('form');
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El Tipo de Ambiente que intenta registar ya existe en la base de datos');
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
            routing::getInstance()->redirect('tipoAmbiente', 'edit', array(tipoAmbienteBaseTableClass::ID => $id));
//routing::getInstance()->forward('security', 'new');
        }
    }

    private function Validations($nombre, $observacion, $descripcion) {
        if (strlen($nombre) > tipoAmbienteTableClass::NOMBRE_LENGTH) {
            throw new PDOException('El nombre  no pude ser mayor a ' . tipoAmbienteTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
//                    Esto 3 if para validar varchar
        }
        if ($nombre === "") {
            throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
            
        }

//        if (!ereg("^[A-Za-z_]*$", $nombre)) {
//            throw new PDOException('El Campo Nombre Solo pueden Contener Datos  Alfabeticos', 00008);
//         }

        if (strlen($observacion) > tipoAmbienteTableClass::OBSERVACION_LENGTH) {
            throw new PDOException('La Observacion  no pude ser mayor a ' . tipoAmbienteTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
        }
        if (strlen($descripcion) > tipoAmbienteTableClass::DESCRIPCION_LENGTH) {
            throw new PDOException('La Descripcion no pude ser mayor a ' . tipoAmbienteTableClass::DESCRIPCION_LENGTH . ' caracteres', 00006);
        }
        if ($descripcion === "") {
            throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
            
        }
    }

}
