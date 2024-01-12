// script.js
// script.js

function salir(id) {
    var hora = document.getElementById("hora").value;
    var xhr = new XMLHttpRequest();

    xhr.open("POST", "salir.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("hora=" + hora + "&id=" + id);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Puedes redirigir a index.php aquí si es necesario
            // window.location.href = "index.php";

            // O simplemente ocultar el botón
            document.getElementById("salir").style.display = "none";
        }
    };
}

