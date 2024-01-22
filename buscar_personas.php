<?php
include_once 'conexion.php';

if (isset($_POST['term'])) {
    $term = $_POST['term'];
    $select_buscar = $con->prepare('SELECT id_persona, nombre_persona FROM personas WHERE nombre_persona LIKE :term;');
    $select_buscar->execute(array(':term' => "%" . $term . "%"));
    $resultados = $select_buscar->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($resultados);
}
?>
