<?php

class Database 
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=db348787-emmo.sql-pro.online.net;dbname=db348787_emmo', 'db115703', '3waValidation!');
        $this->pdo->exec('SET NAMES UTF8');
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    public function insertBien ($tab)
    {

        $sql ='INSERT INTO `bien`
                (`transac`, `titre`, `type`, `ville`, `departement`, `region`, `surface_int`, `surface_ext`, `nbr_pieces`, `nbr_sdb`, `balcon`, `terrasse`, `garage`, `cave`, `chauffage`, `annee_const`, `description`, `photo1`, `photo2`, `photo3`, `prix`) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
                
        $query = $this->pdo->prepare($sql);
        if(!empty($tab)){

            $query->execute([$tab['transac'], 
            $tab['titre'], 
            $tab['type'],
            $tab['ville'],
            $tab['departement'],
            $tab['region'],
            $tab['surface_int'],
            $tab['surface_ext'],
            $tab['nbr_pieces'],
            $tab['nbr_sdb'],
            $tab['balcon'],
            $tab['terrasse'],
            $tab['garage'],
            $tab['cave'],
            $tab['chauffage'],
            $tab['annee_const'],
            $tab['description'],
            $tab['photo1'], 
            $tab['photo2'], 
            $tab['photo3'],
            $tab['prix'] ]);
        }
        

            
    }

    public function getBienById ($id)
    {
        $sql = 'SELECT * FROM `bien` WHERE id=?';
        $query = $this->pdo->prepare($sql);
        $query->execute([$id]);
        return $query->fetch();  
    }

    public function getAllBiens()
    {

        $sql   = 'SELECT `id`, `transac`, `titre`, `type`,`ville`,`departement`,`region`,`surface_int`,`surface_ext`,`nbr_pieces`,`nbr_sdb`,`balcon`,`terrasse`,`garage`,`chauffage`,`annee_const`,`description`,`date_crea`, `photo1`, `photo2`, `photo3`, `prix`
        FROM `bien`';
        $query = $this->pdo->prepare($sql);
        $query->execute();  
        $AllBiens = $query->fetchAll(); 
        return $AllBiens; 
    }

    public function getAllHouse()
    {
        $sql   = "SELECT `id`,`titre`, `type`,`ville`,`departement`,`region`,`surface_int`,`surface_ext`,`nbr_pieces`,`nbr_sdb`,`balcon`,`terrasse`,`garage`,`chauffage`,`annee_const`,`description`,`date_crea`, `photo1`, `photo2`, `photo3` 
                  FROM `bien` 
                  WHERE `type`= 'Maison'";
        $query = $this->pdo->prepare($sql);
        $query->execute();  
        $AllHouse = $query->fetchAll(); 
        return $AllHouse; 
    }

    public function getAllAppart()
    {
        $sql   = "SELECT `id`,`titre`, `type`,`ville`,`departement`,`region`,`surface_int`,`surface_ext`,`nbr_pieces`,`nbr_sdb`,`balcon`,`terrasse`,`garage`,`chauffage`,`annee_const`,`description`,`date_crea`, `photo1`, `photo2`, `photo3` 
                  FROM `bien` 
                  WHERE `type`= 'Appartement'";
        $query = $this->pdo->prepare($sql);
        $query->execute();  
        $AllAppart = $query->fetchAll(); 
        return $AllAppart; 
    }

    public function newsAppart()
    {
        $sql   = "SELECT *
                  FROM `bien` 
                  WHERE `type`= 'Appartement'
                  ORDER BY `bien`.`date_crea` DESC
                  LIMIT 4";
        $query = $this->pdo->prepare($sql);
        $query->execute();  
        $newsAppart = $query->fetchAll(); 
        return $newsAppart;
    }

    public function newsHouse()
    {
        $sql   = "SELECT *
                  FROM `bien` 
                  WHERE `type`= 'Maison'
                  ORDER BY `bien`.`date_crea` DESC
                  LIMIT 4";
        $query = $this->pdo->prepare($sql);
        $query->execute();  
        $newsHouse = $query->fetchAll(); 
        return $newsHouse;
    }

    public function newsAppartRent()
    {
        $sql   = "SELECT *
                    FROM `bien` 
                    WHERE `type`= 'Appartement' AND `transac`='Location'
                    ORDER BY `bien`.`date_crea` DESC
                    LIMIT 4";
        $query = $this->pdo->prepare($sql);
        $query->execute();  
        $newsAppartRent = $query->fetchAll(); 
        return $newsAppartRent;
    }

    public function newsHouseRent()
    {
        $sql   = "SELECT *
                    FROM `bien` 
                    WHERE `type`= 'Maison' AND `transac`='Location'
                    ORDER BY `bien`.`date_crea` DESC
                    LIMIT 4";
        $query = $this->pdo->prepare($sql);
        $query->execute();  
        $newsHouseRent = $query->fetchAll(); 
        return $newsHouseRent;
    }

    public function newInRent()
    {
        $sql   = "SELECT *
                    FROM `bien` 
                    WHERE `transac`='Location'
                    ORDER BY `bien`.`date_crea` DESC
                    LIMIT 4";
        $query = $this->pdo->prepare($sql);
        $query->execute();  
        $newInRent = $query->fetchAll(); 
        return $newInRent;
    }

    public function newInSell()
    {
        $sql   = "SELECT *
                    FROM `bien` 
                    WHERE `transac`='Achat'
                    ORDER BY `bien`.`date_crea` DESC
                    LIMIT 4";
        $query = $this->pdo->prepare($sql);
        $query->execute();  
        $newInSell = $query->fetchAll(); 
        return $newInSell;
    }

    public function getAllSell()
    {
        $sql   = "SELECT *
                    FROM `bien` 
                    WHERE `transac`='Achat'";

        $query = $this->pdo->prepare($sql);
        $query->execute();  
        $getAllSell = $query->fetchAll(); 
        return $getAllSell;
    }

    public function getAllRent()
    {
        $sql   = "SELECT *
                    FROM `bien` 
                    WHERE `transac`='Location'";

        $query = $this->pdo->prepare($sql);
        $query->execute();  
        $getAllRent = $query->fetchAll(); 
        return $getAllRent;
    }

    public function insertUser($userInfo)
    {
        $sql   = "INSERT INTO `users`(`pseudo`, `mail`, `password`) 
                    VALUES (?,?,?)";

        $query = $this->pdo->prepare($sql);
        $query->execute([$userInfo['pseudo'],
                         $userInfo['mail'],
                         $userInfo['password']]);  
        
    }

    public function getUserByPseudo($pseudo)
    {
        $sql   = "SELECT *
                    FROM `users` 
                    WHERE `pseudo`=?";

        $query = $this->pdo->prepare($sql);
        $query->execute([$pseudo]);  
        $user = $query->fetch(); 
        return $user;
    }

    public function getUserById($id)
    {
        $sql   = "SELECT *
                    FROM `users` 
                    WHERE `id`=?";

        $query = $this->pdo->prepare($sql);
        $query->execute([$id]);  
        $user = $query->fetch(); 
        return $user;
    }

    public function getAllUsers()
    {
        $sql   = "SELECT *
                    FROM `users`";

        $query = $this->pdo->prepare($sql);
        $query->execute();  
        $users = $query->fetchAll(); 
        return $users;
    }

    public function deleteUser($id){

        $sql   = "DELETE FROM `users` 
                  WHERE `id`=?";

        $query = $this->pdo->prepare($sql);
        $query->execute([$id]); 
    }

    public function deleteItem($id){

        $sql   = "DELETE FROM `bien` 
                  WHERE `id`=?";

        $query = $this->pdo->prepare($sql);
        $query->execute([$id]); 
    }

    public function UpdateBien ($tab)
    {


            if(isset($tab['photo1'])){
                $sql ='UPDATE   `bien`
                        SET     `photo1`=?
                        WHERE   id=?';
    
                    $query = $this->pdo->prepare($sql);
                    if(!empty($tab)){
                        $query->execute([$tab['photo1'],$tab['id']]);
                    }
            }

            if(isset($tab['photo2'])){
                $sql ='UPDATE   `bien`
                        SET     `photo2`=?
                        WHERE   id=?';
    
                    $query = $this->pdo->prepare($sql);
                    if(!empty($tab)){
                        $query->execute([$tab['photo2'],$tab['id']]);
                    }
            }

            if(isset($tab['photo3'])){
                $sql ='UPDATE   `bien`
                        SET     `photo3`=?
                        WHERE   id=?';
    
                    $query = $this->pdo->prepare($sql);
                    if(!empty($tab)){
                        $query->execute([$tab['photo3'],$tab['id']]);
                    }
            }


        $sql ='UPDATE   `bien`
                    SET     `transac`=?,
                            `titre`=?, 
                            `type`=?, 
                            `ville`=?, 
                            `departement`=?, 
                            `region`=?, 
                            `surface_int`=?, 
                            `surface_ext`=?, 
                            `nbr_pieces`=?, 
                            `nbr_sdb`=?, 
                            `balcon`=?, 
                            `terrasse`=?, 
                            `garage`=?, 
                            `cave`=?, 
                            `chauffage`=?, 
                            `annee_const`=?, 
                            `description`=?, 
                            `prix`=? 
                    WHERE   id=?
                ';
                $query = $this->pdo->prepare($sql);
                if(!empty($tab)){
        
                    $query->execute([$tab['transac'], 
                    $tab['titre'], 
                    $tab['type'],
                    $tab['ville'],
                    $tab['departement'],
                    $tab['region'],
                    $tab['surface_int'],
                    $tab['surface_ext'],
                    $tab['nbr_pieces'],
                    $tab['nbr_sdb'],
                    $tab['balcon'],
                    $tab['terrasse'],
                    $tab['garage'],
                    $tab['cave'],
                    $tab['chauffage'],
                    $tab['annee_const'],
                    $tab['description'],
                    $tab['prix'],
                    $tab['id'] ]);
                }
        
            
        

            
    }

}



