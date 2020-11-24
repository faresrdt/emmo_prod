<?php
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'library/database.php');
require_once(CHEMIN . 'models/AdminModel.php');
session_start();

$title = 'Administration';
if($_SESSION['role'] === 'admin'){
    $template = 'AdminView.phtml';
}
else{
    header('Location:/controllers/LoginController.php');
}

if(isset($_GET['deleteId'])){

    $id = $_GET['deleteId'];
    $item = $emmo->getBienById($id);
    $emmo->deleteItem($id);

    $file1 = "../img/" . $item['photo1'];
    if( file_exists ($file1)){
        unlink($file1) ;
    }
    $file2 = "../img/" . $item['photo2'];
    if( file_exists ($file2)){
        unlink($file2) ;
    }
    $file3 = "../img/" . $item['photo3'];
    if( file_exists ($file3)){
        unlink($file3) ;
    }
     
    $flashMessage = 'Annonce supprimée avec succès. ' . '<a href="' . '/controllers/AdminController.php"' . '>' . 'Actualiser pour voir les résultats.'. '</a>';
}

require_once(CHEMIN . 'www/layout/AdminLayout.phtml');

