<?php
     $titre = "Recharger";
     require "./include/header.inc.php"
?>


<main>
<center>
     <?php
        if(isset($_SESSION['mail']) && (!empty($_SESSION['mail']))){
                value_append_account_form();

                if (isset($_POST['montant']) && !empty($_POST['montant'])){
                        $id_from_client=get_id_client($_SESSION['mail']);
                        append_monney($_POST['montant'],get_id_client($_SESSION['mail']));
                
                }
        }
        else{
                echo "Veuillez vous connectez pour recharcher votre compte";
                echo "<a href=\"connect.php\">Connectez-vous !!! </a>";
        }
        
     ?>       
</center>
</main>

<?php
     require "./include/footer.inc.php"
?>