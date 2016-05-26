<?php use mvc\session\sessionClass as session ?>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
      </button>
      <a class="navbar-brand" href="<?php echo \mvc\config\configClass::getUrlBase(), \mvc\config\configClass::getIndexFile() ?>">Soveuh System |</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Sistema <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('security', 'index').'?r=true' ?>">Admin. Usuarios</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('credencial', 'index').'?r=true' ?>">Credenciales</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('localizacion', 'index').'?r=true' ?>">Localizacion</a></li>
            <li class="divider"></li>
            <li><a href="#">Ayuda</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Empleados <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('empleado', 'index').'?r=true' ?>">Empleado</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('cargo', 'index').'?r=true' ?>">Cargo</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoid', 'index').'?r=true' ?>">Tipo de Identificacion</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Produccion <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('lote', 'index').'?r=true' ?>">Lote</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteHistorialLote', 'index').'?r=true' ?>">Ambiente Historial Lote</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('raza', 'index').'?r=true' ?>">Raza</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('razonSalida', 'index').'?r=true' ?>">Razon Salida</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaLote', 'index').'?r=true' ?>">Salida Lote</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambienteInsumo', 'index').'?r=true' ?>">Ambiente Insumo</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('ambiente', 'index').'?r=true' ?>">Ambiente</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoAmbiente', 'index').'?r=true' ?>">Tipo de Ambiente</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Postura <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('postura', 'index').'?r=true' ?>">Registro Postura</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionPostura', 'index').'?r=true' ?>">Clasificacion Postura</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('incubadora', 'index').'?r=true' ?>">Incubadora</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaIncubadora', 'index').'?r=true' ?>">Salida Incubadora</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('devolucionIncubadora', 'index').'?r=true' ?>">Devolucion Incubadora</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoEmpaque', 'index').'?r=true' ?>">Tipo Empaque</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bodega <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('insumo', 'index').'?r=true' ?>">Insumo</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('presentacion', 'index').'?r=true' ?>">Presentacion de Insumo</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoInsumo', 'index').'?r=true' ?>">Tipo de Insumo</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('transportador', 'index').'?r=true' ?>">Transportador</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('unidadMedida', 'index').'?r=true' ?>">Unidad de Medida</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('entradaBodega', 'index').'?r=true' ?>">Generar Entrada de Bodega</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodega', 'index').'?r=true' ?>">Ingreso a Bodega</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('requisicion', 'index').'?r=true' ?>">Requisicion</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('salidaInsumo', 'index').'?r=true' ?>">Salida Insumo</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('bodegaClasificacion', 'index').'?r=true' ?>">Clasificacion de Bodega</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Maquinaria <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('maquina', 'index').'?r=true' ?>">Maquinas Y Equipos</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('clasificacionMaquina', 'index').'?r=true' ?>">Clasificacion de Maquina o Equipo</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('mantenimiento', 'index').'?r=true' ?>">Mantenimiento</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoMantenimiento', 'index').'?r=true' ?>">Tipo Mantenimiento</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mano de Obra <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroAlistamiento', 'index').'?r=true' ?>">Alistamiento de Galpon</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('registroDesinfeccion', 'index').'?r=true' ?>">Desinfeccion</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('alistamientoReparacion', 'index').'?r=true' ?>">Reparacion</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoDesinfeccion', 'index').'?r=true' ?>">Tipo de Desinfeccion</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('tipoReparacion', 'index').'?r=true' ?>">Tipo de Reparacion</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlAlimento', 'index').'?r=true' ?>">Control Alimento</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlRoedores', 'index').'?r=true' ?>">Control Roedores</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlCompostaje', 'index').'?r=true'?>">Control Compostaje</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('controlCucarron', 'index').'?r=true'?>">Control Cucarron</a></li>
            <?php if(session::getInstance()->hasCredential('usuario') or session::getInstance()->hasCredential('admin')): ?>
            <li class="divider"></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('formaAplicacion', 'index').'?r=true' ?>">Forma de Aplicacion</a></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('cajonCompostaje', 'index').'?r=true' ?>">Cajon Compostaje</a></li>
            <?php endif ?>
          </ul>
        </li>
      </ul>


      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Perfil</a></li>
            <li><a href="#">Cambiar Contraseña</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('shfSecurity', 'logout') ?>"><i class="fa fa-sign-out fa-fw"> </i> Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
