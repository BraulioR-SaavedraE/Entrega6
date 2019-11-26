<?php

$contmaster = 1;
for($i = 0; $i < 15; $i++) {
    $images = fopen("sql/images".($i+1).".txt", "r");
    $names = fopen("sql/names".($i+1).".txt", "r");
    $dest1 = fopen("sql/dogos".($i*2+1).".sql", "a");
    $dest2 = fopen("sql/dogos".($i*2+2).".sql", "a");
    $cont = 0;
    while(!feof($images)){
        $image = trim(fgets($images));
        $name = trim(fgets($names));
        if ($image == '' || $name == '')
            break;
        fwrite($cont++ < 100000 ? $dest1 : $dest2, 
            "insert into dog value('".($contmaster++)."','".$name."','".$image."',0);\n");
    }
    fclose($images);
    fclose($names);
    fclose($dest1);
    fclose($dest2);
}