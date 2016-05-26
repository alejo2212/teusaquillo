<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of indexActionClass
 *
 * @author Jhonny Alejandro Diaz <Jhonny2212@hotmail.com>
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $clasiMaqui = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::CLASIFICACION_MAQUINA_ID, true));
        $fechaIngre = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::FECHA_INGRESO, true));
        $descrip = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::DESCRIPCION, true));
        $codigo = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::CODIGO, true));
        $referencia = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::REFERENCIA, true));
        $fechaMante = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::FECHA_MANTENIMIENTO, true));
        $intervaloMante = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::INTERVALO_MANTENIMIENTO, true));
        $activo = 't';
        $valor = request::getInstance()->getPost(maquinaTableClass::getNameField(maquinaTableClass::VALOR, true));
        
//        exit();
        $post = array(
            maquinaTableClass::CLASIFICACION_MAQUINA_ID => $clasiMaqui,
            maquinaTableClass::FECHA_INGRESO => $fechaIngre,
            maquinaTableClass::DESCRIPCION => $descrip,
            maquinaTableClass::CODIGO => $codigo,
            maquinaTableClass::REFERENCIA => $referencia,
            maquinaTableClass::FECHA_MANTENIMIENTO => $fechaMante,
            maquinaTableClass::INTERVALO_MANTENIMIENTO => $intervaloMante,
            maquinaTableClass::ACTIVADO => $activo,
            maquinaTableClass::VALOR => $valor
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        $this->Validations($clasiMaqui,$fechaIngre,$descrip,$codigo,$referencia,$fechaMante,$intervaloMante,$activo,$valor);
        /* ------------- */
        
        $data = array(
            maquinaTableClass::CLASIFICACION_MAQUINA_ID => $clasiMaqui,
            maquinaTableClass::FECHA_INGRESO => $fechaIngre,
            maquinaTableClass::DESCRIPCION => $descrip,
            maquinaTableClass::CODIGO => $codigo,
            maquinaTableClass::REFERENCIA => $referencia,
            maquinaTableClass::FECHA_MANTENIMIENTO => $fechaMante,
            maquinaTableClass::INTERVALO_MANTENIMIENTO => $intervaloMante,
            maquinaTableClass::ACTIVADO => $activo,
            maquinaTableClass::VALOR => $valor
        );
        maquinaTableClass::insert($data);
        session::getInstance()->setSuccess('Registro exitoso');
        
        routing::getInstance()->redirect('maquina', 'index');
      } else {
        routing::getInstance()->redirect('maquina', 'index');
      }
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La maquina que intenta registar ya existe en la base de datos');
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
        case 00009:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case 00010:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('maquina', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }
  
  public function Validations($clasiMaqui,$fechaIngre,$descrip,$codigo,$referencia,$fechaMante,$intervaloMante,$activo,$valor) {
    if (!is_numeric($clasiMaqui)|| $clasiMaqui === "") {
      throw new PDOException('Seleccione una clasificacion de maquina Valida', 00010);
    }
    if (strtotime($fechaIngre) > strtotime(date('Y-m-d H:i:s'))) {
      throw new PDOException('La Fecha de Ingreso no puede ser Mayor a la del Sistema');
    }
    if (strlen($descrip) > maquinaTableClass::DESCRIPCION_LENGTH) {
      throw new PDOException('La descripcion no pude ser mayor a ' . maquinaTableClass::DESCRIPCION_LENGTH . ' caracteres', 00006);
    }
    if ($codigo === "") {
      throw new PDOException('El codigo no puede ir Vacio', 00007);
    }
    if (strlen($codigo) > maquinaTableClass::CODIGO_LENGTH) {
      throw new PDOException('El codigo no pude ser mayor a ' . maquinaTableClass::CODIGO_LENGTH . ' caracteres', 00006);
    }
     if ($referencia === "") {
      throw new PDOException('La referencia no puede ir Vacio', 00007);
    }
    if (strlen($referencia) > maquinaTableClass::REFERENCIA_LENGTH) {
      throw new PDOException('La referencia no pude ser mayor a ' . maquinaTableClass::REFERENCIA_LENGTH . ' caracteres', 00006);
    }
    if (strtotime($fechaMante) < strtotime($fechaIngre)) {
      throw new PDOException('La Fecha de Mantenimiento no puede ser Menor a la Fecha de Ingreso');
    }
    if (!is_numeric($intervaloMante)) {
      throw new PDOException('El intervalo de Mantenimiento solo admite caracteres numericos', 00008);
    }
    if ($intervaloMante === "") {
      throw new PDOException('El intervalo de Mantenimiento no puede ir Vacio', 00007);
    }
    if (!is_numeric($valor)) {
      throw new PDOException('El Valor solo admite caracteres numericos', 00008);
    }
    if ($valor === "") {
      throw new PDOException('El Valor no puede ir Vacio', 00007);
    }
  }
}
