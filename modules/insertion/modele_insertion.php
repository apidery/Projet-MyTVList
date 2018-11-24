<?php
	
	require_once("include/modele_generique.php");

	class ModeleInsertion extends ModeleGenerique{

			function modele_ajout_oeuvre($titre_oeuvre,$resume_oeuvre,$en_parution,$nbsaison,$nbepisode,$datesortie_oeuvre,$type,$tab_genres){
				$requete = "INSERT INTO mtvlist.oeuvre(titre_oeuvre,resume_oeuvre,enparution,nbsaison,nbepisode,datesortie_oeuvre,type) VALUES (?,?,?,?,?,?,?)";
				$reqPrep = self::$connexion->prepare($requete);
				if(!$reqPrep->execute (array($titre_oeuvre,$resume_oeuvre,$en_parution,$nbsaison,$nbepisode,$datesortie_oeuvre,$type))) {
					return false;
				}
			    $idoeuvre = self::$connexion->lastInsertId();
			    foreach ($tab_genres as $genre) {
			        self::modele_ajout_genre_oeuvre($idoeuvre, $genre);
			    }
			    return true;

			}

			function modele_ajout_image($image,$titre,$oeuvre,$personnage,$personne){
				$requete = "INSERT INTO mtvlist.image(image, titre) VALUES (?,?)";
				$reqPrep = self::$connexion->prepare($requete);
				if(!$reqPrep->execute (array($image, $titre))) {
					return false;
				}
				$idimage = self::$connexion->lastInsertId();

				if($oeuvre!=null) {
					if(!self::modele_ajout_image_oeuvre($oeuvre, $idimage))
						return false;
				}

				if($personnage!=null) {
					if(!self::modele_ajout_image_personnage($personnage, $idimage))
						return false;
				}

				if($personne!=null) {
					if(!self::modele_ajout_image_personne($personne, $idimage))
						return false;
				}
				return true;
			}

			function modele_ajout_personnage($nom_personnage,$prenom_personnage,$pseudonyme_personnage, $oeuvre, $personne){
				$requete = "INSERT INTO mtvlist.personnage(nom_personnage, prenom_personnage, pseudonyme_personnage) VALUES (?,?,?)";
				$reqPrep = self::$connexion->prepare($requete);
				if(!$reqPrep->execute (array($nom_personnage, $prenom_personnage, $pseudonyme_personnage))) {
					return false;
				}
				$idpersonnage = self::$connexion->lastInsertId();

				if(!self::modele_ajout_jouer($oeuvre, $personne, $idpersonnage)) {
					return false;
				}
				else 
					return true;

			}

			function modele_ajout_personne($nom_personne,$prenom_personne,$nationalite_personne,$datenaissance_personne,$biographie_personne){
				$requete = "INSERT INTO mtvlist.personne(nom_personne,prenom_personne,nationalite_personne,datenaissance_personne,biographie_personne) VALUES (?,?,?,?,?)";
				$reqPrep = self::$connexion->prepare($requete);
				return $reqPrep->execute (array($nom_personne,$prenom_personne,$nationalite_personne,$datenaissance_personne,$biographie_personne));
			}

			function modele_ajout_news($titre_news,$image_news,$preview_news,$date_news,$contenu_news){
				$requete = "INSERT INTO mtvlist.news(titre_news,image_news,preview_news,date_news,contenu_news) VALUES (?,?,?,?,?)";
				$reqPrep = self::$connexion->prepare($requete);
				return $reqPrep->execute (array($titre_news,$image_news,$preview_news,$date_news,$contenu_news));
			}

			function get_liste_genres() {
				$requete = self::$connexion->query("SELECT * FROM mtvlist.genre");
				return $requete->fetchAll(PDO::FETCH_ASSOC);
			}

			function get_liste_oeuvres() {
				$requete = self::$connexion->query("SELECT * FROM mtvlist.oeuvre");
				return $requete->fetchAll(PDO::FETCH_ASSOC);
			}

			function get_liste_personnages() {
				$requete = self::$connexion->query("SELECT * FROM mtvlist.personnage");
				return $requete->fetchAll(PDO::FETCH_ASSOC);
			}

			function get_liste_personnes() {
				$requete = self::$connexion->query("SELECT * FROM mtvlist.personne");
				return $requete->fetchAll(PDO::FETCH_ASSOC);
			}

			function modele_ajout_genre_oeuvre($idoeuvre, $genre) {
				$req_insert_genre_oeuvre = "INSERT INTO mtvlist.avoir (idoeuvre, idgenre) VALUES (?,?)";
				$reqPrep_insert_genre_oeuvre = self::$connexion->prepare($req_insert_genre_oeuvre);
				$reqPrep_insert_genre_oeuvre->execute(array($idoeuvre, $genre));
			}

			function modele_ajout_image_oeuvre($oeuvre, $idimage) {
				$req_insert_image_oeuvre = "INSERT INTO mtvlist.illustrefilm (idoeuvre, idimage) VALUES (?,?)";
				$reqPrep_insert_image_oeuvre = self::$connexion->prepare($req_insert_image_oeuvre);
				return $reqPrep_insert_image_oeuvre->execute(array($oeuvre, $idimage));
			}

			function modele_ajout_image_personnage($personnage, $idimage) {
				$req_insert_image_personnage = "INSERT INTO mtvlist.illustrepersonnage (idpersonnage, idimage) VALUES (?,?)";
				$reqPrep_insert_image_personnage = self::$connexion->prepare($req_insert_image_personnage);
				return $reqPrep_insert_image_personnage->execute(array($personnage, $idimage));
			}

			function modele_ajout_image_personne($personne, $idimage) {
				$req_insert_image_personne = "INSERT INTO mtvlist.illustrepersonne (idpersonne, idimage) VALUES (?,?)";
				$reqPrep_insert_image_personne = self::$connexion->prepare($req_insert_image_personne);
				return $reqPrep_insert_image_personne->execute(array($personne, $idimage));
			}

			function modele_ajout_jouer($oeuvre, $personne, $idpersonnage) {
				$req_insert_jouer = "INSERT INTO mtvlist.jouer (idpersonne, idpersonnage, idoeuvre) VALUES (?,?,?)";
				$reqPrep_insert_jouer = self::$connexion->prepare($req_insert_jouer);
				return $reqPrep_insert_jouer->execute(array($personne, $idpersonnage, $oeuvre));
			}
	}

?>
