<?php
	
	require_once("include/modele_generique.php");

	class ModelePersonnage extends ModeleGenerique{


			// Renvoi la liste des personnages d'uns oeuvre par son ID.
			function get_liste_personnage($idoeuvre) {

				$requete = self::$connexion->prepare("SELECT * FROM 
					mtvlist.jouer as jouer,
					mtvlist.personnage as perso,
					mtvlist.illustrepersonnage as illustre,
					mtvlist.image as image

					WHERE jouer.idpersonnage = perso.idpersonnage
					AND perso.idpersonnage = illustre.idpersonnage
					AND illustre.idimage = image.idimage 
					AND jouer.idoeuvre = ?");

				$requete->execute(array($idoeuvre));
				$resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
				return $resultat;
			
			}

	}

?>
