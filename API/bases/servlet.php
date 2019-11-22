<?php
//error_reporting(E_ERROR | E_PARSE);
mb_internal_encoding("utf-8");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once __DIR__."/exceptions.php";
require_once __DIR__."/../db/database.php";

abstract class Servlet {
    function doPost() {}
    function doGet() {}
    function doDelete() {}
    function invoke() {
        try{
            $res = new stdClass();
            switch($_SERVER["REQUEST_METHOD"]){
                case "GET":
                    $res = $this->doGet();
                    break;
                case "POST":
                    $res = $this->doPost();
                    break;
                case "DELETE":
                    $res = $this->doDelete();
                    break;
                default:
                    throw new ManualException("Método no soportado");
            }
            echo json_encode($res);
        }catch(ManualException $e) {
            http_response_code(400);
            $errorMessage = [
                "status" => "Failed",
                "message" => $e->getMessage()
            ];
            echo json_encode($errorMessage);
        }catch(AuthenticationException $e){
            http_response_code(401);
            $errorMessage = [
                "status" => "Unauthorized",
                "message" => $e->getMessage()
            ];
            echo json_encode($errorMessage);
        }catch(Exception $e){
            http_response_code(500);
            $errorMessage = [
                "status" => "Server error",
                "message" => $e->getMessage()
            ];
            echo json_encode($errorMessage);
        }
    }
    
    function getBody() {
        $body = file_get_contents('php://input');
        return json_decode($body);
    }
    
    function assert_array_parameters($array, $parameters) {
        foreach($parameters as $parameter) 
            if (!array_key_exists($parameter, $array) || $array[$parameter] == 'undefined') 
                throw new ManualException("Falta el parámetro: ".$parameter);
    }
    
    function assert_json_parameters($json, $parameters) {
        foreach($parameters as $parameter)
            if (!property_exists($json, $parameter))
                throw new ManualException("Falta el parámetro: ".$parameter);
    }

    function assert_user($key) {
        $bd = Database::getInstance();
        $rs = $bd->call_procedure("sp_auth", "'$key'")[0];
        if ($rs["id"] == 0) {
            throw new AuthenticationException('Llave incorrecta');
        }
    }
}

