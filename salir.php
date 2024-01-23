<?php 

	include_once 'conexion.php';
    
	if(isset($_GET['id'])){
      
		$id=(int) $_GET['id'];
        $buscar_id = $con->prepare('SELECT * FROM visitantes WHERE id = :id LIMIT 1');
		$buscar_id->execute(array(
			':id' => $id
		));

        
        $resultado = $buscar_id->fetch();
        date_default_timezone_set('America/Mexico_City');
    $hora_actual = date('H:i:s');
    
        $hora_salida = $hora_actual;
        $id = (int)$_GET['id'];

            $consulta_update = $con->prepare('
                UPDATE visitantes
                SET hora_salida = :hora_salida
                WHERE id = :id;'
            );
    
            $consulta_update->execute(array(
                ':hora_salida' => $hora_salida,
                ':id' => $id
            ));
    
            header("Location: index.php");
    
	}else{
        
		header('Location: index.php');
	}
    

 ?>