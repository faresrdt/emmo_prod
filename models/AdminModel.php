<?php 

$emmo           = new database();
$biens          = $emmo->getAllBiens();
$AllHouse       = $emmo->getAllHouse();
$AllAppart      = $emmo->getAllAppart();
$getAllSell     = $emmo->getAllSell();
$getAllRent     = $emmo->getAllRent();

$allCitys  = [];

for ($i=0; $i<count($biens); $i++){

    $ville = $biens[$i]['ville'];
    array_push($allCitys, $ville);
    $allCitys = array_unique($allCitys);
}


$citysSell = [];

for ($i=0; $i<count($getAllSell); $i++){

    $ville = $getAllSell[$i]['ville'];
    array_push($citysSell, $ville);
    $citys = array_unique($citysSell);
}


$citysRent = [];

for ($i=0; $i<count($getAllRent); $i++){

    $ville = $getAllRent[$i]['ville'];
    array_push($citysRent, $ville);
    $citys = array_unique($citysRent);
}

if (!empty($_POST)){
    $insert          = $emmo->insertBien($_POST);

}

