<?php


function sendMail(){


    $to      = 'fares.alib@gmail.com';
    if(isset($_POST['titre'])){
        $subject = 'Contact au sujet de ' . $_POST['titre'] . ' référence :' . $_POST['ref'];
    }elseif(isset($_POST['sell'])){

        $subject = "Demande d'estimation";

    }
    else{
        $subject = 'Nouveau contact';
    }

    

    if(isset($_POST['sell'])){
        $message = '<html>
                        
                        <body>
                            <h1 style="text-align: center;">Nouvelle demande d\'estimation'.'</h1>
                            <p><pre>
                            <strong>Nom :</strong> '. $_POST['nom'] . '
                            <strong>Prénom :</strong> '. $_POST['prenom'] . '
                            <strong>Téléphone :</strong> '. $_POST['phone'] . '
                            <strong>E-mail :</strong> '. $_POST['mail'] . 
                            '</pre><h3 style="text-align: center;"> Le bien </h3><pre>'. '
                            <strong>Type :</strong> '. $_POST['type'] . '
                            <strong>Ville :</strong> '. $_POST['ville'] . '
                            <strong>Département :</strong> '. $_POST['departement'] . '
                            <strong>Région :</strong> '. $_POST['region'] . 
                            '</pre><h4 style="text-align: center;">Informations supplémentaires </h4><pre>'. '
                            <strong>Surface intérieure :</strong> '. $_POST['surface_int'] . 'm²'. '
                            <strong>Surface extérieure :</strong> '. $_POST['surface_ext'] . 'm²' . '
                            <strong>Nombre de pièces  :</strong> '. $_POST['nbr_pieces'] . '
                            <strong>Nombre de salle de bains  :</strong> '. $_POST['nbr_sbd'] . ' 
                            <strong>Balcon :</strong> '. $_POST['balcon'] . '
                            <strong>Terrasse :</strong> '. $_POST['terrasse'] . '
                            <strong>Garage :</strong> '. $_POST['garage'] . '
                            <strong>Cave :</strong> '. $_POST['cave'] . '
                            <strong>Chauffage :</strong> '. $_POST['chauffage'] . '
                            <strong>Année de construction :</strong> '. $_POST['annee_const'] . '
                            <strong>Description du bien :</strong> '. $_POST['description'] . 
                            '</pre></p>
                        </body>
                    </html>
        ';

    }else{
        $message = "<html>
                        
                        <body>
                            <h1 style=\"text-align: center;\">Nouvelle demande de contact</h1>
                            <p><pre>
                            <strong>Nom :</strong> "            . $_POST['nom']     . "
                            <strong>Prénom :</strong> "         . $_POST['prenom']  . "
                            <strong>Téléphone :</strong> "      . $_POST['phone']   . "
                            <strong>E-mail :</strong> "         . $_POST['mail']    . "
                            <strong>Message :</strong> "        . $_POST['message'] . "
                            
                            </pre></p>
                        </body>
                    </html>
        ";

    }
    

    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
    $headers[] = 'From: admin@e-mmobilier.net';


    setcookie("mail", "send", time()+5, "/" ,"e-mmobilier.net");
    mail($to, $subject, $message, implode("\r\n", $headers));
    header('Location: /index.php');

}
sendMail();



