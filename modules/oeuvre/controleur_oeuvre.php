<?php

	require_once ("modules/oeuvre/modele_oeuvre.php");
	require_once ("modules/personnage/modele_personnage.php");
	require_once ("modules/commentaire/modele_commentaire.php");
	require_once ("include/controleur_generique.php");
	require_once ("modules/oeuvre/vue_oeuvre.php");

	class ControleurOeuvre extends ControleurGenerique{

		function __construct(){

			$this->modele = new ModeleOeuvre();
			$this->vue = new VueOeuvre();
			$this->modelePersonnage = new modelePersonnage();
			$this->modeleCommentaire = new modeleCommentaire();

		}

		// Renvoi la liste des films à la vue.
		function liste_film(){
			$type='Film';
			if(!$oeuvre = $this->modele->get_liste_oeuvre($type)){
				$this->vue->vue_erreur ("Impossible de récupérer la liste des oeuvre");
			}

			if(!$genre = $this->modele->get_genre_oeuvre()){
				$this->vue->vue_erreur ("Impossible de récupérer la liste des genres");
			}
			
			if(!$image = $this->modele->get_image_oeuvre()){
				$this->vue->vue_erreur ("Impossible de récupérer les images des oeuvre");
			}

			
				$this->vue->vue_liste_oeuvre($genre,$image,$oeuvre);
		}

		// Renvoi la liste des animes à la vue.
		function liste_anime(){
			$type='Anime';
			if(!$oeuvre = $this->modele->get_liste_oeuvre($type)){
				$this->vue->vue_erreur ("Impossible de récupérer la liste des oeuvre");
			}

			if(!$genre = $this->modele->get_genre_oeuvre()){
				$this->vue->vue_erreur ("Impossible de récupérer la liste des genres");
			}
			
			if(!$image = $this->modele->get_image_oeuvre()){
				$this->vue->vue_erreur ("Impossible de récupérer les images des oeuvre");
			}

				$this->vue->vue_liste_oeuvre($genre,$image,$oeuvre);
		}

		// Renvoi la liste des séries à la vue.
		function liste_serie(){
			$type='Serie';
			if(!$oeuvre = $this->modele->get_liste_oeuvre($type)){
				$this->vue->vue_erreur ("Impossible de récupérer la liste des oeuvre");
			}

			if(!$genre = $this->modele->get_genre_oeuvre()){
				$this->vue->vue_erreur ("Impossible de récupérer la liste des genres");
			}
			
			if(!$image = $this->modele->get_image_oeuvre()){
				$this->vue->vue_erreur ("Impossible de récupérer les images des oeuvre");
			}

				$this->vue->vue_liste_oeuvre($genre,$image,$oeuvre);
				
		}

		// Renvoi la liste des oeuvres pour un acteur à la vue.
		function liste_oeuvre_personne(){
			$idpersonne = $_GET['idpersonne'];
			if(!$lesoeuvres = $this->modele->get_liste_oeuvre_par_personne($idpersonne)){
				$this->vue->vue_erreur ("Impossible de récupérer la liste des oeuvre pour cette personne.");
			}

			if(!$genre = $this->modele->get_genre_oeuvre()){
				$this->vue->vue_erreur ("Impossible de récupérer la liste des genres");
			}
			
			if(!$image = $this->modele->get_image_oeuvre()){
				$this->vue->vue_erreur ("Impossible de récupérer les images des oeuvre");
			}
				$this->vue->vue_liste_oeuvre($genre,$image,$lesoeuvres);
		}


		// Renvoi une des oeuvre par son ID à la vue.
		function affiche_une_oeuvre(){
			$idoeuvre = $_GET['idoeuvre'];


			if(!$oeuvre = $this->modele->get_oeuvreby_id($idoeuvre)){
				$this->vue->vue_erreur ("Impossible de récupérer la liste des oeuvre pour cette personne.");
			}

			if(!$genre = $this->modele->get_genre_oeuvre()){
				$this->vue->vue_erreur ("Impossible de récupérer la liste des genres");
			}
			
			if(!$image = $this->modele->get_image_oeuvre()){
				$this->vue->vue_erreur ("Impossible de récupérer les images des oeuvre");
			}

			if(!$perso = $this->modelePersonnage->get_liste_personnage($idoeuvre)){
				$this->vue->vue_erreur ("Impossible de récupérer les personnages");
			}

			if(!$note = $this->modele->get_note($idoeuvre)){
					$this->vue->vue_erreur ("Impossible de calculer la note");
			}

			$commentaire = $this->modeleCommentaire->get_liste_commentaire($idoeuvre);

				$this->vue->vue_oeuvre($genre,$image,$oeuvre,$perso,$commentaire,$note);	
		}


		// Renvoi les oeuvres par type classé a la vue.
		function classement_des_oeuvres(){
			$type=$_GET['type'];


			if(!$oeuvres_classement = $this->modele->get_oeuvre_classement($type)){
				$this->vue->vue_erreur ("Impossible de récupérer le classement.");
			}
			if(!$image = $this->modele->get_image_oeuvre()){
				$this->vue->vue_erreur("Impossible de récupérer les images des oeuvre");
			}

			if(!$genre = $this->modele->get_genre_oeuvre()){
				$this->vue->vue_erreur ("Impossible de récupérer la liste des genres");
			}

			if(!$note = $this->modele->get_note_grouping()){
					$this->vue->vue_erreur ("Impossible de calculer la note");
			}

				$this->vue->vue_oeuvre_classement($image,$oeuvres_classement,$genre,$note);	
		}
	}
?>
