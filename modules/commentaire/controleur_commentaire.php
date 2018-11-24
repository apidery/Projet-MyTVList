<?php
	require_once ("modules/commentaire/modele_commentaire.php");
	require_once ("modules/oeuvre/modele_oeuvre.php");
	require_once ("modules/personnage/modele_personnage.php");
	require_once ("include/controleur_generique.php");
	require_once ("modules/commentaire/vue_commentaire.php");
	require_once ("modules/oeuvre/vue_oeuvre.php");

	class ControleurCommentaire extends ControleurGenerique{

		function __construct(){

			$this->modele = new ModeleCommentaire();
			$this->modeleOeuvre = new ModeleOeuvre();
			$this->modelePersonnage = new modelePersonnage();
			$this->vue = new VueCommentaire();
			$this->vueOeuvre = new VueOeuvre();

		}


		//Controleur de la publication de commentaires.
		function faire_commentaire(){
			$com = $_POST['commentaire'];
			$key = $_GET['key'];
			$cible = $_GET['id'];

			if(!$this->modele->entrer_commentaire($com,$key,$cible)){
				$this->vue->vue_erreur ("Impossible de commenter !");
			}
			
			if(!$oeuvre = $this->modeleOeuvre->get_oeuvreby_id($cible)){
				$this->vue->vue_erreur ("Impossible de récupérer la liste des oeuvre pour cette personne.");
			}

			if(!$genre = $this->modeleOeuvre->get_genre_oeuvre()){
				$this->vue->vue_erreur ("Impossible de récupérer la liste des genres");
			}
			
			if(!$image = $this->modeleOeuvre->get_image_oeuvre()){
				$this->vue->vue_erreur ("Impossible de récupérer les images des oeuvre");
			}

			if(!$perso = $this->modelePersonnage->get_liste_personnage($cible)){
				$this->vue->vue_erreur ("Impossible de récupérer les personnages");
			}

			if(!$note = $this->modeleOeuvre->get_note($cible)){
					$this->vue->vue_erreur ("Impossible de calculer la note");
			}

			$commentaire = $this->modele->get_liste_commentaire($cible);

			$this->vueOeuvre->vue_oeuvre($genre,$image,$oeuvre,$perso,$commentaire,$note);
		}


		// Controleur pour la suppression de commentaires.
		function sup_commentaire(){

			if(!$this->modele->del_com($_GET['idcom'])){
				$this->vue->vue_erreur ("Impossible de supprimer le commentaire.");
			}

			$key = $_GET['key'];
			$cible = $_GET['id'];
			
			if(!$oeuvre = $this->modeleOeuvre->get_oeuvreby_id($cible)){
				$this->vue->vue_erreur ("Impossible de récupérer la liste des oeuvre pour cette personne.");
			}

			if(!$genre = $this->modeleOeuvre->get_genre_oeuvre()){
				$this->vue->vue_erreur ("Impossible de récupérer la liste des genres");
			}
			
			if(!$image = $this->modeleOeuvre->get_image_oeuvre()){
				$this->vue->vue_erreur ("Impossible de récupérer les images des oeuvre");
			}

			if(!$perso = $this->modelePersonnage->get_liste_personnage($cible)){
				$this->vue->vue_erreur ("Impossible de récupérer les personnages");
			}

			if(!$note = $this->modeleOeuvre->get_note($cible)){
					$this->vue->vue_erreur ("Impossible de calculer la note");
			}
			
			$commentaire = $this->modele->get_liste_commentaire($cible);

			$this->vueOeuvre->vue_oeuvre($genre,$image,$oeuvre,$perso,$commentaire,$note);

		}
	}