<?php

	require_once ("modules/profil/modele_profil.php");
	require_once ("include/controleur_generique.php");
	require_once ("modules/profil/vue_profil.php");
	require_once("modules/connexion/modele_connexion.php");

	class ControleurProfil extends ControleurGenerique{

		function __construct(){
			$this->modele = new ModeleProfil();
			$this->modeleConnexion = new ModeleConnexion();
			$this->vue = new VueProfil();
		}

		// Renvoi les information à la vue pour afficher le profil.
		function voir_profil() {
				$iduser = $_GET['iduser'];

				if(!$info = $this->modele->get_info_user($iduser)){
					$this->vue->vue_erreur ("Impossible de récupérer les informations pour cette personne.");
				}

				$this->vue->affiche_profil($info);
		}

		// Renvoi vers la vue de modification du profil.
		function modifier_profil(){

			$iduser = $_GET['iduser'];

			if(!$info = $this->modele->get_info_user($iduser)){
				$this->vue->vue_erreur ("Impossible de récupérer les informations pour cette personne.");
			}

			$this->vue->vue_form_modif_user($info);
		}

		// Vérifie les informations avant la modification du profil.
		function modifie_profil(){
			$iduser = $_GET['iduser'];

				//Si le jeton est présent dans la session et dans le formulaire

				if(isset($_SESSION['token_profil']) && isset($_SESSION['token_time_profil']) && isset($_POST['token_profil'])){

				    //Si le jeton de la session correspond à celui du formulaire

				    if($_SESSION['token_profil'] == $_POST['token_profil']){

				        //On stocke le timestamp qu'il était il y a 15 minutes

				        $timestamp_ancien = time() - (15*60);

				        //Si le jeton n'est pas expiré

				        if($_SESSION['token_time_profil'] >= $timestamp_ancien){

						if(isset($_POST['lastmdp'])){
							$login = $this->modeleConnexion->modele_get_login($iduser);

							if($this->modeleConnexion->modele_getiduser_login($login[0], $this->modele->cryptermdp($_POST['lastmdp'],$login[0]))){

								if(isset($_FILES['userfile'])){
									//On ne prend que des extensions d'images.
									$extensions = array('.png', '.gif', '.jpg', '.jpeg');
									// récupère la partie de la chaine à partir du dernier . pour connaître l'extension.
									$extension = strrchr($_FILES['userfile']['name'], '.');
									//Ensuite on teste
									if(!in_array($extension, $extensions)){//Si l'extension n'est pas dans le tableau
									
									     $this->vue->vue_erreur ("Pas du bon type de fichier pour une photo de profil.");
									}

									$uploaddir = "/wamp64/www/MyTVList/image/";
									$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);

									echo '<pre>';
									if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
										if(!$this->modele->modif_photo_profil($_FILES['userfile']['name'],$iduser)){
												$this->vue->vue_erreur ("Photo non modifié");
										}
									    echo "Le fichier est valide, et a été téléchargé avec succès.\n";
									} else {
									    echo "Attaque potentielle par téléchargement de fichiers.";
									}
									echo '</pre>';	
							    }

								if(!$_POST['login']==''){
										if(!$this->modele->modif_login($_POST['login'],$iduser)){
											$this->vue->vue_erreur ("Pseudo non modifié");
										}
								}

								if(!$_POST['nom']==''){
										if(!$this->modele->modif_nom($iduser,$_POST['nom'])){
											$this->vue->vue_erreur ("Nom non modifié");
										}
								}

								if(!$_POST['prenom']==''){
										if(!$this->modele->modif_prenom($iduser,$_POST['prenom'])){
											$this->vue->vue_erreur ("Prénom non modifié");
										}
								}

								if(!$_POST['mail']==''){
										if(!$this->modele->modif_mail($iduser,$_POST['mail'])){
											$this->vue->vue_erreur ("Mail non modifié");
										}
								}

								if(!$_POST['datenaissance']==''){
										if(!$this->modele->modif_datenaissance($iduser,$_POST['datenaissance'])){
											$this->vue->vue_erreur ("Date de naissance non modifié");
										}	
								}

								if(!$_POST['newmdp']==''){
									$mdpcrypt=$this->modele->cryptermdp($_POST['newmdp'],$login[0]);
									echo $mdpcrypt;
									if(!$this->modele->modif_mdp($iduser,$mdpcrypt)){
										$this->vue->vue_erreur ("veuillez remplir le 2eme formulaire pour le mots de passe");
									}	
								}
							}
							else{
								$this->vue->vue_erreur ("Vous devez renseigner votre mots de passe actuel pour effectuer une modification.");
							}
						}

						$info = $this->modele->get_info_user($iduser);
						$this->vue->affiche_profil($info);
					}
				}
			}
		}

	}

?>
