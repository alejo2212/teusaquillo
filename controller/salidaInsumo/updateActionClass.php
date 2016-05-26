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
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ID, true));
                $empleSal = request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_SALIDA, true));
                $empleRec = request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::EMPLEADO_ID_RECEPCION, true));
//                $fecha = request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::FECHA, true));
                $observacion = request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::OBSERVACION, true));
                $anulado = (request::getInstance()->hasPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ANULADO, true))) ? request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::ANULADO, true)) : 'f';
                $requisi = request::getInstance()->getPost(salidaInsumoTableClass::getNameField(salidaInsumoTableClass::REQUISICION_ID, true));

                /**
                 * VALIDACIONES
                 */
// usuarioTableClass::USER_LENGTH
                $this->Validations($observacion, $requisi,$empleSal,$empleRec,$fecha);

                /* ------------- */

                $ids = array(
                    salidaInsumoTableClass::ID => $id
                );

                $data = array(
                    salidaInsumoTableClass::EMPLEADO_ID_SALIDA => $empleSal,
                    salidaInsumoTableClass::EMPLEADO_ID_RECEPCION => $empleRec,
                    salidaInsumoTableClass::FECHA => date(config::getFormatTimestamp()),
                    salidaInsumoTableClass::OBSERVACION => $observacion,
                    salidaInsumoTableClass::ANULADO => $anulado,
                    salidaInsumoTableClass::REQUISICION_ID => $requisi
                );
                salidaInsumoTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Actualización exitosa');

                routing::getInstance()->redirect('salidaInsumo', 'index');
            } else {
                routing::getInstance()->redirect('salidaInsumo', 'index');
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
//                case '22P02':
//                    session::getInstance()->setWarning('Ingresar datos validos');
//                    break;
                default:
                    session::getInstance()->setError($exc->getMessage());
                    break;
            }
            routing::getInstance()->redirect('salidaInsumo', 'edit', array(salidaInsumoBaseTableClass::ID => $id));
//routing::getInstance()->forward('security', 'new');
        }
    }

    private function Validations($observacion, $requisi,$empleSal,$empleRec,$fecha) {
        if  (strtotime($fecha) > strtotime(date('Y-m-d H:i:s'))){
            throw new PDOException ('La Fecha no puede er Mayor a la del Sistema');
        }
        if (strlen($observacion) > salidaInsumoTableClass:: OBSERVACION_LENGTH) {
            throw new PDOException('La observacion  no pude ser mayor a ' . salidaInsumoTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
        }
        if (!is_numeric($requisi)) {
            throw new PDOException('El campo requisicion solo admite caracteres numericos', 00006);
        }
        if ($requisi === "") {
            throw new PDOException('El campo requisicion  no puede ir Vacio', 00007);
        }
        if (!is_numeric($empleSal) and $empleSal == '') {
            throw new PDOException('Seleccione un Empleado Salida valido', 00008);
        }
        if (!is_numeric($empleRec) and $empleRec == '') {
            throw new PDOException('Seleccione un Empleado Recibe valido', 00008);
        }
        
    }

}
