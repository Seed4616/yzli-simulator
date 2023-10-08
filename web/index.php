<?php
declare(strict_types=1);
$titre= "Yzli";
require "./include/header.inc.php";
?>

        <main>
            <section>
                
                <h2>Yzli</h2>
                <h2>Bienvenu sur Yzli</h2>
                <?php
                    if(isset($_SESSION['mail']) && !empty($_SESSION['mail'])){
                        echo "<center>Vous avez sur votre compte : </center>";
			            show_solde(get_id_client($_SESSION['mail'])); 
				    }
                    else{
                        echo "<h1>Veuillez vous connecter pour consulté votre solde !!!</h1>";
                        echo "<a href=\"connect.php\">Connectez-vous !!! </a>";
                    }
			    ?>
            </section>
        </main>



        <?php
            if(isset($_POST['connexion'])){
                require_once "./include/connexion_bd.php";
        
                $email = $_POST['email'];
                $pass = $_POST['pass'];
        
                global $db;
        
                $query = $db->prepare("SELECT * FROM compte WHERE email = ?");
                $query->execute([$_POST['email']]);
                $user = $query->fetch();
                
                if ($user && password_verify($_POST['pass'], $user['pwd_hash'])){
                    echo "Identifiant valid!";
                    echo '<body onLoad="alert(\'Connexion reussi !!!)">';
                    session_start();
                    $_SESSION['email'] = $_POST['email'];
		            $_SESSION['pass'] = $_POST['pass'];
            
                    header('Location: index.php');
                } 
                else {
                    echo '<body onLoad="alert(\'Un problÃ©me est survenu a propos de la connexion !!!)">';
                }
            }
        ?>

<?php
require "./include/footer.inc.php";
?>