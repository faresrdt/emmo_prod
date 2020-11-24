<?php
require_once('library/database.php');
require_once('models/HomeModel.php');
session_start();
unset($_SESSION['role']); 
unset($_SESSION['pseudo']); 
unset($_SESSION['statut']); 
unset($_COOKIE['PHPSESSID']); 

if(isset($_COOKIE['mail']) && $_COOKIE['mail'] === 'send'){

    $mail = true;
    unset($_COOKIE['mail']); 

}else{
    $mail=false;
}
    

$title = 'Accueil';
$template = 'HomeView.phtml';

require_once('www/layout/layout.phtml');
