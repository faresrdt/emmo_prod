<?php 
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'library/database.php');

class requete extends database{

    function getAllSell(){
        $sql = "SELECT * 
        FROM bien
        WHERE `transac` = 'Achat'";

        $query = $this->pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }

    function getBiensFiltered($filters) {
        
        $sql        = ["SELECT * FROM bien "];
        $filtersExe = [];
        


        // /////////////////////////////////////////////////// IF TRANSAC
        if(isset($filters['transac'])){
            
            if(count($filters['transac']) === 1){
                
                $filterTransac = $filters['transac'];
                $filterTransac = implode("", $filterTransac);
                
                switch($filterTransac){

                    case 'achat' :
                        array_push($sql, "WHERE `transac` =" . "'Achat'");
                    break;

                    case 'location' :
                        array_push($sql, "WHERE `transac` =" . "'Location'");
                    break;
                }
                
            
            }else if(count($filters['transac']) > 1)
            {
            
                array_push($sql, "WHERE (`transac` =" . "'Achat' " . "OR `transac` =" . "'Location')");
                
            }

        }else{
                $sql        = ["SELECT * FROM bien WHERE (`transac` ='Achat' OR `transac` ='Location')"];
        }

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

        ///////////////////////////////////////////////////// IF DEPARTEMENT

        if(isset($filters['depart'])){

            $filterDepart = $filters['depart'];

            if(count($filterDepart) === 1){

                $filterDepart = implode(" ", $filterDepart);    
                array_push($sql, "AND `departement` =" . "'" . $filterDepart ."'");

            }else if(count($filterDepart) > 1){

                array_push($sql, "AND (`departement` =" . "'" .$filterDepart[0] . "'");

                for ($i = 1 ; $i < count($filterDepart); $i++){
                    array_push($sql, " OR `departement` =" . "'" .$filterDepart[$i] . "'");
                }
                
                array_push($sql, ")");
            }

            

        }


        ///////////////////////////////////////////////////// IF REGION

        if(isset($filters['region'])){

            $filterRegion = $filters['region'];

            if(count($filterRegion) === 1){

                $filterRegion = implode(" ", $filterRegion);    
                array_push($sql, "AND `region` =" . "'" . $filterRegion ."'");

            }else if(count($filterRegion) > 1){

                array_push($sql, "AND (`region` =" . "'" .$filterRegion[0] . "'");

                for ($i = 1 ; $i < count($filterRegion); $i++){
                    array_push($sql, " OR `region` =" . "'" .$filterRegion[$i] . "'");
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


$filters = $_GET['adminFilters'];
$req= new requete();
$req->getBiensFiltered($filters);
// echo json_encode($filters['transac']);
