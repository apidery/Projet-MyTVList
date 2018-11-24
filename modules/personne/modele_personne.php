<?php
	
	require_once("include/modele_generique.php");

	class ModelePersonne extends ModeleGenerique{

			// Renvoi la liste des personnes par l'ID de l'oeuvre dans laquelle ils jouent.
			function get_liste_personne($idoeuvre) {
				$requete = self::$connexion->prepare("SELECT * FROM 
					mtvlist.jouer as jouer,
					mtvlist.personne as perso,
					mtvlist.illustrepersonne as illustre,
					mtvlist.image as image
					WHERE jouer.idpersonne = perso.idpersonne
					AND perso.idpersonne = illustre.idpersonne
					AND illustre.idimage = image.idimage 
					AND jouer.idoeuvre = ? ");

				$requete->execute(array($idoeuvre));
				$resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
				return $resultat;
			
			}

			// Renvoi un personne et ses informations grace à son ID.
			function get_personne($idpersonne){

				$requete = self::$connexion->prepare("SELECT * FROM 
					mtvlist.jouer as jouer,
					mtvlist.personne as personne, 
					mtvlist.illustrepersonne as illustre,
					mtvlist.image as image 
					WHERE jouer.idpersonne = personne.idpersonne
					AND personne.idpersonne = illustre.idpersonne
					AND illustre.idimage = image.idimage
					AND personne.idpersonne = ?");

				$requete->execute(array($idpersonne));
				$resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
				return $resultat;


			}
	}

?>
