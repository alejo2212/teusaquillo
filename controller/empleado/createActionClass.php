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

        $tipoid = request::getInstance()->getPost(tipoIdentificacionTableClass::getNameField(tipoIdentificacionTableClass::ID, true));
        $fechaingre = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::FEHCA_INGRESO, true));
        $documento = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true));
        $genero = (request::getInstance()->hasPost(empleadoTableClass::getNameField(empleadoTableClass::GENERO, true))) ? request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::GENERO, true)) : '';
        $nombre = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true));
        $apellido = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true));
        $tele = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true));
        $direc = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true));
        $correo = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true));
        $cargo = request::getInstance()->getPost(cargoTableClass::getNameField(cargoTableClass::ID, true));
        $locali = request::getInstance()->getPost(localidadTableClass::getNameField(localidadTableClass::ID, true));
        $activo = 't';
        $usuario = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true));
        $foto = request::getInstance()->getFile(empleadoTableClass::getNameField(empleadoTableClass::FOTO, true));
//        exit();
        $post = array(
            empleadoTableClass::FEHCA_INGRESO => $fechaingre,
            empleadoTableClass::TIPO_ID => $tipoid,
            empleadoTableClass::DOCUMENTO => $documento,
            empleadoTableClass::GENERO => $genero,
            empleadoTableClass::NOMBRE => $nombre,
            empleadoTableClass::APELLIDO => $apellido,
            empleadoTableClass::TELEFONO => $tele,
            empleadoTableClass::DIRECCION => $direc,
            empleadoTableClass::CORREO => $correo,
            empleadoTableClass::CARGO => $cargo,
            empleadoTableClass::LOCALIZACION_ID => $locali,
            empleadoTableClass::ACTIVO => $activo,
            empleadoTableClass::FOTO => $foto,
            empleadoTableClass::USUARIO_ID => $usuario
        );
        session::getInstance()->setAttribute('form', $post);

        /**
         * VALIDACIONES
         */
        $this->Validations($tipoid,$documento,$genero,$nombre,$apellido,$tele,$direc,$correo,$cargo,$locali,$usuario, $fechaingre, $foto);
        /* ------------- */

        session::getInstance()->setAttribute(cargoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true), $documento);
        
        $data = array(
            empleadoTableClass::FEHCA_INGRESO => $fechaingre,
            empleadoTableClass::TIPO_ID => $tipoid,
            empleadoTableClass::DOCUMENTO => $documento,
            empleadoTableClass::GENERO => $genero,
            empleadoTableClass::NOMBRE => $nombre,
            empleadoTableClass::APELLIDO => $apellido,
            empleadoTableClass::TELEFONO => $tele,
            empleadoTableClass::DIRECCION => $direc,
            empleadoTableClass::CARGO => $cargo,
            empleadoTableClass::LOCALIZACION_ID => $locali,
            empleadoTableClass::FOTO => md5($foto['name'] . date('Y-m-d H:i:s')) . '.' . substr($foto['name'], -3, 3),
            empleadoTableClass::ACTIVO => $activo
        );
        
        if($usuario != '') {
            $data[empleadoTableClass::USUARIO_ID] = $usuario;
        }
        if($correo != '') {
            $data[empleadoTableClass::CORREO] = $correo;
        }
        
        empleadoTableClass::insert($data);
        move_uploaded_file($foto['tmp_name'], config::getPathAbsolute() . 'web/upload/' . $data[empleadoTableClass::FOTO]);
        session::getInstance()->setSuccess('Registro exitoso');
        
        routing::getInstance()->redirect('empleado', 'index');
      } else {
        routing::getInstance()->redirect('empleado', 'index');
      }
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('El Usuario que intenta registar ya existe en la base de datos');
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
        case 00011:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case 00012:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        case 00013:
          session::getInstance()->setWarning($exc->getMessage());
          break;
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('empleado', 'new');
      //routing::getInstance()->forward('security', 'new');
    }
  }
  
  public function Validations($tipoid,$documento,$genero,$nombre,$apellido,$tele,$direc,$correo,$cargo,$locali,$usuario, $fechaingre, $foto) {
    
    $tipoImagen = array(
        'image/jpg',
        'image/jpeg',
        'image/png',
        'image/gif',
    );
    
    $sizeImage = 1; // 1MB
//        echo '<pre>';
//    print_r($foto);
//    echo array_search($foto['type'], $tipoImagen) ? 'positivo' : 'FALSO';
//    echo '</pre>';
//    exit();
//    
//    echo number_format(($foto['size'] / 1024)/1024,3,'.','\''); // Calculo en MB
//    exit();
    if (number_format(($foto['size'] / 1024)/1024,3,'.','\'') >= $sizeImage) {
      throw new PDOException(' El tamaño de la foto  no pude ser mayor a 1MB ' , 00012);
    }
    
    if (!array_search($foto['type'], $tipoImagen)) {
      throw new PDOException(' El formato de la imagen no es el adecuado ' , 00013);
    }
    if (strtotime($fechaingre) > strtotime(date('Y-m-d H:i:s'))) {
      throw new PDOException('La Fecha no puede er Mayor a la del Sistema', 00009);
    }
    
    if (!is_numeric($tipoid)|| $tipoid === "") {
      throw new PDOException('Seleccione un Tipo de Identificacion Valida', 00010);
    }
    if (!is_numeric($documento)) {
      throw new PDOException('El numero de Documento solo admite caracteres numericos', 00008);
    }
    if ($documento === "") {
      throw new PDOException('El campo Documento no puede ir Vacio', 00007);
    }
//    if (!ereg("^[A-Za-z_]*$", $genero)) {
//      throw new PDOException('El campo Genero no puede llevar campos numericos', 00011);
//    }
    if (strlen($genero) > empleadoTableClass::GENERO_LENGTH) {
      throw new PDOException('El Genero no pude ser mayor a ' . empleadoTableClass::GENERO_LENGTH . ' caracteres', 00006);
    }
    if ($genero === "") {
      throw new PDOException('El campo Genero no puede ir Vacio', 00007);
    }
    if (strlen($nombre) > empleadoTableClass::NOMBRE_LENGTH) {
      throw new PDOException('El Nombre no pude ser mayor a ' . empleadoTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
    }
    if ($nombre === "") {
      throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
    }
//    if (!ereg("^[A-Za-z_]*$", $nombre)) {
//      throw new PDOException('El campo Nombre no puede llevar campos numericos', 00009);
//    }
    if (strlen($apellido) > empleadoTableClass::APELLIDO_LENGTH) {
      throw new PDOException('El Apellido no pude ser mayor a ' . empleadoTableClass::APELLIDO_LENGTH . ' caracteres', 00006);
    }
    if ($apellido === "") {
      throw new PDOException('El campo Apellido no puede ir Vacio', 00007);
    }
//    if (!ereg("^[A-Za-z_]*$", $apellido)) {
//      throw new PDOException('El campo Apellido no puede llevar campos numericos', 00009);
//    }
    if (!is_numeric($tele)) {
      throw new PDOException('El numero de Telefono solo admite caracteres numericos', 00008);
    }
    if ($tele === "") {
      throw new PDOException('El campo Telefono no puede ir Vacio', 00007);
    }
    if (strlen($direc) > empleadoTableClass::DIRECCION_LENGTH) {
      throw new PDOException('La Direccion no pude ser mayor a ' . empleadoTableClass::DIRECCION_LENGTH . ' caracteres', 00006);
    }
    if ($direc === "") {
      throw new PDOException('El campo Direccion no puede ir Vacio', 00007);
    }
    if (strlen($correo) > empleadoTableClass::CORREO_LENGTH) {
      throw new PDOException('El Correo no pude ser mayor a ' . empleadoTableClass::CORREO_LENGTH . ' caracteres', 00006);
    }
    if (!is_numeric($cargo)|| $cargo === "") {
      throw new PDOException('Seleccione un Cargo Valido', 00010);
    }
    if (!is_numeric($locali)|| $locali === "") {
      throw new PDOException('Seleccione una Ciudad Valida', 00010);
    }
    if (!is_numeric($locali)) {
      throw new PDOException('Seleccione un Tipo de Usuario Valido', 00010);
    }
  }

}
