<?php 

class ModeleInscription extends ModeleGenerique{

		// Ajoute un utilisateur à la base de donnée.
		function modele_ajout_user($login,$mdp,$nom,$prenom,$mail,$datenaissance,$dateinscription,$type,$iddroit){
				$requete = "INSERT INTO mtvlist.utilisateur(login,mdp,nom,prenom,mail,datenaissance,dateinscription,type,idroit) VALUES (?,?,?,?,?,?,?,?,?)";

				$reqPrep = self::$connexion->prepare($requete);
				return $reqPrep->execute (array($login,$mdp,$nom,$prenom,$mail,$datenaissance,$dateinscription,$type,$iddroit));
				
		}

		
	}

?>