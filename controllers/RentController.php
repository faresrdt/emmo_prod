<?php
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'library/database.php');
require_once(CHEMIN . 'models/RentModel.php');


$title = 'Louer';
$template = 'RentView.phtml';


require_once(CHEMIN . 'www/layout/layout.phtml');