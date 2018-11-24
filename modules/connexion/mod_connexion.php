<?php 

	require_once("modules/connexion/controleur_connexion.php");
	class Modconnexion extends ModuleGenerique{

		function __construct(){
			$this->controle=new ControleurConnexion();
			$action = isset($_GET['action']) ? $_GET['action'] : "default";

			switch ($action) {
				case "connexion" :		
					$this->controle->form_connexion();
					break;
				case "vers_connexion" :
					$this->controle->vers_connexion();
					break;
				case "deconnexion" :
					$this->controle->vers_deconnexion();
					break;
				default :
					$this->controle->affichage_par_defaut();
					break;
			}
		}

	}


?>