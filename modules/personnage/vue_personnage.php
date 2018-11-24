<?php
	require_once("include/vue_generique.php");
	require_once("include/controleur_generique.php");

	class VuePersonnage extends VueGenerique{
	
		function __construct(){
			parent::__construct();

		}

		// Affiche les personnages
		function vue_liste_personnage($tab) {
				echo "<ul>";
				echo "<h1> Liste des personnages : </h1>"; 

				foreach($tab as $cle => $value){
					$getId=$value['idpersonnage'];
					$repertoire="image/";
					$image=$value['image'];				
				
			?>
						<img src=" <?php echo $repertoire.$image; ?>" alt=""/>
			<?php

					echo "</br>";
					echo $value['nom_personnage']."</br>";
	
					echo $value['prenom_personnage']."</br>";

					echo "<a href=index.php?module=personne&idpersonnage=$getId&action=get_personne> Voix </a> </br>";
					echo "</br>";

				}

				echo "</br>";
				echo "<a href=index.php?module=accueil> Page principale ";
				echo "</a>";

				echo "</ul>";
				?><?php

			}
	}

?>