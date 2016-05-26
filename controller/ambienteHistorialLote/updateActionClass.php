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


                $id = request::getInstance()->getPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::ID, true));
                $ambiente = request::getInstance()->getPost(ambienteTableClass::getNameField(ambienteTableClass::NOMBRE, true));
                $lote = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::LOTE, true));
                $numerocaseta = request::getInstance()->getPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::NO_CASETA, true));
                $canth = request::getInstance()->getPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::CANTIDAD_HEMBRAS, true));
                $cantm = request::getInstance()->getPost(ambienteHistorialLoteTableClass::getNameField(ambienteHistorialLoteTableClass::CANTIDAD_MACHOS, true));

                $ids = array(
                    ambienteHistorialLoteTableClass::ID => $id
                );

                $data = array(
                    ambienteHistorialLoteTableClass::AMBIENTE_ID => $ambiente,
                    ambienteHistorialLoteTableClass::LOTE_ID => $lote,
                    ambienteHistorialLoteTableClass::NO_CASETA => $numerocaseta,
                    ambienteHistorialLoteTableClass::CANTIDAD_HEMBRAS => $canth,
                    ambienteHistorialLoteTableClass::CANTIDAD_MACHOS => $cantm
                );

                //        if (filter_var($nombre, FILTER_VALIDATE_INT)) {
//          throw new PDOException('no pueden llevar el Nombre campos numericos', 00008);
//          echo "entro";
//        }
                /**
                 * VALIDACIONES
                 */
                // usuarioTableClass::USER_LENGTH
                if ($ambiente === "") {
                    throw new PDOException('El campo ambiente  no puede ir Vacio', 00007);
                }

                if ($lote === "") {
                    throw new PDOException('El campo lote  no puede ir Vacio', 00007);
                }
                if (!is_numeric($numerocaseta)) {
                    throw new PDOException('El campo numero de caseta  no puede contener letras', 00010);
                }
                if ($numerocaseta <= -1) {
                    throw new PDOException('El campo numero de caseta no puede contener letras', 00011);
                }
                if (!is_numeric($canth)) {
                    throw new PDOException('El campo cantida de hembras  no puede contener letras', 00010);
                }
                if ($canth <= -1) {
                    throw new PDOException('El campo cantida de hembras no puede ser menor que (0)', 00011);
                }
                if (!is_numeric($cantm)) {
                    throw new PDOException('El campo cantida de machos  no puede contener letras', 00010);
                }
                if ($cantm <= -1) {
                    throw new PDOException('El campo cantida de machos no puede ser menor que (0)', 00011);
                }

                /* ------------- */


//                session::getInstance()->setAttribute(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE, true), $nombre);
                //exit();
                $numLote = loteTableClass::getLote($lote);

//                $MacosHembrasxcaseta = ambienteHistorialLoteTableClass::getHemrasMahosxCaseta($numLote, $numerocaseta);
//                foreach ($MacosHembrasxcaseta as $dataC):
//                    $hLxC = $dataC->h;
//                    $mLxC = $dataC->m;
//                endforeach;
//                exit();
//                if ($hLxC >= $canth and $mLxC >= $cantm) {
                    
                    $LoteMachosHembras = loteTableClass::getCantMachosCantHembras($numLote);
                    foreach ($LoteMachosHembras as $dataL):
                        echo $hL = $dataL->hembras;
                        $mL = $dataL->machos;
                    endforeach;
                    $cantHcantM = ambienteHistorialLoteTableClass::getSumHSumM($numLote);
                    foreach ($cantHcantM as $dataA):
                        echo $h = $dataA->hembras;
                        $m = $dataA->machos;
                    endforeach;
                    $hDisponible = $hL - $h;
                    $mDisponible = $mL - $m;
                    $pas = true;
//                } else {
//                    $pas = false;
//                }
                
//                echo $hDisponible,'-',$canth,'-',$mDisponible,'-',$cantm,' pas=',$pas;
//                exit();
                if ($hDisponible >= $canth and $mDisponible >= $cantm) {
//                   
                    ambienteHistorialLoteTableClass::update($ids, $data);
                    session::getInstance()->setSuccess('Actualización exitosa');
                    routing::getInstance()->redirect('ambienteHistorialLote', 'index');
                } else {
                    session::getInstance()->setWarning('A escedido la cantidad de aves. Disponibles=<strong>' . ($hDisponible + $mDisponible) . '</strong> (Hembras:<strong>' . $hDisponible . '</strong>) (Machos:<strong>' . $mDisponible . '</strong>)');
                    routing::getInstance()->redirect('ambienteHistorialLote', 'edit', array(ambienteHistorialLoteTableClass::ID => $id));
                }
            } else {
                routing::getInstance()->redirect('ambienteHistorialLote', 'index');
                session::getInstance()->deleteAttribute('form');
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El ambiente Historial Lote que intenta registar ya existe en la base de datos');
                    break;
                case '22P02':
                    session::getInstance()->setWarning('El campo cantida machos o hembras solamente admiten caracteres numericos mayores o iguales a (0)');
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
            routing::getInstance()->redirect('ambienteHistorialLote', 'edit', array(ambienteHistorialLoteTableClass::ID => $id));
            //routing::getInstance()->forward('security', 'new');
        }
    }

}
