<?php
$titre ="profil";

require "./include/header.inc.php";
?>

	<main>
		<center>
			<?php
				if(isset($_SESSION['mail']) && (!empty($_SESSION['mail']))){
					show_profile(get_id_client($_SESSION['mail']));
				}
				else{
					echo "Veuillez vous connectez pour recharcher votre compte";
					echo "<a href=\"connect.php\">Connectez-vous !!! </a>";
				}
			?>
		</center>
	</main>


<?php
require "./include/footer.inc.php";
?>				
