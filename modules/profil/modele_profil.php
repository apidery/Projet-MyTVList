<?php
	
	require_once("include/modele_generique.php");

	class ModeleProfil extends ModeleGenerique{

		// Renvoi les informations d'un utilisateur par son ID.
		function get_info_user($id){

				 $req_info = self::$connexion->prepare ("SELECT iduser,login,nom,prenom,mail,datenaissance,dateinscription,photo_profil FROM mtvlist.utilisateur WHERE iduser=?");
		    	 $req_info->execute(array($id));
		    	 if (! $information = $req_info->fetch()) {
					return false;
		   		 }
					return $information;
		}

		// Modifie le login d'un utilisateur par son ID.
		function modif_login($newlogin,$iduser){

			$requete = "UPDATE utilisateur SET login=? WHERE iduser=?";
			$reqPrep = self::$connexion->prepare($requete);
			return $reqPrep->execute(array($newlogin, $iduser));

		}

		// Modifie la photo de profil d'un utilisateur par son ID.
		function modif_photo_profil($newphoto,$iduser){

			$requete = "UPDATE utilisateur SET photo_profil=? WHERE iduser=?";
			$reqPrep = self::$connexion->prepare($requete);
			return $reqPrep->execute(array($newphoto, $iduser));

		}

		// Modifie le nom d'un utilisateur par son ID.
		function modif_nom($iduser,$newnom){
			$requete = "UPDATE utilisateur SET nom=? WHERE iduser=?";
			$reqPrep = self::$connexion->prepare ($requete);
			return $reqPrep->execute(array($newnom, $iduser));

		}

		// Modifie le prénom d'un utilisateur par son ID.
		function modif_prenom($iduser,$newprenom){
			$requete = "UPDATE utilisateur SET prenom=? WHERE iduser=?";
			$reqPrep = self::$connexion->prepare ($requete);
			return $reqPrep->execute (array($newprenom, $iduser));
		}

		// Modifie l'adresse mail d'un utilisateur par son ID.
		function modif_mail($iduser,$newmail){
			$requete = "UPDATE utilisateur SET mail=? WHERE iduser=?";
			$reqPrep = self::$connexion->prepare ($requete);
			return $reqPrep->execute (array($newmail, $iduser));
		}


		// Modifie la date de naissance d'un utilisateur par son ID.
		function modif_datenaissance($iduser,$newdaten){
			$requete = "UPDATE utilisateur SET datenaissance=? WHERE iduser=?";
			$reqPrep = self::$connexion->prepare ($requete);
			return $reqPrep->execute (array($newdaten, $iduser));
		}

		// Modifie le mot de passe d'un utilisateur par son ID.
		function modif_mdp($iduser,$newmdp){
			$requete = "UPDATE utilisateur SET mdp=? WHERE iduser=?";
			$reqPrep = self::$connexion->prepare ($requete);
			return $reqPrep->execute (array($newmdp, $iduser));

		}

	}

?>