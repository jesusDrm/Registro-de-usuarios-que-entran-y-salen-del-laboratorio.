<?php 
    include_once 'conexion.php';
    

    $sentencia_select = $con->prepare('SELECT * FROM clientes');
    
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
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename=export.csv;');
?>
