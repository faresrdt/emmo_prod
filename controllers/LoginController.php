<?php
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'library/database.php');
require_once(CHEMIN . 'models/LoginModel.php');
session_start();


if($_POST){

    $pseudo = $_POST['pseudo'];
    $passwordIn = $_POST['password'];
    

    $user = $emmo->getUserByPseudo($pseudo);

    $passwordBD = $user['password'];

    $pass = password_verify($passwordIn, $passwordBD);
    

    if($pass == true){

        $_SESSION['role'] = 'admin';
        $_SESSION['statut'] = 'connected';
        $_SESSION['pseudo'] = $pseudo;
        header('Location:/controllers/AdminController.php');

    }else{
        $errorMessage = "Le mot de passe est incorrect";

        var_dump($pass);
        var_dump($passwordBD);
        
        $template = 'LoginView.phtml';
        require_once(CHEMIN . 'www/layout/AdminLayout.phtml');
        return $errorMessage;

    }
}

if(empty($_POST)){
    $template = 'LoginView.phtml';
    $title = 'Connexion Administrateur';
    require_once(CHEMIN . 'www/layout/AdminLayout.phtml');

};

