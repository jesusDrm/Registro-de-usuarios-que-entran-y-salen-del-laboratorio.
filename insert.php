<?php 
	$title = 'Insertar';
	include_once 'conexion.php';
	include_once './layouts/header.php';
	
	
	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$company=$_POST['company'];
		$nom_per_visitada=$_POST['nom_per_visitada'];
		$depto=$_POST['depto'];
		$hora_entrada=$_POST['hora_entrada'];
		$hora_salida=$_POST['hora_salida'];
		$fecha=$_POST['fecha'];

		if(!empty($nombre) && !empty($company) && !empty($nom_per_visitada) && !empty($depto) && !empty($hora_entrada) && !empty($hora_salida)&& !empty($fecha)){
			//if(!is_numeric($)){
			//	echo "<script> alert('Ingrese un telefono valido');</script>";
			//}else{
				$consulta_insert=$con->prepare('INSERT INTO clientes(nombre,company,nom_per_visitada,depto,hora_entrada,hora_salida,fecha) VALUES(:nombre,:company,:nom_per_visitada,:depto,:hora_entrada,:hora_salida,:fecha)');
				$consulta_insert->execute(array(
					':nombre' =>$nombre,
					':company' =>$company,
					':nom_per_visitada' =>$nom_per_visitada,
					':depto' =>$depto,
					':hora_entrada' =>$hora_entrada,
					':hora_salida' =>$hora_salida,
					':fecha' =>$fecha

				));				
				header('Location: index.php');
			//}
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}

	}

	


?>


<body>
	<div class="contenedor" style="margin-top:90px;">
		<h2>INSERTAR REGISTRO ➕</h2>
		<form action="" method="post" style="margin:30px 0px 18em 0px;">
			<div class="form-group">
				<input type="text" name="nombre" placeholder="Nombre" class="input__text">
				<input type="text" name="company" placeholder="Compañia" class="input__text">
				<input type="text" name="nom_per_visitada" placeholder="Persona visitada" class="input__text">

			</div>
			<div class="form-group">
				<input type="text" name="depto" placeholder="Departamento" class="input__text">
				<input type="text" name="hora_entrada" placeholder="Hora de Entrada" class="input__text">
				<input type="text" name="hora_salida" placeholder="Hora de Salida" class="input__text">
				<input type="text" name="fecha" placeholder="Fecha" class="input__text">

			</div>
			
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
			
		</form>
	</div>
</body>


<?php include_once './layouts/footer.php'; ?>
