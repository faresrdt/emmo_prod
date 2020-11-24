<?php
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'library/database.php');
require_once(CHEMIN . 'models/ContactModel.php');


if (array_key_exists('id', $_GET)){
    $id     = $_GET['id']; 
    $item   = $emmo->getBienById($id);
}

$title = 'Contact';
$template = 'ContactView.phtml';


require_once(CHEMIN . 'www/layout/layout.phtml');