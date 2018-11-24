<?php
	
	require_once("include/modele_generique.php");

	class ModeleCommentaire extends ModeleGenerique{

		// Fonction d'ajout de commentaire à la base de donnée.
		function entrer_commentaire($commentaire,$key,$idcible){

			if($key=1){
				$type="idoeuvre";
			}
			$datep = date("Y-m-d");
			$idu = $_SESSION['iduser'];
			
			$reqPrep = self::$connexion->prepare("INSERT INTO mtvlist.commentaire (commentaire,datepublication,iduser,$type) 
				VALUES ('$commentaire','$datep',$idu,$idcible)");
			return $reqPrep->execute (array($commentaire,$key,$idcible));
			
		}

		// Renvoi les commentaires présent dans la base de donnée pour une oeuvre donnée.
		function get_liste_commentaire($idoeuvre){
				$req_com = self::$connexion->prepare ("SELECT idcommentaire,commentaire,datepublication,iduser,login,photo_profil FROM mtvlist.commentaire INNER JOIN mtvlist.utilisateur USING(iduser) WHERE idoeuvre=? ORDER BY datepublication");
			    $req_com->execute(array($idoeuvre));
			    $vide = [ ];
			    if (! $commentaire = $req_com->fetchAll()) {
					return $vide;
			   	}
					return $commentaire;
		}

		// Supprime un commentaire par son id
		function del_com($idcom){
			$reqSup = self::$connexion->prepare ("DELETE FROM commentaire WHERE idcommentaire=?");
			return $reqSup->execute (array($idcom));
		}

	}