<?php
include 'conexion.php';
$usuarios=$_GET['username'];
$contrasena=$_GET['password'];


$sentencia=$conexion->prepare("SELECT * FROM user WHERE usuarios=? AND contrasena=?");
$sentencia->bind_param('ss',$usuarios,$contrasena);
$sentencia->execute();

$resultado = $sentencia->get_result();
$json = [];


if ($fila = $resultado->fetch_assoc()) {
	$identificador = $usuarios.$contrasena;
	$json = [
				"status" => "ok",
				"key" => hash("sha256", $identificador),
			];    
} else {
		$json = [

				"status" => "failed",
				"Message" => "Wrong username or password",
			];
	}

echo json_encode($json,JSON_UNESCAPED_UNICODE); 
$sentencia->close();
$conexion->close();
?>