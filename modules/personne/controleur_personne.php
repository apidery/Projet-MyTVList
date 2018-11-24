<?php

	require_once ("modules/personne/modele_personne.php");
	require_once ("include/controleur_generique.php");
	require_once ("modules/personne/vue_personne.php");

	class ControleurPersonne extends ControleurGenerique{

		function __construct(){

			$this->modele = new ModelePersonne();
			$this->vue = new VuePersonne();

		}

		// Renvoi à la vue, la liste des acteurs par l'ID de l'oeuvre.
		function liste_personne(){
			$oeuvre=$_GET['idoeuvre'];
			$personne = $this->modele->get_liste_personne($oeuvre);
			
			if ( ! $personne ) {
					$this->vue->vue_erreur ("Impossible de récupérer la liste des personne");
			}
				$this->vue->vue_liste_personne($personne);
		}

		//Renvoi l'acteur par son personnage a la vue.
		function get_personne(){
			$idpersonne=$_GET['idpersonnage'];
	
			$personne = $this->modele->get_personne($idpersonne);

			if(!$personne){
				$this->vue->vue_erreur("Personne introuvable ou innexistante.");
			}
				$this->vue->vue_personne($personne);

		}

	}

?>
