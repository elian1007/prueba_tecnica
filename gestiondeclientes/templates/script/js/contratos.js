$(document).ready(function() {
    $('#formulario-contrato').submit(function(event) {
        // Evitar que se envíe el formulario por defecto
        event.preventDefault();

        // Realizar validaciones
        var numeroLinea = $('#numeroLinea').val();
        var fechaActivacion = $('#fechaActivacion').val();
        var valorPlan = $('#valorPlan').val();

        if (!/^\d+$/.test(numeroLinea)) {
            alert('El número de línea debe ser un valor numérico.');
            return;
        }

        if (fechaActivacion === '') {
            alert('Debes seleccionar una fecha de activación.');
            return;
        }

        if (isNaN(parseFloat(valorPlan))) {
            alert('El valor del plan debe ser un número válido.');
            return;
        }

        // Si todas las validaciones pasan, puedes enviar el formulario a través de AJAX o realizar otras acciones.

        // Ejemplo de envío a través de AJAX (debe adaptarse a tu backend):
        $.ajax({
            url: 'guardar_contrato.php', // URL para guardar el contrato
            method: 'POST',
            data: $('#formulario-contrato').serialize(),
            success: function(response) {
                alert('Contrato guardado exitosamente.');
                // Restablecer el formulario si es necesario
            }
        });
    });
});
