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

                $nlote = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::LOTE, true));
                $fEntradaG = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRADA_GRANJA, true));
//                $fSalidaEs = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_ESTIPULADA, true));
                $fSalidaR = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_SALIDA_REAL, true));
                $razaId = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::RAZA_ID, true));
                $pesoPm = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::PESO_PROMEDIO_MACHOS, true));
                $pesoPh = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::PESO_PROMEDIO_HEMBRAS, true));
                $cantM = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::CANTIDAD_MACHOS, true));
                $cantH = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::CANTIDAD_HEMBRAS, true));
                $cantT = ($cantM + $cantH);
                $fEntradaProduc = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::FECHA_ENTRA_PRODUCCION, true));
                $observacion = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::OBSERVACION, true));
                $empleId = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::EMPLEADO_ID, true));
//                exit();
                $f = strtotime('+' . config::getTimeMinAfterProduc() . ' day', strtotime($fEntradaG));
                $nuevafecha = date(config::getFormatTimestamp(), $f);

                $post = array(
                    loteTableClass::LOTE => $nlote,
                    loteTableClass::FECHA_ENTRADA_GRANJA => $fEntradaG,
                    loteTableClass::FECHA_SALIDA_ESTIPULADA => $nuevafecha,
                    loteTableClass::FECHA_SALIDA_REAL => $fSalidaR,
                    loteTableClass::RAZA_ID => $razaId,
                    loteTableClass::PESO_PROMEDIO_MACHOS => $pesoPm,
                    loteTableClass::PESO_PROMEDIO_HEMBRAS => $pesoPh,
                    loteTableClass::CANTIDAD_MACHOS => $cantM,
                    loteTableClass::CANTIDAD_HEMBRAS => $cantH,
                    loteTableClass::CANTIDAD_TOTAL => $cantT,
                    loteTableClass::FECHA_ENTRA_PRODUCCION => $fEntradaProduc,
                    loteTableClass::OBSERVACION => $observacion,
                    loteTableClass::EMPLEADO_ID => $empleId
                );
                session::getInstance()->setAttribute('form', $post);

                /**
                 * VALIDACIONES
                 */
                // usuarioTableClass::USER_LENGTH


                $this->Validations($observacion, $nlote, $cantT, $cantM, $cantH, $empleId, $razaId, $fEntradaG, $fSalidaR, $fEntradaProduc);
                /* ------------- */


                session::getInstance()->setAttribute(loteTableClass::getNameField(loteTableClass::OBSERVACION, true), $observacion);
//                session::getInstance()->setAttribute(razaTableClass::getNameField(razaTableClass::DESCRIPCION, true), $des);




                $data = array(
                    loteTableClass::LOTE => $nlote,
                    loteTableClass::FECHA_ENTRADA_GRANJA => $fEntradaG,
                    loteTableClass::FECHA_SALIDA_ESTIPULADA => $nuevafecha,
                    loteTableClass::RAZA_ID => $razaId,
                    loteTableClass::PESO_PROMEDIO_MACHOS => $pesoPm,
                    loteTableClass::PESO_PROMEDIO_HEMBRAS => $pesoPh,
                    loteTableClass::CANTIDAD_MACHOS => $cantM,
                    loteTableClass::CANTIDAD_HEMBRAS => $cantH,
                    loteTableClass::CANTIDAD_TOTAL => $cantT,
                    loteTableClass::OBSERVACION => $observacion,
                    loteTableClass::EMPLEADO_ID => $empleId
                );
                if ($fSalidaR != '') {
                    $data[loteTableClass::FECHA_SALIDA_REAL] = $fSalidaR;
                }
                if ($fEntradaProduc != '') {
                    $data[loteTableClass::FECHA_ENTRA_PRODUCCION] = $fEntradaProduc;
                }
        loteTableClass::insert($data);
                session::getInstance()->setSuccess('Registro exitoso');

                routing::getInstance()->redirect('lote', 'index');
            } else {
                routing::getInstance()->redirect('lote', 'index');
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El lote que intenta registar ya existe en la base de datos');
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
            routing::getInstance()->redirect('lote', 'new');
            //routing::getInstance()->forward('security', 'new');
        }
    }

    private function Validations($observacion, $nlote, $cantT, $cantM, $cantH, $empleId, $razaId, $fEntradaG, $fSalidaR, $fEntradaProduc) {

//        $fecha = date('Y-m-j');
//        $nuevafecha = strtotime('+2 day', strtotime($fecha));
//        $nuevafecha = date('Y-m-j', $nuevafecha);
//
//        echo $nuevafecha;


//        echo 'fecha re=', strtotime($fEntradaG), ' = ', $fEntradaG, '<br>';
//    echo 'fecha sa=',strtotime($fSalidaEs),' = ',$fSalidaEs,'<br>';
//    echo 'dias=',config::getTimeMinAfterProduc(),'<br>';

//        exit();
//    if (strtotime($fSalidaEs) < strtotime($fEntradaG)+config::getTimeMinAfterProduc()) {
//      throw new PDOException('La Fecha de salida estipulada no puede er menor a la fecha de entrada granja', 00009);
//    }

        if (strlen($observacion) > loteTableClass::OBSERVACION_LENGTH) {
            throw new PDOException('La Observacion no pude ser mayor a ' . loteTableClass::OBSERVACION . ' caracteres', 00006);
        }
        if (!is_numeric($nlote)) {
            throw new PDOException('El campo Lote solo admite datos numericos', 00006);
        }
        if ($cantT === "") {
            throw new PDOException('El Campo Cantidad Total no puede ir Vacio', 00007);
        }
        if ($cantM === "") {
            throw new PDOException('El Campo Cantidad Macho no puede ir Vacio', 00007);
        }
        if (!is_numeric($cantM)) {
            throw new PDOException('El Campo Cantidad  Macho Solo Admite Datos Numericos', 00006);
        }
        if ($cantH === "") {
            throw new PDOException('El Campo Cantidad Hembras no puede ir Vacio', 00007);
        }
        if (!is_numeric($cantH)) {
            throw new PDOException('El Campo Cantidad Hembras Solo Admite Datos Numericos', 00006);
        }
        if (!is_numeric($razaId) and $razaId == '') {
            throw new PDOException('Seleccione un Nombre de Raza Valido', 00008);
        }
        if (!is_numeric($empleId) and $empleId == '') {
            throw new PDOException('Seleccione un Nombre de Empleado  Valido', 00008);
        }
//        if ($cantM > (0)) {
//            throw new PDOException('La cantidad de machos no puede ser inferior a cero', 00008);
//        }
//        if ($cantT > (0)) {
//            throw new PDOException('La Cantidad Total no puede ser inferior a cero', 00008);
//        }
//        if ($cantH > (0)) {
//            throw new PDOException('La Cantidad de Hembras no puede ser inferior a cero', 00008);
//        }

        if (strtotime($fEntradaG) > strtotime(date('Y-m-d H:i:s'))) {
            throw new PDOException('La Fecha de entrada a la granja no puede er Mayor a la del Sistema', 00009);
        }
    }

}
