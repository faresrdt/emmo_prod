<?php 
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'library/database.php');

class carrousel extends database{

    function getPics($id){
        $sql = "SELECT `photo1`, `photo2`, `photo3` 
        FROM bien
        WHERE `id` = ?";

        $query = $this->pdo->prepare($sql);
        $query->execute([$id]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }

}


$id = $_GET['id'];
$req= new carrousel();
$req->getPics($id);
