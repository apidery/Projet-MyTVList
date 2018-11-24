<?php 

	class ModeleRecherche extends ModeleGenerique{

		// Recherche une oeuvre et ses informations, en comparant son titre à la chaine en argument.
		function modele_recherche_chaine($chaine){

			//$requete = "SELECT idoeuvre, titre_oeuvre, resume,datesortie_oeuvre FROM mtvlist.oeuvre WHERE MATCH (titre_oeuvre) AGAINST ('$chaine');";

			$requete = "SELECT idoeuvre, titre_oeuvre, resume_oeuvre, datesortie_oeuvre FROM mtvlist.oeuvre WHERE titre_oeuvre LIKE CONCAT('%',?, '%') ORDER BY titre_oeuvre DESC";

			$req = self::$connexion->prepare($requete);
			$req->execute(array($chaine));
				
			return $req -> fetchAll();
		}

		function modele_recherche_completion(){
			$term = $_GET['term'];

			$requete = $bdd->prepare('SELECT idoeuvre,titre_oeuvre FROM mtvlist.oeuvre WHERE titre_oeuvre LIKE :term');
			$requete->execute(array('term' => '%'.$term.'%'));

		}

	}