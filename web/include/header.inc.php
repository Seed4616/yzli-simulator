<?php
session_start();

include "./include/functions.inc.php";
?>



<!DOCTYPE html>
<html lang="fr">
	<head>
		<title><?php echo $titre; ?></title>
		<meta charset="utf-8" />
		
		<!-- <link rel="icon" href="./images/logo.ico" />  -->
		<!--style de la page-->
		<link rel="stylesheet" href="styles.css" />
		<link rel="icon" type="image/x-icon" href="../images/favicon-32x32.png">
		<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
	</head>


	<body>
        <header id="HautPage">
			
			<h1>Izly</h1>
			<?php
                    if(isset($_SESSION['mail']) && !empty($_SESSION['mail'])){
						?>
			            <div style="background-color:white">Compte connecté : <?php echo get_id_client($_SESSION['mail']); ?> </div>
						<?php
				    }
			    ?>
			<?php
		
				echo "
				<nav>
        			<ul class=\"bigMc\">
    	      			<li> <a href=\"index.php\">Accueil</a> </li>
    	    			<li> <a href=\"recharger.php\">Recharger</a> </li>
            			<li> <a href=\"profil.php\">Profil</a> </li>
						<li> <a href=\"historique.php\">Historique</a> </li>
						<li> <a href=\"register.php\">Inscription</a> </li>
						";
						if(isset($_SESSION['mail'])&&(!empty($_SESSION['mail']))){
							echo "<li><a href=\"logout.php\">Se Deconnecter</a>";
						}
						else{
							echo "<li><a href=\"connect.php\">Se Sonnecter</a>";
						}
				echo"
              		</ul> 
        		</nav>";
		
			?>

		</header>
		