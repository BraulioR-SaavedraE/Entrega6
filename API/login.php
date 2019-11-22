<?php

require __DIR__."/db/database.php";

//session_start();

if($_SERVER["REQUEST_METHOD"] == "GET") {
$user = $_GET["username"];
$pass = $_GET["password"];
$consulta="SELECT * FROM user WHERE username='$user' AND password='$pass' ";
$db= Database::getInstance();
$resultado=[];

	try{
		$rs = $db->consulta($consulta);
		$identificador=$user.$pass;
		if (count($rs) > 0) {
			$resultado = [
				"status" => "ok",
				"key" => hash("sha256", $identificador),
			];
		} else {
			$resultado = [
				"status" => "failed",
				"key" => "incorrect username or password",
			];
		}
	}catch(Exception $e) {
		$resultado = [
			"status" => "failed",
			"Message" => $e->getMessage(),
		];
	}
	echo json_encode($resultado);
}
?>