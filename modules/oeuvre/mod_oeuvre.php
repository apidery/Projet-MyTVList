<?php

	require_once("modules/oeuvre/controleur_oeuvre.php");

	class Modoeuvre extends ModuleGenerique{			
			
			function __construct(){
				$this->controle=new ControleurOeuvre();			
				$action = isset($_GET['action']) ? $_GET['action'] : "default";
				
				switch ($action) {
						case "liste_film" :
							$this->controle->liste_film();
							break;
						case "liste_anime" :
							$this->controle->liste_anime();
							break;
						case "liste_serie" :
							$this->controle->liste_serie();
							break;
						case "liste_oeuvre_par_personne" :
							$this->controle->liste_oeuvre_personne();
							break;
						case "liste_oeuvreby_id" :
							$this->controle->affiche_une_oeuvre();
							break;
						case "classement_film" :
							$this->controle->classement_des_oeuvres();
							break;
						case "classement_anime" :
							$this->controle->classement_des_oeuvres();
							break;
						case "classement_serie" :
							$this->controle->classement_des_oeuvres();
							break;
						case "noter_oeuvre" :
							$this->controle->noter_oeuvre();
							break;
						default :
							echo "</br>";
							echo "\nVous ne pouvez pas voir les oeuvre pour le moment.";
						break;
				}
		}
	}
?>

