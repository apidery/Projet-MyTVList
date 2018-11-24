<?php

	require_once("modules/news/controleur_news.php");

	class ModNews extends ModuleGenerique{

			function __construct(){
				$this->controle=new ControleurNews();
			
				
				$action = isset($_GET['action']) ? $_GET['action'] : "default";
				
				switch ($action) {
						case "liste_news" :
							$this->controle->liste_news();
							break;
						default :
							echo "</br>";
							echo "\nVous ne pouvez pas voir les nouveauté pour le moment.";
						break;	

				}

		}
	}
?>

