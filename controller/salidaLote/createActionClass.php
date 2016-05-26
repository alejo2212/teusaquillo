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

        $fecha = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::FECHA_REALI, true));
        $ambhislote = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true));
        $razonsal = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::RAZON_SALIDA_ID, true));
        $cantm = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_MACHOS, true));
        $canth = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_HEMBRAS, true));
        $empl = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::EMPLEADO_ID, true));
        $cantt = ($cantm + $canth);
//                exit();
        $post = array(
            salidaLoteTableClass::FECHA_REALI => $fecha,
            salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID => $ambhislote,
            salidaLoteTableClass::RAZON_SALIDA_ID => $razonsal,
            salidaLoteTableClass::CANTIDAD_TOTAL => $cantt,
            salidaLoteTableClass::CANTIDAD_HEMBRAS => $canth,
            salidaLoteTableClass::CANTIDAD_MACHOS => $cantm,
            salidaLoteTableClass::EMPLEADO_ID => $empl
        );
        session::getInstance()->setAttribute('form', $post);
        //        if (filter_var($nombre, FILTER_VALIDATE_INT)) {
//          throw new PDOException('no pueden llevar el Nombre campos numericos', 00008);
//          echo "entro";
//        }
        /**
         * VALIDACIONES
         */
        // usuarioTableClass::USER_LENGTH
        $this->Validations($ambhislote, $cantt, $razonsal, $empl, $cantm, $canth, $fecha);

        /* ------------- */


//                session::getInstance()->setAttribute(salidaLoteTableClass::getNameField(salidaLoteTableClass::NOMBRE, true), $nombre);

        $data = array(
            salidaLoteTableClass::FECHA_REALI => $fecha,
            salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID => $ambhislote,
            salidaLoteTableClass::RAZON_SALIDA_ID => $razonsal,
            salidaLoteTableClass::CANTIDAD_TOTAL => $cantt,
            salidaLoteTableClass::CANTIDAD_MACHOS => $cantm,
            salidaLoteTableClass::CANTIDAD_HEMBRAS => $canth,
            salidaLoteTableClass::EMPLEADO_ID => $empl
        );

        $cantHcantM = ambienteHistorialLoteTableClass::getHemrasMahosById($ambhislote);
        foreach ($cantHcantM as $dataA):
          $h = $dataA->hembras;
          $m = $dataA->machos;
          $codLote = $dataA->lote;
        endforeach;
        $lote = loteTableClass::getLote($codLote);
        $hembras = $h - $canth;
        $machos = $m - $cantm;
//        exit();
        $this->Insert($ambhislote, $hembras, $machos, $data, $razonsal, $h, $m, $canth, $cantm);
      } else {
        routing::getInstance()->redirect('salidaLote', 'index');
      }
      session::getInstance()->deleteAttribute('form');
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La Salida Lote que intenta registar ya existe en la base de datos');
          break;
        case 00006:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case 00007:
          session::getInstance()->setWarning($exc->getMessage());
          break;
//                case '22P02':
//                    session::getInstance()->setWarning('Ingresar datos validos');
//                    break;
        case 00008:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case 00100:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('salidaLote', 'new');
    }
  }

  private function Validations($ambhislote, $cantt, $razonsal, $empl, $cantm, $canth, $fecha) {
    if (strtotime($fecha) > strtotime(date('Y-m-d H:i:s'))) {
      throw new PDOException('La Fecha no puede er Mayor a la del Sistema', 00009);
    }
    if ($razonsal === "") {
      throw new PDOException('El Campo Razon no puede ir Vacio', 00007);
    }
    if (!is_numeric($razonsal)) {
      throw new PDOException('El Campo Razon Lote Solo Admite Datos Numericos', 00006);
    }
    if ($ambhislote === "") {
      throw new PDOException('El Campo Ambiente Historial Lote no puede ir Vacio', 00007);
    }
    if ($empl === "") {
      throw new PDOException('El Campo Empleado no puede ir Vacio', 00007);
    }
    if (!is_numeric($ambhislote)) {
      throw new PDOException('El Campo Historial Lote Solo Admite Datos Numericos', 00006);
    }
    if ($cantt === "") {
      throw new PDOException('El Campo Cantidad Total Nombre no puede ir Vacio', 00007);
    }
    if ($cantm === "") {
      throw new PDOException('El Campo Cantidad de Machos no puede ir Vacio', 00007);
    }
    if ($canth === "") {
      throw new PDOException('El Campo Cantidad de Hembras no puede ir Vacio', 00007);
    }
    if (!is_numeric($cantt)) {
      throw new PDOException('El Campo Cantidad Total Solo Admite Datos Numericos', 00006);
    }
    if ($cantm <= (-1)) {
      throw new PDOException('La cantidad de machos no puede ser inferior a cero', 00008);
    }
    if ($cantt <= (-1)) {
      throw new PDOException('La Cantidad Total no puede ser inferior a cero', 00008);
    }
    if ($canth <= (-1)) {
      throw new PDOException('La Cantidad de Hembras no puede ser inferior a cero', 00008);
    }
  }

  private function Insert($ambhislote, $hembras, $machos, $data, $razonsal, $h, $m, $canth, $cantm) {
    
    if ($hembras >= (0) and $machos >= (0)) {
//          echo 'entro';
//          exit();
      ambienteHistorialLoteTableClass::updateAmbienteHistorialLoteById($ambhislote, $hembras, $machos);

      salidaLoteTableClass::insert($data);
      session::getInstance()->setSuccess('Registro Exitoso');
      if ($razonsal == 1 || $razonsal == 6) {
        $idSalida = salidaLoteTableClass::getIdSalidaLote();
        routing::getInstance()->redirect('controlCompostaje', 'new', array(salidaLoteTableClass::ID.'SalidaLote' => $idSalida, salidaLoteTableClass::CANTIDAD_HEMBRAS => $canth, salidaLoteTableClass::CANTIDAD_MACHOS => $cantm));
      } else {
        routing::getInstance()->redirect('salidaLote', 'index');
      }
    } else {
//          echo 'no entro';
//          exit();
      $ambi = ambienteHistorialLoteTableClass::getAmbienteHistLoteById($ambhislote);
      throw new PDOException('A sobrepasado la cantidad de aves que existe en la <strong>"' . $ambi->nombre . ' - Lote:' . $ambi->lote . ' - Caseta:' . $ambi->no_caseta . '"</strong>. Disponible (Hembras:<strong>' . $h . '</strong>) (Machos:<strong>' . $m . '</strong>)', 00100);

//          routing::getInstance()->redirect('salidaLote', 'new');
    }
  }

}
