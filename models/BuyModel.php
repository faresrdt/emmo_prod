<?php 

$emmo           = new database();
$biens          = $emmo->getAllBiens();
$AllHouse       = $emmo->getAllHouse();
$AllAppart      = $emmo->getAllAppart();
$getAllSell     = $emmo->getAllSell();
$citys          = [];

for ($i=0; $i<count($getAllSell); $i++){

    $ville = $getAllSell[$i]['ville'];
    array_push($citys, $ville);
    $citys = array_unique($citys);
}

