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

                $nombre = request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE, true));
                $observacion = request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::OBSERVACION, true));


                $post = array(
                    tipoInsumoTableClass::NOMBRE => $nombre,
                    tipoInsumoTableClass::OBSERVACION => $observacion
                );
                session::getInstance()->setAttribute('form', $post);
               
                /**
                 * VALIDACIONES
                 */
                $this->Validations($nombre,$observacion);

                /* ------------- */


                session::getInstance()->setAttribute(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE, true), $nombre);
                session::getInstance()->setAttribute(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::OBSERVACION, true), $observacion);



                $data = array(
                    tipoInsumoTableClass::NOMBRE => $nombre,
                    tipoInsumoTableClass::OBSERVACION => $observacion
                );
                tipoInsumoTableClass::insert($data);
                session::getInstance()->setSuccess('Registro exitoso');

                routing::getInstance()->redirect('tipoInsumo', 'index');
            } else {
                routing::getInstance()->redirect('tipoInsumo', 'index');
            }
            session::getInstance()->deleteAttribute('form');
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El Tipo de Insumo que intenta registar ya existe en la base de datos');
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
            routing::getInstance()->redirect('tipoInsumo', 'new');
            //routing::getInstance()->forward('security', 'new');
        }
    }

    private function Validations($nombre,$observacion) {
        if (strlen($nombre) > tipoInsumoTableClass::NOMBRE_LENGTH) {
            throw new PDOException('El nombre  no pude ser mayor a ' . tipoInsumoTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
        }
        if ($nombre === "") {
            throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
            echo "entro";
        }

//        if (!ereg("^[A-Za-z_]*$", $nombre)) {
//            throw new PDOException('no pueden llevar el Nombre campos numericos', 00008);
//            
//        }

        if (strlen($observacion) > tipoInsumoTableClass::OBSERVACION_LENGTH) {
            throw new PDOException('La observacion  no pude ser mayor a ' . tipoInsumoTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
        }
    }

}
