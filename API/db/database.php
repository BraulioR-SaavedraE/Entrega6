<?php
define("DATABASE_CONECTION_ERROR", "Error al conectar con la base de datos");
define("EXCEPTION_SQLERROR", "Ocurrió un error con la base de datos, por favor, intentalo mas tarde");
define("EXCEPTION_NOSESSION", "NO_SESSION");

// )5Ahfyy4]45JQD
// 00052616

class Database{
    private static $instance = null;
    private $conn;
    private $url = "localhost";
    private $usr = "id11511314_dogspott";
    private $psw = "Entrar567*";
    private $bd = "id11511314_entrega6";
    private $prt = "3306";

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    private function __construct() {
        $this->conn = new mysqli($this->url, $this->usr, $this->psw, $this->bd, $this->prt);
        if($this->conn->connect_error){
            throw new Exception(DATABASE_CONECTION_ERROR."->".$this->conn->connect_error);
        }
        if(!$this->conn->set_charset("utf8")){
            throw new Exception(DATABASE_CONECTION_ERROR."->".$this->conn->connect_error);
        }
    }
    
    public static function parseEmptyParams($params) {
        return str_replace("''", "null", $params);
    }
    
    public static function parseUTCDate($utc) {
        if ($utc == '') {
            return $utc;
        }
        date_default_timezone_set("America/Mexico_City");
        $d = strtotime($utc);
        return date("Y-m-d H:i:s", $d);
    }
    
    public function call_procedure($procName, $params="", $assert = false){
        if(!$this->conn) {
            throw new Exception("The MySQLi connection is invalid.");
        }else{
            // Execute the SQL command.
            // The multy_query method is used here to get the buffered results,
            // so they can be freeded later to avoid the out of sync error.
            $params = self::parseEmptyParams($params);
            $sql = "CALL {$procName}({$params});";
            $sqlSuccess = $this->conn->multi_query($sql);
            if($sqlSuccess){
                if($this->conn->more_results()){
                    // Get the first buffered result set, the one with our data.
                    $result = $this->conn->use_result();
                    $output = array();
                    // Put the rows into the outpu array
                    while($row = $result->fetch_assoc()){
                        $output[] = $row;
                    }
                    // Free the first result set.
                    // If you forget this one, you will get the "out of sync" error.
                    $result->free();
                    // Go through each remaining buffered result and free them as well.
                    // This removes all extra result sets returned, clearing the way
                    // for the next SQL command.
                    while($this->conn->more_results() && $this->conn->next_result()){
                        $extraResult = $this->conn->use_result();
                        if($extraResult instanceof mysqli_result){
                            $extraResult->free();
                        }
                    }
                    if ($assert && $output[0]["msj"] != 'ok') {
                        http_response_code(400);
                        echo $output[0]["msj"];
                        exit();
                    }
                    return $output;
                }else{
                    return false;
                }
            }else{
                throw new Exception("Error de la base de datos: " . $this->conn->error);
            }
        }
    }
    
    function consulta($con){
        $result = $this->conn->query($con);
        if($this->conn->error){
            throw new Exception("error de la base de datos -> " . $this->conn->error);
        }
        return $result;
    }
}
