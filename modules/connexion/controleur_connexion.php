<?php
	require_once("include/controleur_generique.php");
	require_once("modules/connexion/modele_connexion.php");
	require_once ("modules/oeuvre/modele_oeuvre.php");
	require_once ("modules/news/modele_news.php");
	require_once("modules/connexion/vue_connexion.php");
	require_once("modules/accueil/vue_accueil.php");


	class ControleurConnexion extends ControleurGenerique{

			function __construct(){
				$this->modele = new ModeleConnexion();
				$this->modeleOeuvre = new ModeleOeuvre();
				$this->modeleNews = new ModeleNews();
				$this->vue = new VueConnexion();
				$this->vue2 = new VueAccueil();
			}

			// Controleur qui renvoi vers le formulaire de connexion
			function form_connexion() {
				$this->vue->vue_form_connexion();
			}

			// Vérifie les paramêtres pour la connexion puis initialise la variable de session, puis renvoi vers l'accueil.
			function vers_connexion(){

				if(isset($_SESSION['token_connexion']) && isset($_SESSION['token_time_connexion']) && isset($_POST['token_connexion'])){

				    if($_SESSION['token_connexion'] == $_POST['token_connexion']){

				        $timestamp_ancien = time() - (15*60);

				        if($_SESSION['token_time_connexion'] >= $timestamp_ancien){


							if (! isset($_POST['login']) ) {
								$this->vue->vue_erreur("Problème : Identifiant non renseigné !");
								die("");
							}

							if(strpos($_POST['login'],"@")){
									if (!$this->modele->modele_getiduser_mail($_POST['login'], $this->modele->cryptermdp($_POST['mdp'],$_POST['login']))){ 
										$this->vue->vue_form_connexion();
										$this->vue->vue_erreur ("Connexion impossible !");
									}
									else{
										$iduser = $this->modele->modele_getiduser_mail($_POST['login'], $this->modele->cryptermdp($_POST['mdp'],$_POST['login']));
										
										$idroit = $this->modele->modele_getidroit_mail($_POST['login']);

										if(!isset($_SESSION['iduser'])){
											$_SESSION['iduser'] = $iduser[0];
											$_SESSION['idroit'] = $idroit[0];

											if(!$oeuvres = $this->modeleOeuvre->get_liste3film()){
												$this->vue2->vue_erreur ("Impossible de récupérer la liste des oeuvre");
											}

											if(!$topdiffu = $this->modeleOeuvre->get_top_oeuvre()){
												$this->vue->vue_erreur ("Impossible de récupérer la liste des diffusion du moment");
											}

											if(!$newsdiap = $this->modeleNews->get_4_news()){
												$this->vue->vue_erreur ("Impossible de récupérer la liste des nouveautés");
											}

											if(!$image = $this->modeleOeuvre->get_image_oeuvre()){
												$this->vue2->vue_erreur ("Impossible de récupérer les images des oeuvre");
											}
											
											$this->vue2->afficher_accueil($image,$oeuvres,$topdiffu,$newsdiap);	
										 }else{								 			
								 			echo "</br>";
								 			echo "</br>";
								 			echo "Vous etes deja connecte !";
										}
									}
							}
							else if(!$this->modele->modele_getiduser_login($_POST['login'], $this->modele->cryptermdp($_POST['mdp'],$_POST['login']))){
										$this->vue->vue_form_connexion();
										$this->vue->vue_erreur ("Connexion impossible !");
							}
							else{
								$iduser = $this->modele->modele_getiduser_login($_POST['login'], $this->modele->cryptermdp($_POST['mdp'],$_POST['login']));
								$idroit = $this->modele->modele_getidroit_login($_POST['login']);

								 if(!isset($_SESSION['iduser'])){
								 	$_SESSION['prenom'] = $iduser[1];
									$_SESSION['iduser'] = $iduser[0];
									$_SESSION['idroit'] = $idroit[0];


									if(!$oeuvres = $this->modeleOeuvre->get_liste3film()){
										$this->vue2->vue_erreur ("Impossible de récupérer la liste des oeuvre");
									}

									if(!$topdiffu = $this->modeleOeuvre->get_note_grouping()){
										$this->vue->vue_erreur ("Impossible de récupérer la liste des diffusion du moment");
									}

									if(!$newsdiap = $this->modeleNews->get_4_news()){
										$this->vue->vue_erreur ("Impossible de récupérer la liste des nouveautés");
									}

									if(!$image = $this->modeleOeuvre->get_image_oeuvre()){
										$this->vue2->vue_erreur ("Impossible de récupérer les images des oeuvre");
									}
										$this->vue2->afficher_accueil($image,$oeuvres,$topdiffu,$newsdiap);	
								 }else{
								 	echo "</br>";
								 	echo "</br>";
									echo "Vous etes deja connecte !";
								}
							}
						}
					}
				}
				
			}

			// Detruit la session active et renvoi à l'accueil.
			function vers_deconnexion() {
				
				session_unset();
				session_destroy();
				if(!$oeuvres = $this->modeleOeuvre->get_liste3film()){
					$this->vue2->vue_erreur ("Impossible de récupérer la liste des oeuvre");
				}
				if(!$topdiffu = $this->modeleOeuvre->get_note_grouping()){
					$this->vue->vue_erreur ("Impossible de récupérer la liste des diffusion du moment");
				}

				if(!$newsdiap = $this->modeleNews->get_4_news()){
					$this->vue->vue_erreur ("Impossible de récupérer la liste des nouveautés");
				}

				if(!$image = $this->modeleOeuvre->get_image_oeuvre()){
					$this->vue2->vue_erreur ("Impossible de récupérer les images des oeuvre");
				}
					$this->vue2->afficher_accueil($image,$oeuvres,$topdiffu,$newsdiap);
				
			}

			function affichage_par_defaut(){
				// Coder un affichage par defaut.
				echo "help";
			}
	}
?>