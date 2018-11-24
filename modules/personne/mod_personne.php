<?php

	require_once("modules/personne/controleur_personne.php");

	class Modpersonne extends ModuleGenerique{

			
			
			function __construct(){
				$this->controle=new ControleurPersonne();
							
				$action = isset($_GET['action']) ? $_GET['action'] : "default";
				
				switch ($action) {
						case "liste_personne" :
							$this->controle->liste_personne();
							break;
						case "get_personne" :
							$this->controle->get_personne();
							break;
						default :
							echo "</br>";
							echo "\nVous ne pouvez pas voir les personnage pour le moment.";
						break;	

				}



		}
	}
?>

