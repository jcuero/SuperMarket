$(document).ready(function() {

    $('#searchCliente').click(function() {
        $.ajax({
            // la URL para la petición
            url: "{{ path('sm_admin_cliente_json') }}",
            // la información a enviar
            // (también es posible utilizar una cadena de datos)
            data: {cedula: $('#cedula').val()},
            // especifica si será una petición POST o GET
            type: 'GET',
            // el tipo de información que se espera de respuesta
            dataType: 'json',
            // código a ejecutar si la petición es satisfactoria;
            // la respuesta es pasada como argumento a la función
            success: function(json_cliente) {

                if (typeof json_cliente.id == 'undefined') {
                    $('div.alert').html(json_cliente.message);
                    $('div.alert').show();
                    $('#tbodyCliente').html('');
                    return;
                }

                var items = [];
                items.push('<tr>');
                items.push('<td>' + json_cliente.cedula + '</td>');
                items.push('<td>' + json_cliente.nombres + ' ' + json_cliente.apellidos + '</td>');
                items.push('</tr>');

                $('div.alert').hide();
                $('#tbodyCliente').html(items.join(''));
            },
            // código a ejecutar si la petición falla;
            // son pasados como argumentos a la función
            // el objeto jqXHR (extensión de XMLHttpRequest), un texto con el estatus
            // de la petición y un texto con la descripción del error que haya dado el servidor
            error: function(jqXHR, status, error) {
                alert('Disculpe, existió un problema');
            },
            // código a ejecutar sin importar si la petición falló o no
            complete: function(jqXHR, status) {
                $('#cedula').val('')
            }
        });
    });
});