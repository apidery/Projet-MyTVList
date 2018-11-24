<?php 

	require_once("modules/inscription/controleur_inscription.php");
	class Modinscription extends ModuleGenerique{

		function __construct(){
			$this->controle=new ControleurInscription();
			$action = isset($_GET['action']) ? $_GET['action'] : "default";

			switch ($action) {
				case "ajout_user" :
					$this->controle->ajout_user();
					break;
				case "form_inscription" :
					$this->controle->form_inscription();
					
					break;
				default :
					echo "Vous ne pouvez pas vous inscrire ici !";
					break;
			}
		}

	}


?>