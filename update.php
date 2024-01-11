<?php
	$title = 'Actualizar';
	include_once 'conexion.php';
	include_once './layouts/header.php';

	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];

		$buscar_id = $con->prepare('SELECT * FROM clientes WHERE id = :id LIMIT 1');
		$buscar_id->execute(array(
			':id' => $id
		));
		$resultado = $buscar_id->fetch();
	}else{
		header('Location: index.php');
	}

	if(isset($_POST['guardar'])){
		$nombre = $_POST['nombre'];
		$company = $_POST['company'];
		$nom_per_visitada = $_POST['nom_per_visitada'];
		$depto = $_POST['depto']; // Agregado, asegúrate de que este campo esté en el formulario
		$hora_entrada = $_POST['hora_entrada'];
		$hora_salida = $_POST['hora_salida'];
		$fecha = $_POST['fecha'];
		$id = (int)$_GET['id'];

		if(!empty($nombre) && !empty($company) && !empty($nom_per_visitada) && !empty($depto) && !empty($hora_entrada) && !empty($hora_salida) && !empty($fecha)){
			$consulta_update = $con->prepare('
				UPDATE clientes SET  
				nombre = :nombre,
				company = :company,
				nom_per_visitada = :nom_per_visitada,
				depto = :depto,
				hora_entrada = :hora_entrada,
				hora_salida = :hora_salida,
				fecha = :fecha
				WHERE id = :id;'
			);

			$consulta_update->execute(array(
				':nombre' => $nombre,
				':company' => $company,
				':nom_per_visitada' => $nom_per_visitada,
				':depto' => $depto,
				':hora_entrada' => $hora_entrada,
				':hora_salida' => $hora_salida,
				':fecha' => $fecha,
				':id' => $id
			));

			header('Location: index.php');
		}else{
			echo "<script> alert('Los campos están vacíos');</script>";
		}
	}
?>

<body>
	<div class="contenedor" style="margin-top:90px;">
		<h2 >ACTUALIZAR ✏️</h2>
		<form action="" method="post" style="margin:30px 0px 18em 0px;">
			<div class="form-group">
				<input type="text" name="nombre" value="<?php if($resultado) echo $resultado['nombre']; ?>"  class="input__text">
				<input type="text" name="company" value="<?php if($resultado) echo $resultado['company']; ?>"  class="input__text">
				<input type="text" name="nom_per_visitada" value="<?php if($resultado) echo $resultado['nom_per_visitada']; ?>"  class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="depto" value="<?php if($resultado) echo $resultado['depto']; ?>" class="input__text">
				<input type="text" name="hora_entrada" value="<?php if($resultado) echo $resultado['hora_entrada']; ?>"  class="input__text">
				<input type="text" name="hora_salida"  value="<?php if($resultado) echo $resultado['hora_salida']; ?>" class="input__text">
				<input type="text" name="fecha"  value="<?php if($resultado) echo $resultado['fecha']; ?>" class="input__text">
			</div>
			<div class="btn__group" >
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>

<?php include_once './layouts/footer.php'; ?>
