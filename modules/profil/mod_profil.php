<?php

	require_once("modules/profil/controleur_profil.php");

	class Modprofil extends ModuleGenerique{
			
			function __construct(){
				$this->controle=new ControleurProfil();
			
				
				$action = isset($_GET['action']) ? $_GET['action'] : "default";
				
				switch ($action) {
						case "voir_profil" :
							$this->controle->voir_profil();
							break;
						case "modifier_profil" :
							$this->controle->modifier_profil();
							break;
						case "modifie_profil" :
							$this->controle->modifie_profil();
							break;
						default :
							echo "</br>";
							echo "\nVous ne pouvez pas accéder au profil pour l'instant";
						break;	

				}



		}
	}
?>

