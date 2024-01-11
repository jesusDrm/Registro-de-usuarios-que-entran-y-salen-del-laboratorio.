<?php
	$title = 'Inicio';
	include_once 'conexion.php';
	include_once './layouts/header.php';	

	$sentencia_select=$con->prepare('SELECT * FROM clientes ORDER BY id ASC');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	// metodo buscar
	// busca por nombre o apellido
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('
			SELECT *FROM clientes WHERE nombre LIKE :campo OR apellido LIKE :campo;'
		);

		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));

		$resultado=$select_buscar->fetchAll();
	}
?>
<body>
	<div class="contenedor" >
		<h2>REGISTRO 📝</h2>
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="Buscar nombre o apellido" 
				value="<?php if(isset($buscar_text))echo $buscar_text?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar" >
				<a href="insert.php" class="btn btn__nuevo">Nuevo <i class="bi bi-plus-circle"></i></a>
			</form>
		</div>
		<div style="overflow-x:auto;margin:30px 0px 50px 0px;">
			<table >
				<tr class="head">
					<!--<td>#ID</td>-->
					<td>Nombre</td>
					<td>Compañia</td>
					<td>Nombre de persona visitada</td>
					<td>Departamento</td>
					<td>Hora de entrada</td>
					<td>Hora de salida</td>
					<td>Fecha</td>
					<td>RFC o matricula</td>
					<td colspan="2">Acción</td>
				</tr>
				<?php foreach($resultado as $fila):?>
					<tr >
						<!--<td><?php //echo $fila['id']; ?></td>-->
						<td><?php echo $fila['nombre']; ?></td>
						<td><?php echo $fila['company']; ?></td>
						<td><?php echo $fila['nom_per_visitada']; ?></td>
						<td><?php echo $fila['depto']; ?></td>
						<td><?php echo $fila['hora_entrada']; ?></td>
						<td><?php echo $fila['hora_salida']; ?></td>
						<td><?php echo $fila['fecha']; ?></td>
						<td><?php echo $fila['rfc_o_matricula']; ?></td>
						<td style="text-align: center;"><a href="update.php?id=<?php echo $fila['id']; ?>"  class="btn__update" >Editar <i class="bi bi-pencil-square"></i></a></td>
						<td style="text-align: center;"><a href="delete.php?id=<?php echo $fila['id']; ?>" class="btn__delete">Eliminar <i class="bi bi-trash2"></i></a></td>
					</tr>
				<?php endforeach ?>
			</table>
		</div>
	</div>
</body>


<?php include_once './layouts/footer.php'; ?>