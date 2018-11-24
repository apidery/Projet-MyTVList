<?php
	require_once("include/module_generique.php");
	require_once("modules/insertion/controleur_insertion.php");
	require_once("modules/insertion/modele_insertion.php");

	class ModInsertion extends ModuleGenerique{
		
		function __construct(){
			$this->controle = new ControleurInsertion();
			$action = isset($_GET['action']) ? $_GET['action'] : "default";

			switch ($action) {
				case "liste_action" :
					$this->controle->form_insertion();
					break;
				case "ajout_oeuvre" :
					$this->controle->ajout_oeuvre();
					break;
				case "form_ajoutoeuvre" :
					$this->controle->form_ajoutOeuvre();
					break;
				case "ajout_image" :
					$this->controle->ajout_image();
					break;
				case "form_ajoutimage" :
					$this->controle->form_ajoutImage();
					break;
				case "ajout_personnage" :
					$this->controle->ajout_personnage();
					break;
				case "form_ajoutpersonnage" :
					$this->controle->form_ajoutPersonnage();
					break;
				case "ajout_personne" :
					$this->controle->ajout_personne();
					break;
				case "form_ajoutpersonne" :
					$this->controle->form_ajoutPersonne();
					break;
				case "ajout_news" :
					$this->controle->ajout_news();
					break;
				case "form_ajoutnews" :
					$this->controle->form_ajoutNews();
					break;
				default :
					echo "Vous ne pouvez pas insérer ici !";
					break;
			}

		}

	}

?>
