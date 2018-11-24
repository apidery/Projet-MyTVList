<?php

	require_once ("modules/personnage/modele_personnage.php");
	require_once ("include/controleur_generique.php");
	require_once ("modules/personnage/vue_personnage.php");

	class ControleurPersonnage extends ControleurGenerique{

		function __construct(){

			$this->modele = new ModelePersonnage();
			$this->vue = new VuePersonnage();

		}

		// Renvoi a la vue la liste des personnages par l'ID d'un oeuvre.
		function liste_personnage(){
			$oeuvre=$_GET['idoeuvre'];
			$personnage = $this->modele->get_liste_personnage($oeuvre);
			
			if ( ! $personnage ) {
					$this->vue->vue_erreur ("Impossible de récupérer la liste des personnages");
			}
				$this->vue->vue_liste_personnage ($personnage);
		}

	}

?>
