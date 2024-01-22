<?php 
include_once 'conexion.php';

$sentencia_select = $con->prepare('SELECT c.id, c.nombre, c.company, p.Nombre AS nom_per_visitada, c.depto, c.hora_entrada, c.hora_salida, c.fecha, c.rfc_o_matricula FROM clientes c
                                    LEFT JOIN personal p ON c.nom_per_visitada = p.id_personal');
    
if ($sentencia_select->execute()) {
    // Encabezados del archivo CSV
    echo "ID,Nombre,Company,Persona Visitada,Departamento,Hora Entrada,Hora Salida,Fecha,RFC o Matrícula\n";

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

// Configuración de encabezados para descargar como archivo CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=export.csv;');
?>
