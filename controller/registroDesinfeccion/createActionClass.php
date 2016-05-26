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
  @author Patricia Arteaga  <aprendiz.patricia-819@hotmail.com> */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        $respon = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::ID, true));
        $veri = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true));
        $fechare = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true));
        $fechater = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_TERMINADO, true));
        $insumo = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID, true));
        $tipdesin = request::getInstance()->getPost(tipoDesinfeccionTableClass::getNameField(tipoDesinfeccionTableClass::ID, true));
        $solucion = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::SOLUCION, true));
        $observacion = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::OBSERVACION, true));

        $cantPediluvios = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::CANT_PEDILUVIOS, true));
        $desBodega = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::DES_BODEGA, true));
        $desPediluvios = request::getInstance()->getPost(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::DES_PEDILUVIOS, true));

        $chk = request::getInstance()->getPost('chk', true);
        $ram = 'Ramada';
        foreach ($chk as $da):
          $ram.='-' . $da;
        endforeach;
        ;
        $desRamadas = $ram;
//        exit();
        $post = array(
            registroDesinfeccionTableClass::FECHA_REALIZACION => $fechare,
            registroDesinfeccionTableClass::FECHA_TERMINADO => $fechater,
            registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE => $respon,
            registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR => $veri,
            registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID => $insumo,
            registroDesinfeccionTableClass::SOLUCION => $solucion,
            registroDesinfeccionTableClass::OBSERVACION => $observacion,
            registroDesinfeccionTableClass::TIPO_DESINFECCION_ID => $tipdesin,
            registroDesinfeccionTableClass::CANT_PEDILUVIOS => $cantPediluvios,
            registroDesinfeccionTableClass::DES_BODEGA => $desBodega,
            registroDesinfeccionTableClass::DES_PEDILUVIOS => $desPediluvios,
            registroDesinfeccionTableClass::DES_RAMDAS => $desRamadas
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        // usuarioTableClass::USER_LENGTH
        $this->validations($fechare, $fechater, $insumo, $solucion, $observacion, $tipdesin, $cantPediluvios, $desBodega, $desPediluvios, $desRamadas, $veri);
        /* ------------- */


        session::getInstance()->setAttribute(registroDesinfeccionTableClass::getNameField(registroDesinfeccionTableClass::FECHA_REALIZACION, true), $fechare);

        $data = array(
            registroDesinfeccionTableClass::FECHA_REALIZACION => $fechare,
            registroDesinfeccionTableClass::FECHA_TERMINADO => $fechater,
            registroDesinfeccionTableClass::EMPLEADO_ID_RESPONSABLE => $respon,
            registroDesinfeccionTableClass::EMPLEADO_ID_VERIFICADOR => $veri,
            registroDesinfeccionTableClass::SALIDA_INSUMO_DETALLE_ID => $insumo,
            registroDesinfeccionTableClass::SOLUCION => $solucion,
            registroDesinfeccionTableClass::OBSERVACION => $observacion,
            registroDesinfeccionTableClass::TIPO_DESINFECCION_ID => $tipdesin,
            registroDesinfeccionTableClass::CANT_PEDILUVIOS => $cantPediluvios,
            registroDesinfeccionTableClass::DES_BODEGA => $desBodega,
            registroDesinfeccionTableClass::DES_PEDILUVIOS => $desPediluvios,
            registroDesinfeccionTableClass::DES_RAMDAS => $desRamadas
        );
        registroDesinfeccionTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');

        routing::getInstance()->redirect('registroDesinfeccion', 'index');
      } else {
        routing::getInstance()->redirect('registroDesinfeccion', 'index');
      }
      session::getInstance()->deleteAttribute('form');
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El registro Desinfeccion que intenta registar ya existe en la base de datos');
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
        case 00008:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case 00009:
          session::getInstance()->setWarning($exc->getMessage());
          break;
//                case '22P02':
//                    session::getInstance()->setWarning('Ingresar datos validos');
//                    break;
        default:
          session::getInstance()->setWarning($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('registroDesinfeccion', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }

  private function validations($fechare, $fechater, $insumo, $solucion, $observacion, $tipdesin, $cantPediluvios, $desBodega, $desPediluvios, $desRamadas, $veri) {
    
    if ($veri === "") {
      throw new PDOException('Seleccione el verificador de la labor', 00006);
    }
    if ($desRamadas === "Ramada") {
      throw new PDOException('Seleccione almenos una Ramada para completar el registro', 00006);
    }
    if ($desBodega === "") {
      throw new PDOException('Seleccione <strong>(Si)</strong> o <strong>(No)</strong> en la desinfeccion de Bodega', 00006);
    }
    if ($desPediluvios === "") {
      throw new PDOException('Seleccione <strong>(Si)</strong> o <strong>(No)</strong> en la desinfeccion de Pediluvios', 00006);
    }
    if (strtotime($fechare) >= strtotime($fechater)) {
      throw new PDOException('La Fecha Realizacion no puede ser Mayor que la Fecha De Terminacion ');
    }
    if (!is_numeric($insumo)) {
      throw new PDOException('El campo Numero De Salida solo puede contener caracteres numericos', 00008);
    }
    if ($insumo === "") {
      throw new PDOException('El campo Numero De Salida no puede ir Vacio', 00006);
    }
    if (strlen($solucion) > registroDesinfeccionTableClass::SOLUCION_LENGTH) {
      throw new PDOException('La Solucion  no puede ser mayor a ' . registroDesinfeccionTableClass::SOLUCION_LENGTH . ' caracteres', 00006);
    }
    if ($solucion === "") {
      throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
    }
    if ($tipdesin === "") {
      throw new PDOException('El campo Tipo DEsinfeccion no puede ir Vacio', 00007);
    }
    if (strlen($observacion) > registroDesinfeccionTableClass::OBSERVACION_LENGTH) {
      throw new PDOException('Las observaciones  no pueden ser mayor a ' . registroDesinfeccionTableClass::OBSERVACION_LENGTH . ' caracteres', 00006);
    }
  }

}
