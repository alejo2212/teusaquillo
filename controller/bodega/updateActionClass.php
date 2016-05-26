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


        $id = request::getInstance()->getPost(bodegaTableClass::getNameField(bodegaTableClass::ID, true));
        $lote = request::getInstance()->getPost(loteTableClass::getNameField(loteTableClass::LOTE, true));
        $bodeclasi = request::getInstance()->getPost(bodegaClasificacionTableClass::getNameField(bodegaClasificacionTableClass::NOMBRE, true));
        $insumo = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::NOMBRE, true));
        $remision = request::getInstance()->getPost(bodegaTableClass::getNameField(bodegaTableClass::ENTRADA_BODEGA_ID, true));
        $fechaven = request::getInstance()->getPost(bodegaTableClass::getNameField(bodegaTableClass::FECHA_VENCIMIENTO, true));
        $cantidad = request::getInstance()->getPost(bodegaTableClass::getNameField(bodegaTableClass::CANTIDAD, true));
        $activado = (request::getInstance()->hasPost(bodegaTableClass::getNameField(bodegaTableClass::ACTIVO, true))) ? request::getInstance()->getPost(bodegaTableClass::getNameField(bodegaTableClass::ACTIVO, true)) : 'f';


        session::getInstance()->setAttribute('form', $post);
//        if (filter_var($nombre, FILTER_VALIDATE_INT)) {
//          throw new PDOException('no pueden llevar el Nombre campos numericos', 00008);
//          echo "entro";
//        }
        /**
         * VALIDACIONES
         */
// usuarioTableClass::USER_LENGTH
        if ($lote === "") {
          throw new PDOException('El campo lote  no puede ir Vacio', 00007);
          echo "entro";
        }

        if ($bodeclasi === "") {
          throw new PDOException('El campo bodega clasificacion  no puede ir Vacio', 00007);
          echo "entro";
        }
        if ($insumo === "") {
          throw new PDOException('El campo insumo  no puede ir Vacio', 00007);
          echo "entro";
        }
        if ($remision === "") {
          throw new PDOException('El campo Numero de entrada bodega  no puede ir Vacio', 00007);
          echo "entro";
        }

        if (!is_numeric($remision)) {
          throw new PDOException('El campo numero entrada de bodega no puede contener letras', 00008);
          echo "entro";
        }
        if ($remision <= 0) {
          throw new PDOException('El campo numero entrada de bodega no puede ser inferior o igual a (0)', 00008);
        }
        if ($fechaven === "") {
          throw new PDOException('El campo fecha de vencimiento  no puede ir Vacio', 00007);
          echo "entro";
        }
        if ($cantidad === "") {
          throw new PDOException('El campo cantida no puede ir Vacio', 00007);
          echo "entro";
        }
        if (!is_numeric($cantidad)) {
          throw new PDOException('El campo cantida existente no puede contener letras', 00008);
          echo "entro";
        }
        if ($cantidad <= -1) {
          throw new PDOException('El campo cantida no puede contener letras', 00009);
        }
        /* ------------- */


        $entrabodega = entradaBodegaTableClass::getIdandRemision($remision);
//                exit();
        if ($entrabodega == "") {
          throw new PDOException('El numero de entrada bodega (Remision) que ingreso, No existe en la base de datos', 00007);
        }

        $res = bodegaTableClass::getCantidadInsumoById($id) - $cantidad;
        if ($res > (0)) {

          echo $sumcantinsumo = insumoTableClass::getCantidadInsumoById($insumo) - $res;
          $idsi = array(
              insumoTableClass::ID => $insumo
          );

          $datai = array(
              insumoTableClass::INVENTARIO_BODEGA => $sumcantinsumo
          );
          insumoTableClass::update($idsi, $datai);
        } else {
          if ($res < (0)) {

            echo $sumcantinsumo = insumoTableClass::getCantidadInsumoById($insumo) - $res;
            $idsi = array(
                insumoTableClass::ID => $insumo
            );

            $datai = array(
                insumoTableClass::INVENTARIO_BODEGA => $sumcantinsumo
            );
            insumoTableClass::update($idsi, $datai);
          }
        }
//        exit();


        $ids = array(
            bodegaTableClass::ID => $id
        );
        $data = array(
            bodegaTableClass::LOTE_ID => $lote,
            bodegaTableClass::BODEGA_CLASIFICACION_ID => $bodeclasi,
            bodegaTableClass::INSUMO_ID => $insumo,
            bodegaTableClass::ENTRADA_BODEGA_ID => $entrabodega,
            bodegaTableClass::FECHA_VENCIMIENTO => $fechaven,
            bodegaTableClass::CANTIDAD => $cantidad,
            bodegaTableClass::ACTIVO => $activado
        );



        bodegaTableClass::update($ids, $data);
        session::getInstance()->setSuccess('Actualización exitosa');

        routing::getInstance()->redirect('bodega', 'index');
      } else {
        routing::getInstance()->redirect('bodega', 'index');
        session::getInstance()->deleteAttribute('form');
      }
    } catch (PDOException $exc) {
      switch ($exc->getCode()) {
        case 23505:
          session::getInstance()->setError('La bodega que intenta registar ya existe en la base de datos');
          break;
//                case '22P02':
//                    session::getInstance()->setWarning('El campo cantidad en bodega solamente admiten caracteres numericos');
//                    break;
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
        default:
          session::getInstance()->setError($exc->getMessage());
          break;
      }
      routing::getInstance()->redirect('bodega', 'edit', array(bodegaTableClass::ID => $id));
//routing::getInstance()->forward('security', 'new');
    }
  }

}
