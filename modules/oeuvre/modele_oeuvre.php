<?php
	
	require_once("include/modele_generique.php");

	class ModeleOeuvre extends ModeleGenerique{

			// Renvoi la liste des oeuvre par type
			function get_liste_oeuvre($type){

				 $req_oeuvre = self::$connexion->prepare ("SELECT * FROM mtvlist.oeuvre WHERE oeuvre.type = ?");
		    	 $req_oeuvre->execute(array($type));
		    	 if (! $oeuvre = $req_oeuvre->fetchAll()) {
					return false;
		   		 }
					return $oeuvre;
			}

			// Renvoi les oeuvres par genres.
			function get_genre_oeuvre(){
				$reqGenre = self::$connexion->query("SELECT * FROM 
					mtvlist.oeuvre AS oeuvre ,
					mtvlist.avoir AS avoir
					INNER JOIN mtvlist.genre AS genre 
					ON avoir.idgenre = genre.idgenre 
					WHERE oeuvre.idoeuvre = avoir.idoeuvre");

				if($reqGenre->execute()){
					$resultat = $reqGenre->fetchAll();
					return $resultat;
				}
				else
					return false;
			}

			// Renvoi les oeuvres et les images associé.
			function get_image_oeuvre(){
				$reqIma = self::$connexion->query("SELECT * FROM 
					mtvlist.oeuvre AS oeuvre ,
					mtvlist.illustrefilm AS illustre
					INNER JOIN mtvlist.image AS image 
					ON illustre.idimage = image.idimage
					WHERE oeuvre.idoeuvre = illustre.idoeuvre");

				if($reqIma->execute()){
					$resultat = $reqIma->fetchAll();
					return $resultat;
				}
				else
					return false;

			}

			// Renvoi 3 films au hasard.
			function get_liste3film(){
				$req_oeuvre = self::$connexion->prepare ("SELECT idoeuvre,titre_oeuvre,resume_oeuvre FROM mtvlist.oeuvre WHERE oeuvre.type = 'Film' ORDER BY RAND() LIMIT 3");
			    $req_oeuvre->execute();
			    if (! $oeuvre = $req_oeuvre->fetchAll()) {
					return false;
			   	}
					return $oeuvre;
			}

			// Renvoi une oeuvre par son ID.
			function get_oeuvreby_id($id){
				$req_oeuvre = self::$connexion->prepare ("SELECT * FROM mtvlist.oeuvre WHERE idoeuvre=? LIMIT 1");
			    $req_oeuvre->execute(array($id));
			    if (! $oeuvre = $req_oeuvre->fetch()) {
					return false;
			   	}
					return $oeuvre;

			}


			// Renvoi la liste des oeuvres d'une personne.
			function get_liste_oeuvre_par_personne($idpersonne){

				$requete = self::$connexion->prepare("SELECT * FROM
					mtvlist.jouer as joue, 
					mtvlist.oeuvre as mtvo
					WHERE joue.idpersonne = ?
					AND mtvo.idoeuvre = joue.idoeuvre");

				$requete->execute(array($idpersonne));
				$resultat = $requete->fetchAll();
				return $resultat;

			}

			// Renvoi la moyenne des notes d'une oeuvre par son ID.
			function get_note($idoeuvre){

				$req_note = self::$connexion->prepare (" SELECT AVG(note) as note FROM mtvlist.notes WHERE idoeuvre=? ");
		    	$req_note->execute(array($idoeuvre));
		    	 if (! $note = $req_note->fetchAll()) {
					return false;
		   		 }
					return $note;

			}

			// Renvoi les oeuvre noté groupé par leur ID.
			function get_note_grouping(){

				$req_note = self::$connexion->prepare (" SELECT idoeuvre, titre_oeuvre , AVG(note) as note FROM mtvlist.notes
				INNER JOIN mtvlist.oeuvre USING(idoeuvre) GROUP BY idoeuvre;");
		    	$req_note->execute();
		    	 if (! $note = $req_note->fetchAll()) {
					return false;
		   		 }
					return $note;
				
			}

			// Renvoi la liste des oeuvre noté, par leur type, groupé par leur ID.
			function get_oeuvre_classement($type){

				$req_oeuvre = self::$connexion->prepare ("SELECT idoeuvre,titre_oeuvre,resume_oeuvre,type, AVG(note) as moyenneNote FROM mtvlist.oeuvre INNER JOIN mtvlist.notes USING(idoeuvre) WHERE type=?  GROUP BY idoeuvre ORDER BY moyenneNote ASC");
				
			    $req_oeuvre->execute(array($type));
			    if (! $oeuvre = $req_oeuvre->fetchAll()) {
					return false;
			   	}
					return $oeuvre;
			}

	}

?>
