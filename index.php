<?php
/*
Archivo: index.php
Propósito: Página principal del sistema de registro
Última modificación: [25/01/2024]
*/

// Inicia la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//Establece el título de la página
$title = 'Inicio';

//Incluye archivos necesarios
include_once 'conexion.php';
include_once './layouts/header.php';

//Redirige a la página administrador si el usuario es un administrador
if (isset($_SESSION['es_administrador']) && $_SESSION['es_administrador'] == true) {
    header('location: administrador.php');
}

//Configuración para paginación
$registrosPorPagina = 20;
// Página actual (por defecto, la primera página)
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
// Calcular el inicio del conjunto de resultados
$inicio = ($pagina - 1) * $registrosPorPagina;

// Consulta SQL con LIMIT para la paginación
$consulta = "SELECT * FROM registro_lns.visitantes ORDER BY fecha DESC, hora_entrada DESC LIMIT $inicio, $registrosPorPagina";
$sentencia_select = $con->prepare($consulta);
$sentencia_select->execute();
$resultado = $sentencia_select->fetchAll();
$totalRegistros = $con->query('SELECT count(*) FROM registro_lns.visitantes')->fetchColumn();

// Método de búsqueda opcional
/* 
if (isset($_POST['btn_buscar'])) {
    $buscar_text = $_POST['buscar'];
    $select_buscar = $con->prepare('SELECT * FROM registro_lns.visitantes WHERE nombre LIKE :campo OR apellido LIKE :campo;');
    $select_buscar->execute(array(':campo' => "%" . $buscar_text . "%"));
    $resultado = $select_buscar->fetchAll();

    // Recalcula el total de registros después de la búsqueda
    $totalRegistros = count($resultado);
} else {
    // Si no hay búsqueda, obtén el total de registros sin limitación
$totalRegistros = $con->query('SELECT count(*) FROM registro_lns.visitantes')->fetchColumn();    
}
*/

// Calcular el total de páginas después de la búsqueda
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);


// Consulta SQL para obtener la lista de personas
$consulta_personas = "SELECT id_personal, Nombre FROM personal";
$sentencia_personas = $con->prepare($consulta_personas);
$sentencia_personas->execute();
$personas = $sentencia_personas->fetchAll();
?>


<!-- Descarga jQuery y guárdalo localmente -->
<script src="jquery/jquery-3.7.1.min.js"></script>


<!-- jQuery UI Autocomplete -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!--Sección de registro-->
<body>
	<div class="contenedor" >
		<h2>REGISTRO 📝</h2>

		<!--Campos del formulario -->
		<div style="overflow-x:auto;margin:30px 0px 50px 0px;">
		<h2>INSERTAR REGISTRO ➕</h2>
		<form action="insert.php" method="post" >
			<div class="form-group">
				<input type="text" name="nombre" placeholder="Nombre" class="input__text">
				<input type="text" name="company" placeholder="Compañia" class="input__text">
				
				<select name="id_persona_visitada" class="input__select-dropdown">
				<option value="" disabled selected class="input__select-dropdown">Seleccione una persona</option>
				<?php foreach ($personas as $persona): ?>
					<option value="<?php echo $persona['id_personal']; ?>">
						<?php echo $persona['Nombre']; ?>
					</option>
				<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
			<input type="text" name="rfc_o_matricula" placeholder="RFC o matricula" class="input__text">
				<input type="text" name="depto" placeholder="Departamento" class="input__text">
			</div>
			<!--Botones de acción -->
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
			
		</form>
			<!-- Tabla de registros -->
			<table >
				<tr class="head">
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
				<!-- mostrar los registros -->
				<?php foreach($resultado as $fila):?>
					<tr >
						<td><?php echo $fila['nombre']; ?></td>
						<td><?php echo $fila['company']; ?></td>
						<td>
            	<?php
            // Verificar si la clave 'nom_per_visitada' está definida en $fila
            if (isset($fila['nom_per_visitada'])) {
                // Consulta para obtener el nombre de la persona visitada desde la tabla personal
                $consulta_persona = "SELECT Nombre FROM registro_lns.personal WHERE id_personal = ?";
                $sentencia_persona = $con->prepare($consulta_persona);
                $sentencia_persona->execute([$fila['nom_per_visitada']]);
                $persona_visitada = $sentencia_persona->fetchColumn();
                echo $persona_visitada;
            } else {
                echo "No disponible"; // o cualquier otro mensaje de fallback
            }
            ?>
        </td>
						<td><?php echo $fila['depto']; ?></td>
						<td><?php echo $fila['hora_entrada']; ?></td>
						<td><?php echo $fila['hora_salida']; ?></td>
						<td><?php echo $fila['fecha']; ?></td>
						<td><?php echo $fila['rfc_o_matricula']; ?></td>
						
                <!-- ... Otras columnas ... -->
				
                <td style="text-align: center;">
				<?php if ($fila['hora_salida'] === null): ?>
                <a href="salir.php?id=<?php echo $fila['id']; ?>" class="btn__salir" >Salir <i class="bi-door-open"></i></a>
				<?php endif; ?>
			</td>
					</tr>
				<?php endforeach ?>
			</table>
			
<!-- Botones de paginación -->
<div class='paginacion'>
    <?php
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
    for ($i = 1; $i <= $totalPaginas; $i++) {
        // Construir el enlace de la página actual
        $enlace = "index.php?pagina=$i";
        echo "<a href='$enlace'>$i</a> ";
    }
    ?>
</div>

		</div>
	</div>
				
				
</body>


<?php include_once './layouts/footer.php'; ?>