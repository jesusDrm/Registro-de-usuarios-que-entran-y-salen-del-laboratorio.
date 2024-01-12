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
<script src="script.js"></script>

<body>
	<div class="contenedor" >
		<h2>REGISTRO 📝</h2>
		
		<!--
		Boton de agregar registros con barra de buscar usuarios	
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="Buscar nombre o apellido" 
				value="<?php if(isset($buscar_text))echo $buscar_text?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar" >
				<a href="insert.php" class="btn btn__nuevo">Nuevo <i class="bi bi-plus-circle"></i></a>
			</form>
		</div>
		-->
		<div style="overflow-x:auto;margin:30px 0px 50px 0px;">
		<h2>INSERTAR REGISTRO ➕</h2>
		<form action="insert.php" method="post" >
			<div class="form-group">
				<input type="text" name="nombre" placeholder="Nombre" class="input__text">
				<input type="text" name="company" placeholder="Compañia" class="input__text">
				<input type="text" name="nom_per_visitada" placeholder="Persona visitada" class="input__text">
				

			</div>
			<div class="form-group">
			<input type="text" name="rfc_o_matricula" placeholder="RFC o matricula" class="input__text">
				<input type="text" name="depto" placeholder="Departamento" class="input__text">
			<!--	<input type="text" name="hora_entrada" placeholder="Hora de Entrada" class="input__text">-->
			<!--	<input type="text" name="hora_salida" placeholder="Hora de Salida" class="input__text">  -->
			<!--	<input type="text" name="fecha" placeholder="Fecha" class="input__text"> -->

			</div>
			
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
			
		</form>
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
						<!--<td style="text-align: center;"><a href="update.php?id=<?php #echo $fila['id']; ?>"  class="btn__update" >Editar <i class="bi bi-pencil-square"></i></a></td>-->
						<!--boton de salir-->
						<!--<td style="text-align: center;"><a href="salir.php?id=<?php #echo $fila['id']; ?>" class="btn__delete">Salir <i class="bi-door-open"></i></a></td> -->
            
                <!-- ... Otras columnas ... -->
                <td style="text-align: center;">

			  <!--    <a href="#" class="btn__delete" onclick="salir(<?php echo $fila['id']; ?>)">Salir <i class="bi-door-open"></i></a>-->

                <a href="salir.php?id=<?php echo $fila['id']; ?>" class="btn__delete" >Salir <i class="bi-door-open"></i></a>
                </td>
            

					</tr>
				<?php endforeach ?>
			</table>
		</div>
	</div>
		
</body>


<?php include_once './layouts/footer.php'; ?>