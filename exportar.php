<?php
include_once 'conexion.php';

$sentencia_select = $con->prepare('SELECT v.id, v.nombre, v.company, p.Nombre AS nom_per_visitada, v.depto, v.hora_entrada, v.hora_salida, v.fecha, v.rfc_o_matricula 
                                   FROM visitantes v
                                   LEFT JOIN personal p ON v.nom_per_visitada = p.id_personal');

// Configuración de encabezados para descargar como archivo CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=export.csv;');

// Encabezados del archivo CSV
echo "ID,Nombre,Company,Persona Visitada,Departamento,Hora Entrada,Hora Salida,Fecha,RFC o Matrícula\n";

if ($sentencia_select->execute()) {
    while ($r = $sentencia_select->fetch(PDO::FETCH_OBJ)) {
        echo $r->id.",";
        echo $r->nombre.",";
        echo $r->company.",";
        echo $r->nom_per_visitada.",";
        echo $r->depto.",";
        echo $r->hora_entrada.",";
        echo $r->hora_salida.",";
        echo $r->fecha.",";
        echo $r->rfc_o_matricula."\n";
    }
}
?>
