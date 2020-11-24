<?php 
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'library/database.php');

class requete extends database{

    function getAllSell(){
        $sql = "SELECT * 
        FROM bien
        WHERE `transac` = 'Location'";

        $query = $this->pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }

    function getBiensFiltered($filters) {
        
        $sql        = ["SELECT * FROM bien WHERE `transac`=" . "'Location'"];
        $filtersExe = [];
        
        // /////////////////////////////////////////////////// IF TYPE
        if(isset($filters['type'])){

            if(count($filters['type']) === 1){
                
                $filterType = $filters['type'];
                $filterType = implode("", $filterType);
                
                switch($filterType){

                    case 'appartement' :
                        array_push($sql, "AND `type` =" . "'appartement'");
                    break;

                    case 'maison' :
                        array_push($sql, "AND `type` =" . "'maison'");
                    break;
                }
                
            
            }else if(count($filters['type']) > 1)
            {
            
                array_push($sql, "AND (`type` =" . "'maison' " . "OR `type` =" . "'appartement')");
                
            }

        }
        

        ///////////////////////////////////////////////////// IF PRICE

        if(isset($filters['price_min'], $filters['price_max'])){
            $price_Min = implode("", $filters['price_min']);
            $price_Max = implode("", $filters['price_max']);
        
            array_push($sql, "AND `prix` BETWEEN " . "'" . $price_Min . "'" ." AND " . "'" .$price_Max . "'");

        }

        ///////////////////////////////////////////////////// IF CITY

        if(isset($filters['city'])){

            $filterCity = $filters['city'];

            if(count($filterCity) === 1){

                $filterCity = implode(" ", $filterCity);    
                array_push($sql, "AND `ville` =" . "'" . $filterCity ."'");

            }else if(count($filterCity) > 1){

                array_push($sql, "AND (`ville` =" . "'" .$filterCity[0] . "'");

                for ($i = 1 ; $i < count($filterCity); $i++){
                    array_push($sql, " OR `ville` =" . "'" .$filterCity[$i] . "'");
                }
                
                array_push($sql, ")");
            }

            

        }

        $sqlImplode         = implode(" ", $sql);
        
        $query = $this->pdo->prepare($sqlImplode);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($result);
    }

};


$filters = $_GET['filters'];
$req= new requete();
$req->getBiensFiltered($filters);
