<?php
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'library/database.php');
require_once(CHEMIN . 'models/SellModel.php');


$title = 'Vendre';
$template = 'SellView.phtml';


require_once(CHEMIN . 'www/layout/layout.phtml');