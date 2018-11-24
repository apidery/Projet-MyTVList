<?php
	require_once("include/vue_generique.php");
	require_once("include/controleur_generique.php");

	class VuePersonne extends VueGenerique{
	
		function __construct(){
			parent::__construct();

		}


		// Affiche la liste des personnes.
		function vue_liste_personne($tab) {
				echo "<ul>";
				echo "<h1> Liste des personne : </h1>"; 

				foreach($tab as $cle => $value){
					$getId=$value['idpersonne'];
					$repertoire="image/";
					$image=$value['image'];				
				
			?>
						<img src=" <?php echo $repertoire.$image; ?>" alt=""/>
			<?php


					echo "";
					echo " <h2> Description : </h2>";

					echo "<h3> Nom : </h3> ";
					echo $value['nom_personne'];

					echo "<h3> Prenom : </h3>";
					echo $value['prenom_personne'];

					echo "<h3> Nationalite : </h3>";
					echo $value['nationalite_personne'];

					echo "<h3> Date de naissance : </h3>";
					echo $value['datenaissance_personne'];

					echo "<h3> Biographie : </h3>";
					echo $value['biographie_personne'];
					echo "</br>";

				}

				echo "</br>";
				echo "<a href=index.php?module=accueil> Page principale ";
				echo "</a>";

				echo "</ul>";
				?><?php

			}

			//Affiche les informations d'une personne.
			function vue_personne($tab) {
				echo "<ul>";
				echo "<h1> Liste des personne : </h1>"; 

				foreach($tab as $cle => $value){
					$getId=$value['idpersonne'];
					$repertoire="image/";
					$image=$value['image'];				
				
			?>
						<img src=" <?php echo $repertoire.$image; ?>" alt=""/>
			<?php
					$bio = $value['biographie_personne'];
					echo "";
					echo " <h2> Description : </h2>";

					echo "<h3> Nom : </h3> ";
					echo $value['nom_personne'];

					echo "<h3> Prenom : </h3>";
					echo $value['prenom_personne'];

					echo "<h3> Nationalite : </h3>";
					echo $value['nationalite_personne'];

					echo "<h3> Date de naissance : </h3>";
					echo $value['datenaissance_personne'];

					echo "<h3> Biographie : </h3>";
					echo htmlspecialchars($bio, ENT_SUBSTITUTE, "UTF-8");
					echo "</br>";

					echo "<a href=index.php?module=oeuvre&action=liste_oeuvre_par_personne&idpersonne=$getId> Voir les films de l'acteur ";

				}

				echo "</br>";
				echo "<a href=index.php?module=accueil> Page principale ";
				echo "</a>";

				echo "</ul>";
				?><?php

			}

	}

?>