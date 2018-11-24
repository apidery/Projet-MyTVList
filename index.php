<?php
	
		require_once("modules/accueil/modele_accueil.php");
		require_once("modules/accueil/mod_accueil.php");
		require_once("include/modele_generique_exception.php");

 		$modele = new ModeleGenerique();
		$modele -> init();

		session_start();

		if(isset($_GET['module'])){

			$nom_module = $_GET['module'];
		}
		else{
			$nom_module = 'default';
		}

		switch ($nom_module) {
			case "accueil":
				require_once ("modules/accueil/mod_accueil.php"); 
				$nom_classe_module = "modaccueil";
				
				break;
			case "bibliotheque" :
				require_once ("modules/bibliotheque/mod_bibliotheque.php");
				$nom_classe_module = "modbibliotheque";
				break;
				
			case "inscription" :
				require_once ("modules/inscription/mod_inscription.php");
				$nom_classe_module = "modinscription";
				break;

			case "connexion" :
				require_once ("modules/connexion/mod_connexion.php");
				$nom_classe_module = "modconnexion";
				break;

			case "oeuvre" :
				require_once ("modules/oeuvre/mod_oeuvre.php");
				$nom_classe_module = "modoeuvre";
				break;

			case "personnage" :
				require_once("modules/personnage/mod_perso.php");
				$nom_classe_module = "modpersonnage";
				break;

			case "personne" :
				require_once("modules/personne/mod_personne.php");
				$nom_classe_module = "modpersonne";
				break;

			case "recherche" :
				require_once("modules/recherche/mod_recherche.php");
				$nom_classe_module = "modrecherche";
				break;
			case "commentaire" :
				require_once("modules/commentaire/mod_commentaire.php");
				$nom_classe_module = "modcommentaire";
				break;
			case "insertion" :
				require_once("modules/insertion/mod_insertion.php");
				$nom_classe_module = "modinsertion";
				break;
			case "profil" :
				require_once("modules/profil/mod_profil.php");
				$nom_classe_module = "modprofil";
				break;
			case "news" :
				require_once("modules/news/mod_news.php");
				$nom_classe_module = "modnews";
				break;
			default:
				die ("Aucun module");
				break;
		}


		$module = new $nom_classe_module();
		
		$module->getControleur()->getVue()->tamponVersContenu();
		require_once("include/template.php");


?>
