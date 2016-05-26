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
class createActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {


                $empleado = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true));
                $transportador = request::getInstance()->getPost(transportadorTableClass::getNameField(transportadorTableClass::NOMBRE, true));
                $fechaentrada = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA_ENTRADA, true));
                $remision = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::REMISION, true));
                $observacion = request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::OBSERVACION, true));

                $post = array(
                    entradaBodegaTableClass::EMPLEADO_ID => $empleado,
                    entradaBodegaTableClass::TRANSPORTADOR_ID => $transportador,
                    entradaBodegaTableClass::FECHA_ENTRADA => $fechaentrada,
                    entradaBodegaTableClass::REMISION => $remision,
                    entradaBodegaTableClass::OBSERVACION => $observacion
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
                if ($empleado === "") {
                    throw new PDOException('El campo empleado  no puede ir Vacio', 00007);
                }

                if ($transportador === "") {
                    throw new PDOException('El campo transportador  no puede ir Vacio', 00007);
                }

                if (strtotime($fechaentrada) > strtotime(date('Y-m-d H:i:s'))) {
                    throw new PDOException('Fecha mayor');
                }

                if (!is_numeric($remision)) {
                    throw new PDOException('El campo remision  no puede contener letras', 00010);
                }
                if ($remision <= -1) {
                    throw new PDOException('El campo remision no puede contener letras', 00011);
                }

                /* ------------- */
                $data = array(
                    entradaBodegaTableClass::EMPLEADO_ID => $empleado,
                    entradaBodegaTableClass::TRANSPORTADOR_ID => $transportador,
                    entradaBodegaTableClass::FECHA_ENTRADA => $fechaentrada,
                    entradaBodegaTableClass::REMISION => $remision,
                    entradaBodegaTableClass::OBSERVACION => $observacion
                );

//                session::getInstance()->setAttribute(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::NOMBRE, true), $nombre);
                //exit();


                entradaBodegaTableClass::insert($data);
                session::getInstance()->setSuccess('Registro exitoso');

                routing::getInstance()->redirect('entradaBodega', 'index');
            } else {
                routing::getInstance()->redirect('entradaBodega', 'index');
                session::getInstance()->deleteAttribute('form');
            }
        } catch (PDOException $exc) {
            switch ($exc->getCode()) {
                case 23505:
                    session::getInstance()->setError('La entrada de bodega que intenta registar ya existe en la base de datos');
                    break;
                case '22P02':
                    session::getInstance()->setWarning('El campo remision solamente admiten caracteres numericos mayores o iguales a (0)');
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
                case 00010:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                case 00011:
                    session::getInstance()->setWarning($exc->getMessage());
                    break;
                default:
                    session::getInstance()->setError($exc->getMessage());
                    break;
            }
            routing::getInstance()->redirect('entradaBodega', 'new', array(entradaBodegaTableClass::ID => $id));
            //routing::getInstance()->forward('security', 'new');
        }
    }

}