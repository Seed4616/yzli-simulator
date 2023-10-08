<?php
$titre = "Se Connecter";
$link = "styles.css";
require "./include/header.inc.php";
?>

<main>
    <section class="sectContact">

        <h2>Connectez-vous</h2>
        <form class="contact_form" method="POST">
            <div class="box">
                <div class="input-box">
                    <div class="content">
                        <span></span>
                        <input type="text" name="mail" placeholder="Tapez votre mail">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <br></br>
                    <div class="content">
                        <span></span>
                        <input type="password" name="pass" placeholder="Tapez votre mot de passe">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>
                <div class="mid">
                    
                    <button type="submit" name="connexion" value="Connexion">Se connecter</button>
                    <br></br>
                    <a href="register.php" style="color:cyan">Pas de compte? Inscrivez-vous</a>
                </div>
                <br></br>
            </div>
        </form>

    </section>
</main>


<?php
    if(isset($_POST['connexion'])){
        require_once "./include/connexion_bd.php";
        
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];
        
        global $db;
        
        $query = $db->prepare("SELECT * FROM client WHERE email = ?");
        $query->execute([$_POST['mail']]);
        $user = $query->fetch();
     
        if ($user && password_verify($_POST['pass'], $user['mdp_hashe'])){
            echo "Identifiant valid!";
            echo '<body onLoad="alert(\'Connexion reussi !!!)">';

            $_SESSION['mail'] = $_POST['mail'];
		    $_SESSION['pass'] = $_POST['pass'];
            
            header('Location: index.php');
        } 
        else {
            echo '<body onLoad="alert(\'Un probléme est survenu a propos de la connexion !!!)">';
        }
    }


?>

<?php
        require "./include/footer.inc.php";
?>