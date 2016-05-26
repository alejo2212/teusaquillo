$(document).ready(function() {
    $('#btnBuscarControl').click(function() {
//      alert($('#urlBuscarControl').val());
        $.ajax({
            url: $('#urlBuscarControl').val(),
            data: 'idControl=' + $('input[data-id="idBuscarControl"]').val(),
            dataType: 'json',
            type: 'POST',
            success: function(data) {
                console.log(data);
                /**
                 * data = {
                 *  code = 200,
                 *  datos = [
                 *      {nombre: hola, cantidad: 2}
                 *      {nombre: coto, cantidad: 3}
                 *  ]
                 * }
                 */
                $('#modalBuscar div[class="modal-body"]').html('');
                $('#modalBuscar div[class="modal-body"]').append('<table id="tblDatos" class="table table-bordered"><thead><tr><th style="width: 70%;">Insumo</th><th>Cantidad</th></tr></thead><tbody></tbody></table>');
                $(data.datos).each(function(index, element){
                    $('#tblDatos tbody').append('<tr><td>' + element.nombre + '</td><td>' + element.cantidad + '</td></tr>');
                });
                $('#modalBuscar').modal();
            }
        });
    });
});