<?php
	require_once("include/controleur_generique.php");
	require_once("modules/inscription/modele_inscription.php");
	require_once("modules/connexion/modele_connexion.php");
	require_once("modules/inscription/vue_inscription.php");
	require_once ("modules/oeuvre/modele_oeuvre.php");
	require_once ("modules/news/modele_news.php");
	require_once("modules/accueil/vue_accueil.php");


	class ControleurInscription extends ControleurGenerique{

			function __construct(){
				$this->modele=new ModeleInscription();
				$this->modeleConnexion = new modeleConnexion();
				$this->modeleOeuvre = new ModeleOeuvre();
				$this->modeleNews = new ModeleNews();
				$this->vue=new VueInscription();
				$this->vue2=new VueAccueil();
			}

			// Renvoi vers le formulaire d'inscription
			function form_inscription() {
				$this->vue->vue_form_ajout_user();	
			}

			// Controle les données fournis par l'utilisateur et l'ajoute (l'inscrit) si elle sont correct.
			function ajout_user(){
				$date = date("Y-m-d");
				$type = "user";

				//Si le jeton est présent dans la session et dans le formulaire

				if(isset($_SESSION['token_inscription']) && isset($_SESSION['token_time_inscription']) && isset($_POST['token_inscription'])){

				    //Si le jeton de la session correspond à celui du formulaire

				    if($_SESSION['token_inscription'] == $_POST['token_inscription']){

				        //On stocke le timestamp qu'il était il y a 15 minutes

				        $timestamp_ancien = time() - (15*60);

				        //Si le jeton n'est pas expiré

				        if($_SESSION['token_time_inscription'] >= $timestamp_ancien){
				
								if(isset($_POST['jour']) && isset($_POST['mois']) && isset($_POST['y'])){
									$jour = $_POST['jour'];
									$mois = $_POST['mois'];
									$annee = $_POST['y'];
								}
								else{
									$this->vue->vue_erreur("Problème : avec la date de naissance");
								}

								$naissance = "$annee-$mois-$jour"; 


								if (! isset($_POST['login']) || ! isset($_POST['mdp']) ) {									
									$this->vue->vue_form_ajout_user();
									$this->vue->vue_erreur("Problème : manque éléments formulaire");
									die("");
								}

								if($_POST['login']== '' || $_POST['mdp']== '' || $_POST['nomuser']== '' ||$_POST['prenomuser']== '' || $_POST['mail']== ''){									
									$this->vue->vue_form_ajout_user();
									$this->vue->vue_erreur("Problème : manque éléments formulaire pour l'inscription");
								}

								if(($_POST['mdp']!= $_POST['mdp2']) || $_POST==''){									
									$this->vue->vue_form_ajout_user();
									$this->vue->vue_erreur("Veuillez confirmer votre mot de passe");
								}

								
								else if (! $this->modele->modele_ajout_user( 
										$_POST['login'],
										$this->modele->cryptermdp($_POST['mdp'],
										$_POST['login']),
										$_POST['nomuser'],
										$_POST['prenomuser'],
										$_POST['mail'],
										$naissance,
										$date,
										$type,
										1)) {

										$this->vue->vue_erreur ("Ajout impossible ");
									}
									else{

										if(!$this->modeleConnexion->modele_getiduser_login($_POST['login'], $this->modeleConnexion->cryptermdp($_POST['mdp'],$_POST['login']))){
											$this->vue->vue_form_connexion();
											$this->vue->vue_erreur ("Connexion impossible !");
										}
										else{
											$iduser = $this->modeleConnexion->modele_getiduser_login($_POST['login'], $this->modeleConnexion->cryptermdp($_POST['mdp'],$_POST['login']));
											$idroit = $this->modeleConnexion->modele_getidroit_login($_POST['login']);

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
			}
	}
?>