$region = array();
$region["1"] = "Auvergne-Rhône-Alpes";
$region["2"] = "Bourgogne-France-Comté";
$region["3"] = "Bretagne";
$region["4"] = "Centre-Val de Loire";
$region["5"] = "Corse";
$region["6"] = "Grand Est";
$region["7"] = "Haut-de-France";
$region["8"] = "Île-de-France";
$region["9"] = "Normandie";
$region["10"] = "Nouvelle-Aquitaine";
$region["11"] = "Occitanie";
$region["12"] = "Pays-de-la-Loire";
$region["13"] = "Provence-Alpes-Côte-d'Azur";


$departements = array(); 

$departements['01'] = 'Ain'; 
$departements['02'] = 'Aisne'; 
$departements['03'] = 'Allier'; 
$departements['04'] = 'Alpes de Haute Provence'; 
$departements['05'] = 'Hautes Alpes'; 
$departements['06'] = 'Alpes Maritimes'; 
$departements['07'] = 'Ardèche'; 
$departements['08'] = 'Ardennes'; 
$departements['09'] = 'Ariège'; 
$departements['10'] = 'Aube'; 
$departements['11'] = 'Aude'; 
$departements['12'] = 'Aveyron'; 
$departements['13'] = 'Bouches du Rhône'; 
$departements['14'] = 'Calvados'; 
$departements['15'] = 'Cantal'; 
$departements['16'] = 'Charente'; 
$departements['17'] = 'Charente Maritime'; 
$departements['18'] = 'Cher'; 
$departements['19'] = 'Corrèze'; 
$departements['2A'] = 'Corse du Sud'; 
$departements['2B'] = 'Haute Corse'; 
$departements['21'] = 'Côte d\'Or'; 
$departements['22'] = 'Côtes d\'Armor'; 
$departements['23'] = 'Creuse'; 
$departements['24'] = 'Dordogne'; 
$departements['25'] = 'Doubs';
$departements['26'] = 'Drôme'; 
$departements['27'] = 'Eure'; 
$departements['28'] = 'Eure et Loir'; 
$departements['29'] = 'Finistère'; 
$departements['30'] = 'Gard'; 
$departements['31'] = 'Haute Garonne'; 
$departements['32'] = 'Gers'; 
$departements['33'] = 'Gironde'; 
$departements['34'] = 'Hérault'; 
$departements['35'] = 'Ille et Vilaine'; 
$departements['36'] = 'Indre'; 
$departements['37'] = 'Indre et Loire'; 
$departements['38'] = 'Isère'; 
$departements['39'] = 'Jura'; 
$departements['40'] = 'Landes'; 
$departements['41'] = 'Loir et Cher'; 
$departements['42'] = 'Loire'; 
$departements['43'] = 'Haute Loire'; 
$departements['44'] = 'Loire Atlantique'; 
$departements['45'] = 'Loiret'; 
$departements['46'] = 'Lot'; 
$departements['47'] = 'Lot et Garonne'; 
$departements['48'] = 'Lozère'; 
$departements['49'] = 'Maine et Loire'; 
$departements['50'] = 'Manche'; 
$departements['51'] = 'Marne'; 
$departements['52'] = 'Haute Marne'; 
$departements['53'] = 'Mayenne'; 
$departements['54'] = 'Meurthe et Moselle'; 
$departements['55'] = 'Meuse'; 
$departements['56'] = 'Morbihan'; 
$departements['57'] = 'Moselle'; 
$departements['58'] = 'Nièvre'; 
$departements['59'] = 'Nord'; 
$departements['60'] = 'Oise'; 
$departements['61'] = 'Orne'; 
$departements['62'] = 'Pas de Calais'; 
$departements['63'] = 'Puy de Dôme'; 
$departements['64'] = 'Pyrénées Atlantiques'; 
$departements['65'] = 'Hautes Pyrénées'; 
$departements['66'] = 'Pyrénées Orientales'; 
$departements['67'] = 'Bas Rhin'; 
$departements['68'] = 'Haut Rhin'; 
$departements['69'] = 'Rhône-Alpes'; 
$departements['70'] = 'Haute Saône'; 
$departements['71'] = 'Saône et Loire'; 
$departements['72'] = 'Sarthe'; 
$departements['73'] = 'Savoie'; 
$departements['74'] = 'Haute Savoie'; 
$departements['75'] = 'Paris'; 
$departements['76'] = 'Seine Maritime'; 
$departements['77'] = 'Seine et Marne'; 
$departements['78'] = 'Yvelines'; 
$departements['79'] = 'Deux Sèvres'; 
$departements['80'] = 'Somme'; 
$departements['81'] = 'Tarn'; 
$departements['82'] = 'Tarn et Garonne'; 
$departements['83'] = 'Var'; 
$departements['84'] = 'Vaucluse'; 
$departements['85'] = 'Vendée'; 
$departements['86'] = 'Vienne'; 
$departements['87'] = 'Haute Vienne'; 
$departements['88'] = 'Vosges'; 
$departements['89'] = 'Yonne'; 
$departements['90'] = 'Territoire de Belfort'; 
$departements['91'] = 'Essonne'; 
$departements['92'] = 'Hauts de Seine'; 
$departements['93'] = 'Seine St Denis'; 
$departements['94'] = 'Val de Marne'; 
$departements['95'] = 'Val d\'Oise'; 
$departements['97'] = 'DOM'; 
$departements['971'] = 'Guadeloupe'; 
$departements['972'] = 'Martinique'; 
$departements['973'] = 'Guyane'; 
$departements['974'] = 'Réunion'; 
$departements['975'] = 'Saint Pierre et Miquelon'; 
$departements['976'] = 'Mayotte';




define("CHEMIN", dirname(__DIR__) . DIRECTORY_SEPARATOR);
define("CHEMIN2", '/3wa/Projet/emmobilier' . DIRECTORY_SEPARATOR);

// var_dump(CHEMIN);
// var_dump(CHEMIN2);


