<?php
define("EXCEPTION_EMPTY_PARAMETERS", "Alguno de los campos enviados se encuentra vacio. Por favor, corrígelos e intentalo de nuevo");
define("OPENPAY_MERCANT_ID","mktztyyj4fsuqzbtfzkl");
define("OPENPAY_PRIVATE_KEY","sk_09f827943a8b4473a3af56e41ff90539");

function assert_empty_parameters($array){
    $count = 0;
    foreach($array as $item){
        if(!isset($item) || $item == "undefined"){
            throw new Exception(EXCEPTION_EMPTY_PARAMETERS."->".$count);
        }
        $count++;
    }
}
function assert_array_parameters($array, $parameters) {
    foreach($parameters as $parameter) {
        if (!array_key_exists($parameter, $array) || $array[$parameter] == 'undefined') {
            http_response_code(400);
            echo "Falta el parámetro: ".$parameter;
            exit();
        }
    }
}
function assert_json_parameters($json, $parameters) {
    foreach($parameters as $parameter) {
        if (!property_exists($json, $parameter)) {
            http_response_code(400);
            echo "Falta el parámetro: ".$parameter. " - ".$json->$parameter. " -- ".json_encode($json);
            exit();
        }
    }
}

function assert_user($data, $tipous) {
    if (!property_exists($data, "tipous") || $data->tipous != $tipous) {
        http_response_code(400);
        echo "Debes autenticarte como usuario de tipo" + ($tipous == 1 ? "Administrador" : "Cliente");
        exit();
    }
}