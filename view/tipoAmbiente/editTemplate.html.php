<?php \mvc\view\viewClass::includePartial('default/menuPrincipal') ?>
<div class="container container-fluid">
  <fieldset>
    <legend><h1><i class="fa fa-edit"></i> Editar Tipo Ambiente</h1></legend>
    <?php \mvc\view\viewClass::includePartial('tipoAmbiente/formtipoAmbiente', array('edit' => $edit, 'TipoAmbiente' => $TipoAmbiente)) ?>
  </fieldset>
</div>