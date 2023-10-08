<?php
$titre = "S'inscrire";
$link = "styles.css";
require "./include/header.inc.php";
?>

<main>
    <section class="sectContact">
        <center>
        <h2>Enregistrer-vous</h2>
        <form class="contact_form" method="POST" action=#>
            <div class="box">
                <div class="input-box">
                    <?php
                        if(isset($_POST['personnel']) && (!isset($_POST['etudiant']))){
                            register_staff();
                        }
                        if(isset($_POST['etudiant']) && (!isset($_POST['personnel']))){
                            register_student();
                        }
                    ?>

                </div>

                <div class="mid">
                    <?php
                        if(empty($_POST['personnel']) && (!isset($_POST['personnel'])) && empty($_POST['etudiant'])  && (!isset($_POST['etudiant']))){
                            echo "<button type=submit name=\"personnel\" value=\"\">Inscription: Personnel</button>";
                            echo "<button type=submit name=\"etudiant\" value=\"\">Inscription: Etudiant</button>";
                        }
                        if(isset($_POST['personnel']) || isset($_POST['etudiant'])){
                            echo "<input type=\"button\" value=\"back\" onclick=\"history.go(-1)\">";
                            echo "<button>S'inscrire</button>";
                            
                        }
                    ?>
                    <br></br>
                    <a href="connect.php" style="color:cyan">Vous avez un compte? Connecté vous</a>
                </div>
                <br></br>
            </div>
        </form>
        </center>
    </section>
</main>

<?php

    if ((isset($_POST['client_id'])) //&& (!empty($_POST['client_id']))
    && (isset($_POST['nom'])) // && (!empty($_POST['nom'])) 
    && (isset($_POST['prenom'])) // && (!empty($_POST['prenom'])) 
    && (isset($_POST['phone'])) // && (!empty($_POST['phone'])) 
    && (isset($_POST['nationalite'])) // && (!empty($_POST['nationalite'])) 
    && (isset($_POST['email'])) // && (!empty($_POST['email'])) 
    && (isset($_POST['adresse'])) // && (!empty($_POST['adresse'])) 
    && (isset($_POST['birthday'])) // && (!empty($_POST['birthday'])) 
    && (isset($_POST['annee_scolaire'])) //&& (!empty($_POST['annee_scolaire'])) 
    && (isset($_POST['is_boursier']))  //&& (!empty($_POST['is_boursier'])) 
    && (isset($_POST['password'])) // && (!empty($_POST['password'])) )
    ){

       

       
        $age = age_today($_POST['birthday']);
        $photo= null;
        $solde = 0.00;
        $mdp_hashe = hash_pwd($_POST['password']);
        $ref_academie = '478425641295123';

        $client_id = $_POST['client_id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $phone = $_POST['phone'];
        $nationalite = $_POST['nationalite'];
        $email = $_POST['email'];
        $adresse = $_POST['adresse'];
        $birthday = $_POST['birthday'];
        $annee_scolaire = $_POST['annee_scolaire'];
        $is_boursier = $_POST['is_boursier'];


        send_client_sign_up($client_id,$nom,$prenom,$phone,
        $nationalite,$email,$age,$photo,$adresse,$birthday,
        $solde,$is_boursier,$mdp_hashe,$ref_academie);


        $no_etu = no_etu_random();
        $nbr_abscence_nj=0;
        $redoublement=null;
        
        send_student_sign_up($client_id,$no_etu,$nbr_abscence_nj,
        $redoublement,$annee_scolaire);

        echo "ENREGISTREMENT REUSSI !!!";

    }

    if ((isset($_POST['client_id']) 
    && (isset($_POST['nom']))  
    && (isset($_POST['prenom']))  
    && (isset($_POST['phone'])) 
    && (isset($_POST['nationalite']))  
    && (isset($_POST['email']))  
    && (isset($_POST['adresse']))  
    && (isset($_POST['birthday'])) 
    && (isset($_POST['lieu_travail']))
    && (isset($_POST['password'])))){


        $client_id = $_POST['client_id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $phone = $_POST['phone'];
        $nationalite = $_POST['nationalite'];
        $email = $_POST['email'];
        $adresse = $_POST['adresse'];
        $birthday = $_POST['birthday'];
        $lieu_travail = $_POST['lieu_travail'];
        $password = $_POST['password'];
        $code_tarif= 98;


        $age=age_today($_POST['birthday']);
        $photo= null;
        $solde = 0.00;
        $mdp_hashe = hash_pwd($_POST['password']);
        $ref_academie = '478425641295123';
        
        send_client_sign_up($client_id,$nom,$prenom,$phone,
        $nationalite,$email,$age,$photo,$adresse,$birth,
        $solde,$code_tarif,$mdp_hashe,$ref_academie);

        $no_personnel=no_personnel_random();

        send_staff_sign_up($client_id,$no_personnel,$lieu_travail);

        echo "ENREGISTREMENT REUSSI !!!";

    }


    
?>

<?php
        require "./include/footer.inc.php";
?>