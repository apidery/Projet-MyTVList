<?php

	require_once("modules/recherche/controleur_recherche.php");

	class ModRecherche extends ModuleGenerique{
			
			function __construct(){
				$this->controle=new ControleurRecherche();
				
				$action = isset($_GET['action']) ? $_GET['action'] : "default";
				
				switch ($action) {
						case "rechercher" :
							$this->controle->liste_recherche();
							break;
						case "rechercher_ajax" :
							$this->controle->liste_recherche_ajax();
							break;
						default :
							echo "</br>";
							echo "\nVous ne pouvez pas voir les oeuvre pour le moment.";
						break;	

				}

		}
	}
?>

