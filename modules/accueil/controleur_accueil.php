<?php

	require_once ("modules/accueil/modele_accueil.php");
	require_once ("include/controleur_generique.php");
	require_once ("modules/accueil/vue_accueil.php");
	require_once ("modules/oeuvre/modele_oeuvre.php");
	require_once ("modules/news/modele_news.php");

	class ControleurAccueil extends ControleurGenerique{

		function __construct(){

			$this->modele = new ModeleAccueil();
			$this->modeleOeuvre = new ModeleOeuvre();
			$this->modeleNews = new ModeleNews();
			$this->vue = new VueAccueil();

		}

		// Affiche l'accueil et son contenu.
		function afficheaccueil(){
			try{

				if(!$oeuvres = $this->modeleOeuvre->get_liste3film()){
					$this->vue->vue_erreur ("Impossible de récupérer la liste des oeuvre");
				}
				if(!$image = $this->modeleOeuvre->get_image_oeuvre()){
					$this->vue->vue_erreur ("Impossible de récupérer les images des oeuvre");
				}
				if(!$topdiffu = $this->modeleOeuvre->get_note_grouping()){
					$this->vue->vue_erreur ("Impossible de récupérer la liste des diffusion du moment");
				}
				if(!$newsdiap = $this->modeleNews->get_4_news()){
					$this->vue->vue_erreur ("Impossible de récupérer la liste des nouveautés");
				}
					$this->vue->afficher_accueil($image,$oeuvres,$topdiffu,$newsdiap);
					echo "</br>";

			}

			catch(ModeleAccueilException $e){

				$this->vue->vue_erreur("Erreur");

			}

		}

	}

?>
