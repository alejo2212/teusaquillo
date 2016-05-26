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
 * @author Aleyda Mina <aleminac@gmail.com>
 */
class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {

        try {

            if (request::getInstance()->isMethod('POST')) {

                $ambId = request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::AMBIENTE_ID, true));
                $salidaInD = request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID, true));
                $fechaA = request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_ASIGNACION, true));
                $fechaR = request::getInstance()->getPost(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::FECHA_RETIRO, true));

                $post = array(
                    ambienteInsumoTableClass::AMBIENTE_ID => $ambId,
                    ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID => $salidaInD,
                    ambienteInsumoTableClass::FECHA_ASIGNACION => $fechaA,
                    ambienteInsumoTableClass::FECHA_RETIRO => $fechaR,
                );
                session::getInstance()->setAttribute('form', $post);


                /**
                 * VALIDACIONES
                 */

                $this->Validations($ambId, $salidaInD,$fechaA,$fechaR);
                /* ------------- */

                session::getInstance()->setAttribute(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::AMBIENTE_ID, true), $ambId);
                session::getInstance()->setAttribute(ambienteInsumoTableClass::getNameField(ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID, true), $salidaInD);


                $data = array(
                    ambienteInsumoTableClass::AMBIENTE_ID => $ambId,
                    ambienteInsumoTableClass::SALIDA_INSUMO_DETALLE_ID => $salidaInD,
                    ambienteInsumoTableClass::FECHA_ASIGNACION => $fechaA,
                    ambienteInsumoTableClass::FECHA_RETIRO => $fechaR
                );
                ambienteInsumoTableClass::insert($data);
                session::getInstance()->setSuccess('Registro exitoso');

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
            routing::getInstance()->redirect('ambienteInsumo', 'new');
//routing::getInstance()->forward('security', 'new');
        }
    }

    private function Validations($ambId, $salidaInD,$fechaR,$fechaA) {
        if (!is_numeric($ambId) and $ambId == '') {
            throw new PDOException('Seleccione un tipo de ambiente valido', 00008);
        }

        if (!is_numeric($salidaInD)) {
            throw new PDOException('El Campo Salida Insumo Solo Admite Dato Numerico', 00006);
        }
        if(strtotime($fechaR) > strtotime($fechaA)){
            throw new PDOException ('La Fecha de Retiro no puede ser Menor que la fecha de Asignacion');
        }
    }

}
