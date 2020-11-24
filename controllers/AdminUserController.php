<?php
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'library/database.php');
require_once(CHEMIN . 'models/AdminUserModel.php');
session_start();


// SUPPRIMER UN UTILISATEUR
if(isset($_GET['deleteUser'])){

    if($_GET['ref'] == "1")
    {
        $errorMessage = '<i class="fas fa-exclamation-triangle"></i>  Vous ne pouvez pas supprimé le dernier administateur !';

    }else{
        $id = $_GET['deleteUser'];
        $emmo->deleteUser($id);
        $users = $emmo->getAllUsers();
         
        $flashMessage = '<i class="far fa-check-circle"></i> Utilisateur supprimée avec succès. ';
    }
    

}

// AJOUTER UN UTILISATEUR
if(!empty($_POST)){

    $userInfo = [];
    $userInfo['pseudo']     = $_POST['pseudo'];
    $userInfo['mail']       = $_POST['mail'];
    $userInfo['password']   = $_POST['password'];
    $emmo->insertUser($userInfo);
    $users = $emmo->getAllUsers();

    $flashMessage = '<i class="far fa-check-circle"></i> Utilisateur ajouté avec succès. ';

}

$title = 'Administration';
if($_SESSION['role'] === 'admin'){
    $template = 'AdminUserView.phtml';
}
else{
    header('Location:/controllers/LoginController.php');
}

require_once(CHEMIN . 'www/layout/AdminLayout.phtml');
