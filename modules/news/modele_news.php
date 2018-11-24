<?php
	
	require_once("include/modele_generique.php");

	class ModeleNews extends ModeleGenerique{

		// Renvoi toutes les news présentes dans la base de donnée.
		function get_liste_news(){

				 $req_oeuvre = self::$connexion->prepare ("SELECT * FROM mtvlist.news ORDER BY date_news DESC");
		    	 $req_oeuvre->execute();
		    	 if (! $oeuvre = $req_oeuvre->fetchAll()) {
					return false;
		   		 }
					return $oeuvre;
		}


		// Renvoi 4 news les plus récentes.
		function get_4_news(){

				 $req_oeuvre = self::$connexion->prepare ("SELECT * FROM mtvlist.news ORDER BY date_news DESC LIMIT 4");
		    	 $req_oeuvre->execute();
		    	 if (! $oeuvre = $req_oeuvre->fetchAll()) {
					return false;
		   		 }
					return $oeuvre;
		}

	}