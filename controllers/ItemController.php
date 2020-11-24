<?php
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'library/database.php');
require_once(CHEMIN . 'models/ItemModel.php');
session_start();

$id     = $_GET['id'];    
$item   = $emmo->getBienById($id);

$title = $item['titre'];

foreach($departements as $key => $value){

    if($key == $item['departement']){
        $item['departement'] = $value;
    }
}

foreach($region as $key => $value){

    if($key == $item['region']){
        $item['region'] = $value;
    }
}



if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
    $template = 'ItemView.phtml';
    require_once(CHEMIN . 'www/layout/AdminLayout.phtml');
}else{

    $template = 'ItemView.phtml';
    require_once(CHEMIN . 'www/layout/layout.phtml');

}


