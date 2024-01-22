<?php
// Verificar si la sesión no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CRUD DAW - <?php echo $title ?></title>
    <link rel="stylesheet" href="./css/estilo.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="nav">
        <input type="checkbox" id="nav-check">
        <div class="nav-header">
            <div class="nav-title">
                REGISTRO LSC 💼
            </div>
        </div>
        <div class="nav-btn">
            <label for="nav-check">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>    
        <div class="nav-links">
            <a href="index.php">Inicio</a>
            <?php
            if (isset($_SESSION['es_administrador']) && $_SESSION['es_administrador'] == true) {
                echo '<a href="controller/cerrarSesion.php">Cerrar sesión</a>';
            } else {
                echo '<a href="login.php">Login</a>';
            }
            ?>
        </div>
    </div>
