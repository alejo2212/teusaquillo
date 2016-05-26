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
        $fecha = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::FECHA_REALI, true));
        $id = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::ID, true));
        $ambhislote = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID, true));
        $razonsal = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::RAZON_SALIDA_ID, true));
        $cantm = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_MACHOS, true));
        $canth = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::CANTIDAD_HEMBRAS, true));
        $empl = request::getInstance()->getPost(salidaLoteTableClass::getNameField(salidaLoteTableClass::EMPLEADO_ID, true));
        $cantt = ($cantm + $canth);
        /**
         * VALIDACIONES
         */
        // usuarioTableClass::USER_LENGTH
        $this->Validations($ambhislote, $cantt, $razonsal, $empl, $cantm, $canth, $fecha);

        /* ------------- */
        $mh = salidaLoteTableClass::getMachosHembras($id);
        foreach ($mh as $dataMH):
          echo $hL = $dataMH->hembras;
          echo $mL = $dataMH->machos;
        endforeach;
        
        /* ----------------------- HEMBRAS -------------------------- */
        echo $resH = $hL - $canth;
        if ($resH > (0)) {
//                    echo ' es mayor a cero ';
          $cantHcantM = ambienteHistorialLoteTableClass::getHemrasMahosById($ambhislote);

          foreach ($cantHcantM as $dataA):
            $h = $dataA->hembras;
          endforeach;
          echo $canH = $h + $resH;
          $ids = array(
              ambienteHistorialLoteTableClass::ID => $ambhislote
          );

          $data = array(
              ambienteHistorialLoteTableClass::CANTIDAD_HEMBRAS => $canH
          );
          ambienteHistorialLoteTableClass::update($ids, $data);
        } else {
          if ($resH < (0)) {
                    echo ' es MENOR a cero ';
            $cantHcantM = ambienteHistorialLoteTableClass::getHemrasMahosById($ambhislote);

            foreach ($cantHcantM as $dataA):
              $h = $dataA->hembras;
            endforeach;
            echo $canH = $h + $resH;
            $ids = array(
                ambienteHistorialLoteTableClass::ID => $ambhislote
            );

            $data = array(
                ambienteHistorialLoteTableClass::CANTIDAD_HEMBRAS => $canH
            );
            ambienteHistorialLoteTableClass::update($ids, $data);
          }
        }
        
        /* ----------------------- MACHOS -------------------------- */
        echo $resM = $mL - $cantm;
        if ($resM > (0)) {
//                    echo ' es mayor a cero ';
          $cantHcantM = ambienteHistorialLoteTableClass::getHemrasMahosById($ambhislote);

          foreach ($cantHcantM as $dataA):
            $m = $dataA->machos;
          endforeach;
          echo $canM = $m + $resM;
          $ids = array(
              ambienteHistorialLoteTableClass::ID => $ambhislote
          );

          $data = array(
              ambienteHistorialLoteTableClass::CANTIDAD_MACHOS => $canM
          );
          ambienteHistorialLoteTableClass::update($ids, $data);
        } else {
          if ($resM < (0)) {
                    echo ' es MENOR a cero ';
            $cantHcantM = ambienteHistorialLoteTableClass::getHemrasMahosById($ambhislote);

            foreach ($cantHcantM as $dataA):
              $m = $dataA->machos;
            endforeach;
            echo $canM = $m + $resM;
            $ids = array(
                ambienteHistorialLoteTableClass::ID => $ambhislote
            );

            $data = array(
                ambienteHistorialLoteTableClass::CANTIDAD_MACHOS => $canM
            );
            ambienteHistorialLoteTableClass::update($ids, $data);
          }
        }


        $ids = array(
            salidaLoteTableClass::ID => $id
        );

        $data = array(
            salidaLoteTableClass::FECHA_REALI => $fecha,
            salidaLoteTableClass::AMBIENTE_HISTORIAL_LOTE_ID => $ambhislote,
            salidaLoteTableClass::RAZON_SALIDA_ID => $razonsal,
            salidaLoteTableClass::CANTIDAD_TOTAL => $cantt,
            salidaLoteTableClass::CANTIDAD_MACHOS => $cantm,
            salidaLoteTableClass::CANTIDAD_HEMBRAS => $canth,
            salidaLoteTableClass::EMPLEADO_ID => $empl
        );
//        exit();
        salidaLoteTableClass::update($ids, $data);

        if ($razonsal == 1) {
          routing::getInstance()->redirect('controlCompostaje', 'new', array(salidaLoteTableClass::ID . 'SalidaLote' => $id, salidaLoteTableClass::CANTIDAD_HEMBRAS => $canth, salidaLoteTableClass::CANTIDAD_MACHOS => $cantm));
        } else {
          routing::getInstance()->redirect('salidaLote', 'index');
        }
      } else {
        routing::getInstance()->redirect('salidaLote', 'index');
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
//        case '22P02':
//          session::getInstance()->setWarning('Ingresar datos validos');
//          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('salidaLote', 'edit', array(salidaLoteTableClass::ID => $id));
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function Validations($ambhislote, $cantt, $razonsal, $empl, $cantm, $canth ,$fecha) {
    if (strtotime($fecha) > strtotime(date('Y-m-d H:i:s'))) {
      throw new PDOException('La Fecha no puede er Mayor a la del Sistema', 00009);
    }
    if ($ambhislote === "") {
      throw new PDOException('El Campo Numero Historial Lote no puede ir Vacio', 00007);
    }
    if (!is_numeric($ambhislote)) {
      throw new PDOException('El Campo  Campo Numero Historial Lote Solo Admite Datos Numericos', 00006);
    }
    if ($cantt === "") {
      throw new PDOException('El Campo Cantidad Total Nombre no puede ir Vacio', 00007);
    }
    if ($cantm === "") {
      throw new PDOException('El Campo Cantidad Machos no puede ir Vacio', 00007);
    }
    if ($canth === "") {
      throw new PDOException('El Campo Cantidad Hembras no puede ir Vacio', 00007);
    }
    if (!is_numeric($razonsal) and $razonsal == '') {
      throw new PDOException('Seleccione Una Razon Salida  Valida', 00008);
    }
    if (!is_numeric($empl) and $empl == '') {
      throw new PDOException('Seleccione un Empleado Valido', 00008);
    }
    if ($cantm === "") {
      throw new PDOException('El Campo Cantidad de Machos no puede ir Vacio', 00007);
    }
    if ($canth === "") {
      throw new PDOException('El Campo Cantidad de Hembras no puede ir Vacio', 00007);
    }

    if ($cantt <= (-1)) {
      throw new PDOException('La Cantidad Total no puede ser inferior a cero', 00008);
    }
    if ($cantm <= (-1)) {
      throw new PDOException('La Cantidad de Machos no puede ser inferior a cero', 00008);
    }
    if ($canth <= (-1)) {
      throw new PDOException('La Cantidad de Hembras no puede ser inferior a cero', 00008);
    }
  }

}
