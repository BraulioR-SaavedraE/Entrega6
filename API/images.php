<?php

for($i = 5; $i < 15; $i++) {
    $file = fopen("sql/images".($i+1).".txt", "a");
    for($j = 0; $j < 4000; $j++) {
        if ($i == 5 && $j < 2753) {
            continue;
        } 
        if ($i == 6 && $j < 1702) {
            continue;
        }
        $cliente = curl_init();
        curl_setopt($cliente, CURLOPT_URL, "https://dog.ceo/api/breeds/image/random/50");
        curl_setopt($cliente, CURLOPT_HEADER, 0);
        curl_setopt($cliente, CURLOPT_RETURNTRANSFER, true); 

        $contenido = curl_exec($cliente);
        $objeto = json_decode($contenido);
        curl_close($cliente);

        foreach($objeto->message as $img) {
            fwrite($file, str_replace("\\", "", $img)."\n");
        }
    }
    fclose($file);
}