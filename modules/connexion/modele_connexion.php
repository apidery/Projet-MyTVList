<?php 

	class ModeleConnexion extends ModeleGenerique{

			//Renvoi le login de l'utilisateur grace a son ID
			function modele_get_login($iduser){

				$requete = "SELECT login FROM utilisateur WHERE iduser=?";
				
						$req = self::$connexion->prepare ($requete);
						$req->execute(array($iduser));
						return $req -> fetch();
			}

			// Renvoi l'ID d'un utilisateur grace au duo login & mot de passe.
			function modele_getiduser_login($login,$mdp){
					
					$requete = "SELECT iduser,prenom FROM utilisateur WHERE login=? AND mdp=?";
				
						$req = self::$connexion->prepare ($requete);
						$req->execute(array($login,$mdp));
						return $req -> fetch();
	
			}

			// Renvoi l'ID d'un utilisateur grace au duo email & mot de passe.
			function modele_getiduser_mail($mail,$mdp){
					
					$requete = "SELECT iduser FROM utilisateur WHERE mail=? AND mdp=?";
				
						$req = self::$connexion->prepare ($requete);
						$req->execute(array($mail,$mdp));
						return $req -> fetch();
	
			}

			// Renvoi le nom de l'utilisateur grace à son login.
			function modele_getnom($login){
					
					$requete = "SELECT nom FROM utilisateur WHERE login=?";
				
						$req = self::$connexion->prepare ($requete);
						$req->execute(array($login));
						return $req -> fetch();
	
			}

			// Renvoi l'ID du droit de l'utilisateur pas son adresse mail.
			function modele_getidroit_mail($mail){
					
					$requete = "SELECT idroit FROM utilisateur WHERE mail=?";
				
						$req = self::$connexion->prepare ($requete);
						$req->execute(array($mail));
						return $req -> fetch();
	
			}

			// Renvoi l'ID du droit de l'utilisateur pas son login.
			function modele_getidroit_login($login){
					
					$requete = "SELECT idroit FROM utilisateur WHERE login=?";
				
						$req = self::$connexion->prepare ($requete);
						$req->execute(array($login));
						return $req -> fetch();
	
			}

			// Renvoi le prénom d'un utilisateur grace à son login.
			function modele_getprenom($login){
					
					$requete = "SELECT prenom FROM utilisateur WHERE login=?";
				
						$req = self::$connexion->prepare ($requete);
						$req->execute(array($login));
						return $req -> fetch();
	
			}
	}

?>