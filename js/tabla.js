$(document).ready(function () {
    // Llamada Ajax para cargar la tabla al cargar la página
    $.ajax({
        type: "GET",
        url: "load_table.php",
        dataType: "json",
        success: function (data) {
            // Llenar la tabla con los datos obtenidos
            fillTable(data.data);
        },
        error: function (error) {
            console.error("Error al cargar la tabla: " + error);
        }
    });

    // Función para llenar la tabla con los datos obtenidos
    function fillTable(data) {
        var tableBody = $("table tbody");

        // Limpiar el contenido actual de la tabla
        tableBody.empty();

        // Iterar sobre los datos y agregar filas a la tabla
        $.each(data, function (index, row) {
            var newRow = "<tr>" +
                "<td>" + row.nombre + "</td>" +
                "<td>" + row.company + "</td>" +
                "<td>" + row.nom_per_visitada + "</td>" +
                "<td>" + row.depto + "</td>" +
                "<td>" + row.hora_entrada + "</td>" +
                "<td>" + row.hora_salida + "</td>" +
                "<td>" + row.fecha + "</td>" +
                "<td>" + row.rfc_o_matricula + "</td>" +
                // Añadir más columnas según sea necesario
                "<td style='text-align: center;'><a href='salir.php?id=" + row.id + "' class='btn__salir'>Salir <i class='bi-door-open'></i></a></td>" +
                "</tr>";

            tableBody.append(newRow);
        });
    }
});
