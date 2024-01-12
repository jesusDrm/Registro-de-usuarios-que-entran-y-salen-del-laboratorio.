<?php 

	include_once 'conexion.php';
	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];
		$delete=$con->prepare('DELETE FROM clientes WHERE id=:id');
		$delete->execute(array(
			':id'=>$id
		));
		header('Location: administrador.php');
	}else{
		header('Location: administrador.php');
	}
 ?>