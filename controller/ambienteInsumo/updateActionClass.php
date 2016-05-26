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
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::ID, true));
                $ambId = request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::AMBIENTE_ID, true));
                $salidaInD = request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID, true));
                $fechaA = request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true));
                $fechaR = request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true));

                /**
                 * VALIDACIONES
                 */
                // usuarioTableClass::USER_LENGTH
                $this->Validations($ambId, $salidaInD);
                
                /* ------------- */
                $ids = array(
                    ambienteInsumoTableClass::ID => $id
                );

                $data = array(
                    ambienteInsumoTableClass::AMBIENTE_ID => $ambId,
                    ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID => $salidaInD,
                    ambienteInsumoTableClass::FECHA_ASIGNACION => $fechaA,
                    ambienteInsumoTableClass::FECHA_RETIRO => $fechaR
                );
                ambienteInsumoTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Actualización exitosa');

                routing::getInstance()->redirect('ambienteInsumo', 'index');
            } else {
                routing::getInstance()->redirect('ambienteInsumo', 'index');
            }
            session::getInstance()->deleteAttribute('form');
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El cargo que intenta registar ya existe en la base de datos');
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
            routing::getInstance()->redirect('ambienteInsumo', 'edit', array(ambienteInsumoTableClass::ID => $id));
            //routing::getInstance()->forward('security', 'new');
        }
    }

    private function Validations($ambId,$salidaInD) {
        if(!is_numeric($ambId) and $ambId ==''){
            throw new PDOException('Seleccione un ambiente valido', 00008);
        }

        if (!is_numeric($salidaInD)) {
            throw new PDOException('El Campo Salida Insumo Solo Admite Dato Numerico', 00006);
        }
        if ($salidaInD === "") {
            throw new PDOException('El Campo Numero Salida Insumo no puede ir Vacio', 00007);
        }
        if(strtotime($fechaR) > strtotime($fechaA)){
            throw new PDOException ('La Fecha de Retiro no puede ser Menor que la fecha de Asignacion');
        }
    }

}
