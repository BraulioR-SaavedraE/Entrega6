<?php
function assert_json_parameters($json, $parameters) {
    foreach($parameters as $parameter) {
        if (!property_exists($json, $parameter)) {
            http_response_code(400);
            echo "Falta el parámetro: ".$parameter. " - ".$json->$parameter. " -- ".json_encode($json);
            exit();
        }
    }
}