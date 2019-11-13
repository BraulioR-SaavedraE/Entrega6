<?php
//error_reporting(E_ERROR | E_PARSE);
mb_internal_encoding("utf-8");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
require_once __DIR__."/db/database.php";
require_once __DIR__."/utilities/assert.php";
try{
    $res = [];
    switch($_SERVER["REQUEST_METHOD"]){
        case "GET":
            assert_array_parameters($_GET, ["username", 'password']);
            $username = $_GET["username"];
            $password = $_GET["password"];
            $bd = Database::getInstance();
            $rs = (object)$bd->call_procedure("sp_signup", "'$username','$password'")[0];
            if ($rs->msj == 'ok') {
                $res = [
                    "status" => 'ok'
                ];
            } else {
                $res = [
                    'status' => 'failed',
                    'message' => $rs->msj
                ];
            }
            break;
        default:
            http_response_code(400);
            echo "Método no soportado";
            exit();
    }
    echo json_encode($res);
}catch(Exception $e){
    http_response_code(500);
    $errorMessage = [
        "status" => "Server error",
        "message" => $e->getMessage()
    ];
    echo json_encode($errorMessage);
}