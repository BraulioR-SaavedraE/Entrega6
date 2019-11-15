<?php

require __DIR__."/db/database.php";
require __DIR__."/utilities/assert.php";

//session_start();

if($_SERVER["REQUEST_METHOD"] == "GET") {
$user = $_GET["username"];
$pass = $_GET["password"];
$consulta="SELECT * FROM user WHERE username='$user' AND password='$pass' ";
$db= Database::getInstance();
$resultado=[];

	try{
		$rs = (object)$db->consulta($consulta);
		$identificador=$user.$pass;
		$resultado = [
			"status" => "ok",
			"key" => hash("sha256", $identificador),
			];
	}catch(Exception $e) {
		$resultado = [
			"status" => "failed",
			"Message" => $e->getMessage(),
			];
	}
	echo json_encode($resultado);
}
?>