<?php

$emmo           = new database();
$biens          = $emmo->getAllBiens();
$AllHouse       = $emmo->getAllHouse();
$AllAppart      = $emmo->getAllAppart();
$newsAppartRent = $emmo->newsAppartRent();
$newsHouseRent  = $emmo->newsHouseRent();
$newsAppart     = $emmo->newsAppart();
$newsHouse      = $emmo->newsHouse();
$newInRent      = $emmo->newInRent();
$newInSell      = $emmo->newInSell();