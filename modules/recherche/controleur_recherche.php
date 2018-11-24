<?php

	require_once ("modules/recherche/modele_recherche.php");
	require_once ("modules/oeuvre/modele_oeuvre.php");
	require_once ("include/controleur_generique.php");
	require_once ("modules/recherche/vue_recherche.php");

	class ControleurRecherche extends ControleurGenerique{

		function __construct(){

			$this->modele = new ModeleRecherche();
			$this->modeleOeuvre = new modeleOeuvre();
			$this->vue = new VueRecherche();

		}

		// Renvoi les résultat de la recherche a la vue.
		function liste_recherche(){
			$term = $_POST['recherche'];
			if(!$recherche = $this->modele->modele_recherche_chaine($term)){
				$this->vue->vue_erreur ("Aucun(s) élément(s) trouvé");
			}
			if(!$images  = $this->modeleOeuvre->get_image_oeuvre()){
				$this->vue->vue_erreur ("Aucune images trouvé");
			}
				$this->vue->vue_liste_des_recherche($recherche,$images,$term);
		}

			
		function liste_recherche_ajax(){
			$chaine = $_POST['search'];
			if(!$recherche = $this->modele->modele_recherche_chaine($chaine)){
				$this->vue->vue_erreur ("Aucun(s) élément(s) trouvé ( recherche ajax)");
			}
			if(!$images  = $this->modeleOeuvre->get_image_oeuvre()){
				$this->vue->vue_erreur ("Aucune images trouvé");
			}
				$this->vue->tableau_recherche($recherche,$images);
		}
		
	}
?>