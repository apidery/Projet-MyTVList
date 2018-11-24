<?php

	require_once("modules/personnage/controleur_personnage.php");

	class Modpersonnage extends ModuleGenerique{

			
			
			function __construct(){
				$this->controle=new ControleurPersonnage();
			
				
				$action = isset($_GET['action']) ? $_GET['action'] : "default";
				
				switch ($action) {
						case "liste_personnage" :
							$this->controle->liste_personnage();
							break;
						default :
							echo "</br>";
							echo "\nVous ne pouvez pas voir les personnages pour le moment.";
						break;	

				}



		}
	}
?>

