<?php 

$emmo           = new database();

$getAllRent     = $emmo->getAllRent();
$citys          = [];

for ($i=0; $i<count($getAllRent); $i++){

    $ville = $getAllRent[$i]['ville'];
    array_push($citys, $ville);
    $citys = array_unique($citys);
}

