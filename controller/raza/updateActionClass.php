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
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::ID, true));
                $nombre = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::NOMBRE, true));
                $des = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::DESCRIPCION, true));
//                $foto = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::FOTO, true));
                $foto = request::getInstance()->getFile(razaTableClass::getNameField(razaTableClass::FOTO, true));
                /**
                 * VALIDACIONES
                 */
                // usuarioTableClass::USER_LENGTH
                $this->Validations($nombre, $des, $foto);
                /* ------------- */
                $ids = array(
                    razaTableClass::ID => $id
                );

                $data = array(
                    razaTableClass::NOMBRE => $nombre,
                    razaTableClass::DESCRIPCION => $des,
                    razaTableClass::FOTO => md5($foto['name'] . date('Y-m-d H:i:s')) . '.' . substr($foto['name'], -3, 3)
                );
                razaTableClass::update($ids, $data);
                move_uploaded_file($foto['tmp_name'], config::getPathAbsolute() . 'web/upload/' . $data[razaTableClass::FOTO]);
                session::getInstance()->setSuccess('Actualización exitosa');

                routing::getInstance()->redirect('raza', 'index');
            } else {
                routing::getInstance()->redirect('raza', 'index');
            }
            session::getInstance()->deleteAttribute('form');
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('La Raza que intenta registar ya existe en la base de datos');
                    break;
                case 00006:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                case '22P02':
                    session::getInstance()->setWarning('Ingresar datos validos');
                    break;
                default:
                    session::getInstance()->setError($exc->getMessage());
                    break;
            }
            routing::getInstance()->redirect('raza', 'edit', array(razaTableClass::ID => $id));
            //routing::getInstance()->forward('security', 'new');
        }
    }

    private function Validations($nombre, $des, $foto) {
        $tipoImagen = array(
        'image/jpg',
        'image/jpeg',
        'image/png',
        'image/gif',
    );
    
    $sizeImage = 1; // 1MB
    
//    echo '<pre>';
//    print_r($foto);
////    echo array_search($foto['type'], $tipoImagen) ? 'positivo' : 'FALSO';
//    echo '</pre>';
//    exit();
    
//    echo number_format(($foto['size'] / 1024)/1024,3,'.','\''); // Calculo en MB
//    exit();
    if (number_format(($foto['size'] / 1024)/1024,3,'.','\'') >= $sizeImage) {
      throw new PDOException(' El tamaño de la foto  no pude ser mayor a 1MB ' , 00009);
    }
    
    if (!array_search($foto['type'], $tipoImagen)) {
      throw new PDOException(' El formato de la imagen no es el adecuado ' , 00010);
    }
    
    if (strlen($nombre) > razaTableClass::NOMBRE_LENGTH) {
      throw new PDOException(' El nombre de la Raza no pude ser mayor a ' . razaTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
    }
    if (strlen($des) > razaTableClass::DESCRIPCION_LENGTH) {
      throw new PDOException('La descripcion de la Raza no pude ser mayor a ' . razaTableClass::DESCRIPCION_LENGTH . ' caracteres', 00006);
    }
    if ($nombre === "") {
      throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
    }
    if ($des === "") {
      throw new PDOException('El campo Descripcion no puede ir Vacio', 00007);
    }

//    if (!ereg("^[A-Za-z_]*$", $nombre)) {
//      throw new PDOException('El campo Nombre Solo admite caracteres Alfabeticos', 00008);
//    }
  }

}
