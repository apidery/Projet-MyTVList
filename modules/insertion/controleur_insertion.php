<?php

	require_once ("modules/insertion/modele_insertion.php");
	require_once ("include/controleur_generique.php");
	require_once ("modules/insertion/vue_insertion.php");

	class ControleurInsertion extends ControleurGenerique{

		function __construct(){

			$this->modele = new ModeleInsertion();
			$this->vue = new VueInsertion();
			$this->vue2=new VueAccueil();

		}

		function form_ajoutOeuvre() {
				if (!$genres = $this->modele->get_liste_genres()) {
					vue_erreur("Impossible de récupérer les genres");
				}
				else {
					$this->vue->vue_insertion_oeuvre($genres);	
				}
		}

		function form_insertion() {
				$this->vue->vue_insertion();	
		}


		function form_ajoutImage() {
			if (!$oeuvres = $this->modele->get_liste_oeuvres()) {
				vue_erreur("Impossible de récupérer les oeuvres");
			}
			if (!$personnages = $this->modele->get_liste_personnages()) {
				vue_erreur("Impossible de récupérer les personnages");
			}
			if (!$personnes = $this->modele->get_liste_personnes()) {
				vue_erreur("Impossible de récupérer les personnes");
			}
			else {
				$this->vue->vue_insertion_image($oeuvres,$personnages,$personnes);	
			}
		}

		function form_ajoutPersonnage() {
			if (!$oeuvres = $this->modele->get_liste_oeuvres()) {
				vue_erreur("Impossible de récupérer les oeuvres");
			}
			if (!$personnes = $this->modele->get_liste_personnes()) {
				vue_erreur("Impossible de récupérer les personnes");
			}
			else {
				$this->vue->vue_insertion_personnage($oeuvres, $personnes);
			}
		}

		function form_ajoutPersonne() {
				$this->vue->vue_insertion_personne();	
		}

		function form_ajoutNews() {
				$this->vue->vue_insertion_news();	
		}

		function ajout_oeuvre(){


			if(isset($_SESSION['token_insertion_oeuvre']) && isset($_SESSION['token_time_insertion_oeuvre']) && isset($_POST['token_insertion_oeuvre'])){

				    if($_SESSION['token_insertion_oeuvre'] == $_POST['token_insertion_oeuvre']){

				        $timestamp_ancien = time() - (15*60);

				        if($_SESSION['token_time_insertion_oeuvre'] >= $timestamp_ancien){


							if($_POST['titre_oeuvre']== '' || $_POST['resume_oeuvre']== '' || $_POST['enparution']== '' ||$_POST['nbsaison']== '' || $_POST['nbepisode']== '' || $_POST['datesortie_oeuvre']== '' || $_POST['type']== ''){
								self::form_ajoutOeuvre();
								$this->vue->vue_erreur("Problème : manque éléments formulaire pour l'insertion");
							}
							else{
								$tab_genres = array();
								foreach ($_POST as $cle => $valeur) {
					            if (preg_match("/^genre_/", $cle)) {
						                $tab_genres[] = $valeur;
						            }
						        }
								if (! $this->modele->modele_ajout_oeuvre( 
										$_POST['titre_oeuvre'],
										$_POST['resume_oeuvre'],
										(int)$_POST['enparution'],
										(int)$_POST['nbsaison'],
										(int)$_POST['nbepisode'],
										$_POST['datesortie_oeuvre'],
										$_POST['type'],
										$tab_genres))
								{

									 	var_dump($tab_genres);
									$this->vue->vue_erreur ("Ajout impossible");
								}
								else {
									echo "oeuvre ajoutée !";
								}
							}
						}
					}
				}
		}

		function ajout_image(){

			if(isset($_SESSION['token_insertion_image']) && isset($_SESSION['token_time_insertion_image']) && isset($_POST['token_insertion_image'])){

				if($_SESSION['token_insertion_image'] == $_POST['token_insertion_image']){

				        $timestamp_ancien = time() - (15*60);

				    if($_SESSION['token_time_insertion_image'] >= $timestamp_ancien){

						if($_POST['image']== '' || $_POST['titre']== '' || ($_POST['oeuvre']== '' && $_POST['personnage']== '' && $_POST['personne']== '')) {
							self::form_ajoutImage();
							$this->vue->vue_erreur("Problème : manque éléments formulaire pour l'insertion");
						}
						else {

							if($_POST['oeuvre'] == '')
								$oeuvre = null;
							else
								$oeuvre = $_POST['oeuvre'];

							if($_POST['personnage'] == '')
								$personnage = null;
							else 
								$personnage = $_POST['personnage'];

							if($_POST['personne'] == '')
								$personne = null;
							else
								$personne = $_POST['personne'];

							if (! $this->modele->modele_ajout_image($_POST['image'],$_POST['titre'],$oeuvre,$personnage,$personne)) {
								$this->vue->vue_erreur ("Ajout impossible");
							}
							
							else {
								echo "image ajoutée !";
							}
						}
					}
				}
			}
		}

		function ajout_personnage(){

			if(isset($_SESSION['token_insertion_personnage']) && isset($_SESSION['token_time_insertion_personnage']) && isset($_POST['token_insertion_personnage'])){

				if($_SESSION['token_insertion_personnage'] == $_POST['token_insertion_personnage']){

				        $timestamp_ancien = time() - (15*60);

				    if($_SESSION['token_time_insertion_personnage'] >= $timestamp_ancien){

						if($_POST['nom_personnage']== '' || $_POST['prenom_personnage']== '' || $_POST['oeuvre']== '' || $_POST['personne'] == '') {
							self::form_ajoutPersonnage();
							$this->vue->vue_erreur("Problème : manque éléments formulaire pour l'insertion");
						}
						else{
							if($_POST['pseudonyme_personnage']== '') {
								if (! $this->modele->modele_ajout_personnage( 
									$_POST['nom_personnage'],
									$_POST['prenom_personnage'],
									NULL,
									$_POST['oeuvre'],
									$_POST['personne']))
								{
									$this->vue->vue_erreur ("Ajout impossible");
								}
								else {
									echo "personnage ajouté !";
								}
							}
							else {
								if (! $this->modele->modele_ajout_personnage( 
										$_POST['nom_personnage'],
										$_POST['prenom_personnage'],
										$_POST['pseudonyme_personnage'],
										$_POST['oeuvre'],
										$_POST['personne']))
								{
									$this->vue->vue_erreur ("Ajout impossible");
								}
								else {
									echo "personnage ajouté !";
								}
							}
						}
					}
				}
			}
		}

		function ajout_personne(){

				if(isset($_SESSION['token_insertion_personne']) && isset($_SESSION['token_time_insertion_personne']) && isset($_POST['token_insertion_personne'])){

				if($_SESSION['token_insertion_personne'] == $_POST['token_insertion_personne']){

				        $timestamp_ancien = time() - (15*60);

				    if($_SESSION['token_time_insertion_personne'] >= $timestamp_ancien){

						if($_POST['nom_personne']== '' || $_POST['prenom_personne']== '' || $_POST['nationalite_personne']== '' || $_POST['datenaissance_personne']== '' || $_POST['biographie_personne']== ''){
							self::form_ajoutPersonne();
							$this->vue->vue_erreur("Problème : manque éléments formulaire pour l'insertion");
						}
						else{
							if (! $this->modele->modele_ajout_personne( 
									$_POST['nom_personne'],
									$_POST['prenom_personne'],
									$_POST['nationalite_personne'],
									$_POST['datenaissance_personne'],
									$_POST['biographie_personne']))
							{
								$this->vue->vue_erreur ("Ajout impossible");
							}
							else {
								echo "personne ajouté !";
							}
						}
					}
				}
			}
		}

		function ajout_news(){
			if(isset($_SESSION['token_insertion_news']) && isset($_SESSION['token_time_insertion_news']) && isset($_POST['token_insertion_news'])){

				if($_SESSION['token_insertion_news'] == $_POST['token_insertion_news']){

				        $timestamp_ancien = time() - (15*60);

				    if($_SESSION['token_time_insertion_news'] >= $timestamp_ancien){

						if($_POST['titre_news']== '' || $_POST['image_news']== '' || $_POST['preview_news']== '' || $_POST['contenu_news']== ''){
							$this->vue->vue_insertion_news();
							$this->vue->vue_erreur("Problème : manque éléments formulaire pour l'insertion");
						}
						else{
							$today = new DateTime(null, new DateTimeZone('Europe/Paris'));
							if (! $this->modele->modele_ajout_news( 
									$_POST['titre_news'],
									$_POST['image_news'],
									$_POST['preview_news'],
									$today->format("Y-m-d"),
									$_POST['contenu_news']))
							{
								$this->vue->vue_erreur ("Ajout impossible");
							}
							else {
								echo "news ajoutée !";
							}
						}
					}
				}
			}
		}
	}
?>