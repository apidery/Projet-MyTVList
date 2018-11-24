<?php

	require_once("modules/commentaire/controleur_commentaire.php");

	class ModCommentaire extends ModuleGenerique{		
			
			function __construct(){
				$this->controle=new ControleurCommentaire();
			
				
				$action = isset($_GET['action']) ? $_GET['action'] : "default";
				
				switch ($action) {
						case "commenter" :
							$this->controle->faire_commentaire();
							break;
						case "sup_commentaire" :
							$this->controle->sup_commentaire();
							break;
						default :
							echo "</br>";
							echo "\nVous ne pouvez pas commenter pour le moment ";
						break;	

				}
		}
	}
?>

