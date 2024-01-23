<?php
include_once 'conexion.php';

$sentencia_select = $con->prepare('SELECT * FROM visitantes ORDER BY id ASC');
$sentencia_select->execute();
$resultado = $sentencia_select->fetchAll();

$response = array('data' => $resultado);

echo json_encode($response);
?>
