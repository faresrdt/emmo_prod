<?php
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'library/database.php');
require_once(CHEMIN . 'models/ItemModel.php');
session_start();

$id     = $_GET['id'];    
$item   = $emmo->getBienById($id);

$title = $item['titre'];

if(empty($_GET['id']) || !is_numeric($_GET['id'])){

    header('Location:/controllers/AdminController.php');

}else{


    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){

        $tab = [];

        if(!empty($_FILES) && $_FILES['photo1']['size'] > 0){
        
                $nomOriginePhoto1 = $_FILES['photo1']['name'];
                $CheminPhoto1 = pathinfo($nomOriginePhoto1);
                $extensionPhoto1 = $CheminPhoto1['extension'];
                
        
                $extensionsAutorisees = array("jpeg", "jpg", "png");
        
            if (!(in_array($extensionPhoto1, $extensionsAutorisees))) {
                echo 'Ce n\'est pas un fichier image ("jpeg", "jpg", "png")';
            } else {    
                // Copie dans le repertoire du script avec un nom
                // incluant l'heure a la seconde pres 
                $repertoireDestination = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'img/';
                $nomDestination1 = $_POST['titre'] . date("YmdHis") . "(1)" . "." .$extensionPhoto1;
        
                if (move_uploaded_file($_FILES["photo1"]["tmp_name"], 
                                                $repertoireDestination.$nomDestination1)) {
                    echo "Le fichier temporaire ".$_FILES["photo1"]["tmp_name"].
                            " a été déplacé vers ".$repertoireDestination.$nomDestination1;
                } else {
                    echo "Le fichier n'a pas été uploadé (trop gros ?) ou ".
                            "Le déplacement du fichier temporaire a échoué".
                            " vérifiez l'existence du répertoire ".$repertoireDestination;
                }
            }
        
        }

        if(!empty($_FILES) && $_FILES['photo2']['size'] > 0){
        
            $nomOriginePhoto2 = $_FILES['photo2']['name'];
            $CheminPhoto2 = pathinfo($nomOriginePhoto2);
            $extensionPhoto2 = $CheminPhoto2['extension'];
            

            $extensionsAutorisees = array("jpeg", "jpg", "png");

            if (!(in_array($extensionPhoto2, $extensionsAutorisees))) {
                echo 'Ce n\'est pas un fichier image ("jpeg", "jpg", "png")';
            } else {    
                // Copie dans le repertoire du script avec un nom
                // incluant l'heure a la seconde pres 
                $repertoireDestination = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'img/';
                $nomDestination2 = $_POST['titre'] . "(2)" . "." .$extensionPhoto2;
        
                if (move_uploaded_file($_FILES["photo2"]["tmp_name"], 
                                                $repertoireDestination.$nomDestination2)) {
                    echo "Le fichier temporaire ".$_FILES["photo2"]["tmp_name"].
                            " a été déplacé vers ".$repertoireDestination.$nomDestination2;
                } else {
                    echo "Le fichier n'a pas été uploadé (trop gros ?) ou ".
                            "Le déplacement du fichier temporaire a échoué".
                            " vérifiez l'existence du répertoire ".$repertoireDestination;
                }
            }

        }

        if(!empty($_FILES) && $_FILES['photo3']['size'] > 0){
        
            $nomOriginePhoto3 = $_FILES['photo3']['name'];
            $CheminPhoto3 = pathinfo($nomOriginePhoto3);
            $extensionPhoto3 = $CheminPhoto3['extension'];
            

            $extensionsAutorisees = array("jpeg", "jpg", "png");

            if (!(in_array($extensionPhoto3, $extensionsAutorisees))) {
                echo 'Ce n\'est pas un fichier image ("jpeg", "jpg", "png")';
            } else {    
                // Copie dans le repertoire du script avec un nom
                // incluant l'heure a la seconde pres 
                $repertoireDestination = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'img/';
                $nomDestination3 = $_POST['titre'] . "(3)" . "." .$extensionPhoto3;
        
                if (move_uploaded_file($_FILES["photo3"]["tmp_name"], 
                                                $repertoireDestination.$nomDestination3)) {
                    echo "Le fichier temporaire ".$_FILES["photo3"]["tmp_name"].
                            " a été déplacé vers ".$repertoireDestination.$nomDestination3;
                } else {
                    echo "Le fichier n'a pas été uploadé (trop gros ?) ou ".
                            "Le déplacement du fichier temporaire a échoué".
                            " vérifiez l'existence du répertoire ".$repertoireDestination;
                }
            }

        }
        
        if(!empty($_POST)){
            
        
            $tab['transac']     = $_POST['transac'];
            $tab['titre']       = $_POST['titre'];
            $tab['type']        = $_POST['type'];
            $tab['ville']       = ucwords($_POST['ville']);
            $tab['departement'] = $_POST['departement'];
            $tab['region']      = $_POST['region'];
            $tab['surface_int'] = $_POST['surface_int'];
            $tab['surface_ext'] = $_POST['surface_ext'];
            $tab['nbr_pieces']  = $_POST['nbr_pieces'];
            $tab['nbr_sdb']     = $_POST['nbr_sdb'];
            $tab['balcon']      = $_POST['balcon'];
            $tab['terrasse']    = $_POST['terrasse'];
            $tab['garage']      = $_POST['garage'];
            $tab['cave']        = $_POST['cave'];
            $tab['chauffage']   = $_POST['chauffage'];
            $tab['annee_const'] = $_POST['annee_const'];
            $tab['description'] = $_POST['description'];
            if(!empty($_FILES) && $_FILES['photo1']['size'] > 0){

                $tab['photo1']      = $nomDestination1;
            }
            if(!empty($_FILES) && $_FILES['photo2']['size'] > 0){

                $tab['photo2']      = $nomDestination2;
                
            }
            if(!empty($_FILES) && $_FILES['photo3']['size'] > 0){

                $tab['photo3']      = $nomDestination3;   
            }
            $tab['prix']        = $_POST['prix'];
            $tab['id']          = $_POST['id'];
            $emmo->UpdateBien($tab);
            header('Location:/controllers/ItemController.php?id='. $tab['id']);
        }
        
        
        


        $template = 'UpdateView.phtml';
        require_once(CHEMIN . 'www/layout/AdminLayout.phtml');
    }else{

        header('Location:/controllers/LoginController.php');

    }

}
