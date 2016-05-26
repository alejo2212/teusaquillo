$(document).ready(function() {
  $('.popover-dismiss').popover({
    trigger: 'focus'
  })
  $('a').tooltip();
  $('#slcPage').change(function() {
    paginar();
  });

  $('#chkAll').click(function() {
    $('input[name="chk[]"]').each(function() {
      if ($(this).is(':checked') == true && $('#chkAll').is(':checked') == true) {
      } else {
        $(this).prop('checked', true);
      }

      if ($(this).is(':checked') == true && $('#chkAll').is(':checked') == false) {
        $(this).removeAttr('checked');
      }
    });
  });

});

function borrarEnMasa() {
  $('#gridMain').submit();
}

function paginar() {
  window.location.href = $('#slcPage').data('url') + '?page=' + $('#slcPage').val();
}

function modalEliminar(id, url, urlHref, idModal) {
  $('#' + idModal).remove();
  $('body').append('<div class="modal fade" id="' + idModal + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h4 class="modal-title" id="myModalLabel">Confirmar eliminación</h4></div><div class="modal-body">¿Desea eliminar el registro seleccionado?</div><div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button><button type="button" class="btn btn-success" onclick="eliminarRegistro(' + id + ', \'' + url + '\', \'' + urlHref + '\')"><i id="loading" class="fa fa-circle-o-notch fa-spin fa-fw"></i> Aceptar</button></div></div></div></div>');
  $('#loading').hide();
  $('#' + idModal).modal({show: true});
}

function eliminarRegistro(id, url, urlHref) {
  $.ajax({
    url: url,
    data: 'id=' + id,
    dataType: 'json', // xml html script
    type: 'POST', // GET PUT DELET
    success: function(data) {
      if (data.code == 200) {
        window.location.href = urlHref;
      } else {
        $('#modal' + id).modal('toggle');
        $('body').append('<div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h4 class="modal-title" id="myModalLabel">ERROR EN TRANSACCIÓN</h4></div><div class="modal-body">' + data.error + '</div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button></div></div></div></div>');
        $('#modalError').modal({show: true});
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      data = {
        error: jqXHR + ' - ' + textStatus + ' - ' + errorThrown
      }
      $('#modal' + id).modal('toggle');
      $('body').append('<div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h4 class="modal-title" id="myModalLabel">ERROR EN TRANSACCIÓN</h4></div><div class="modal-body">' + data.error + '</div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button></div></div></div></div>');
      $('#modalError').modal({show: true});
    },
    beforeSend: function() {
      $('#loading').show();
    },
    complete: function() {
      $('#loading').hide();
    },
  });
}