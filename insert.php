<?php 
	$title = 'Insertar';
	include_once 'conexion.php';
	include_once './layouts/header.php';
	
	date_default_timezone_set('America/Mexico_City');
	#$fecha_actual=date("Y-m-d");
	$hora_actual = date('H:i:s');
	$fecha_actual = date('Y-m-d');
	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$company=$_POST['company'];
		$nom_per_visitada=$_POST['id_persona_visitada'];
		$depto=$_POST['depto'];
		$hora_entrada=$hora_actual;
		$fecha=$fecha_actual;
		$rfc_o_matricula=$_POST['rfc_o_matricula'];

		if(!empty($nombre) && !empty($company) && !empty($nom_per_visitada) && !empty($depto)&& !empty($rfc_o_matricula) ){
			//if(!is_numeric($)){
			//	echo "<script> alert('Ingrese un telefono valido');</script>";
			//}else{
				$consulta_insert=$con->prepare('INSERT INTO clientes(nombre,company,nom_per_visitada,depto,hora_entrada,fecha,rfc_o_matricula) VALUES(:nombre,:company,:nom_per_visitada,:depto,:hora_entrada,:fecha,:rfc_o_matricula)');
				$consulta_insert->execute(array(
					':nombre' =>$nombre,
					':company' =>$company,
					':nom_per_visitada' =>$nom_per_visitada,
					':depto' =>$depto,
					':hora_entrada' =>$hora_entrada,
					':fecha' =>$fecha,
					':rfc_o_matricula' =>$rfc_o_matricula
				));				
				header('Location: index.php');
			//}
		}
		else{
			echo "<script> alert('Los campos estan vacios');</script>";
			header('Location: index.php');
		}

	}

	


?>




<?php include_once './layouts/footer.php'; ?>
