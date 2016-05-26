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


                $id = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::ID, true));
                $activado = (request::getInstance()->hasPost(insumoTableClass::getNameField(insumoTableClass::ACTIVO, true))) ? request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::ACTIVO, true)) : 'f';
                $nombre = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true));
                $tipoinsumo = request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE, true));
                $presentacion = request::getInstance()->getPost(presentacionTableClass::getNameField(presentacionTableClass::NOMBRE, true));
                $unidadmedida = request::getInstance()->getPost(unidadMedidaTableClass::getNameField(unidadMedidaTableClass::NOMBRE, true));
                $inventariobodega = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::INVENTARIO_BODEGA, true));

                session::getInstance()->setAttribute('form', $post);
                //        if (filter_var($nombre, FILTER_VALIDATE_INT)) {
//          throw new PDOException('no pueden llevar el Nombre campos numericos', 00008);
//          echo "entro";
//        }
                /**
                 * VALIDACIONES
                 */
                // usuarioTableClass::USER_LENGTH
                if (strlen($nombre) > insumoTableClass::NOMBRE_LENGTH) {
                    throw new PDOException('El nombre  no pude ser mayor a ' . insumoTableClass::NOMBRE_LENGTH . ' caracteres', 00006);
                }
                if ($nombre === "") {
                    throw new PDOException('El campo Nombre no puede ir Vacio', 00007);
                   
                }

//                if (!ereg("^[A-Za-z_]*$", $nombre)) {
//                    throw new PDOException('no pueden llevar el Nombre campos numericos', 00008);
//                   
//                }

                if ($tipoinsumo === "") {
                    throw new PDOException('El campo tipo insumo  no puede ir Vacio', 00007);
                    
                }

                if ($presentacion === "") {
                    throw new PDOException('El campo presentacion  no puede ir Vacio', 00007);
                    
                }
                if ($unidadmedida === "") {
                    throw new PDOException('El campo unidad de medida  no puede ir Vacio', 00007);
                   
                }
                if ($inventariobodega === "") {
                    throw new PDOException('El campo cantidad en bodega no puede ir Vacio', 00007);
                    ;
                }
                if (!is_numeric($inventariobodega)) {
                    throw new PDOException('El campo cantidad en bodega no puede contener letras', '22P02');
                    
                }
                if ($inventariobodega<=-1) {
                    throw new PDOException('El campo cantidad en bodega solamente admiten caracteres numericos mayores o iguales a (0)','22P02');
                    
                }
                
                /* ------------- */
                $ids = array(
                    insumoTableClass::ID => $id
                );

                $data = array(
                    insumoTableClass::NOMBRE => $nombre,
                    insumoTableClass::ACTIVO => $activado,
                    insumoTableClass::TIPO_INSUMO_ID => $tipoinsumo,
                    insumoTableClass::PRESENTACION_ID => $presentacion,
                    insumoTableClass::UNIDAD_MEDIDA_ID => $unidadmedida,
                    insumoTableClass::INVENTARIO_BODEGA => $inventariobodega
                );


                session::getInstance()->setAttribute(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE, true), $nombre);


                insumoTableClass::update($ids, $data);
                session::getInstance()->setSuccess('Actualización exitosa');

                routing::getInstance()->redirect('insumo', 'index');
            } else {
                routing::getInstance()->redirect('insumo', 'index');
                session::getInstance()->deleteAttribute('form');
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('El  Insumo que intenta registar ya existe en la base de datos');
                    break;
                case '22P02':
                    session::getInstance()->setWarning('El campo cantidad en bodega solamente admiten caracteres numericos mayores o iguales a (0)');
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
            routing::getInstance()->redirect('insumo', 'edit', array(insumoTableClass::ID => $id));
            //routing::getInstance()->forward('security', 'new');
        }
    }

}
