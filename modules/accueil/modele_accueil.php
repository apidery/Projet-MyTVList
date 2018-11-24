<?php
	
	require_once("include/modele_generique.php");

	class ModeleAccueil extends ModeleGenerique{

		function getMessage(){

			$message=self::$connexion->prepare("SELECT message FROM bibliotheque.acceuil");
			$result=$message->execute();
			$result = $message->fetch(PDO::FETCH_ASSOC);

			if(!($result)){
				
	        	throw new ModeleAccueilException();
	        
			}
			return $result;

		}

	}

?>
