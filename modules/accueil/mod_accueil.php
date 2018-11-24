<?php
	require_once("include/module_generique.php");
	require_once("modules/accueil/controleur_accueil.php");
	require_once("modules/accueil/modele_accueil_exception.php");

	class ModAccueil extends ModuleGenerique{
		
		function __construct(){
			$this->controle = new ControleurAccueil();
			$this->controle->afficheaccueil();

		}

	}

?>
