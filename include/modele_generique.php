<?php

	class ModeleGenerique{

		protected $controleur;
		private static $dns ="mysql:host=localhost;dbname=mtvlist";
		private static $user = "Pidery";
		private static $password = "projetmontreuil";
		protected static $connexion;
	
		protected static $salt = "aakkijdfgteyhnbxvscqzlmp";

		static function cryptermdp($mdp,$login){
			$taille=strlen($login);
			$salt=substr(self::$salt,0,22-$taille);
			$salt=$salt.$login;
			$mdpfini=crypt($mdp,$salt);
			return $mdpfini;
		}

		static function init() {
			self::$connexion = new PDO(self::$dns , self::$user , self::$password);
			self::$connexion->query("SET NAMES utf8");
		}

		static function creerToken($validite){
			$carac="abcdefghijklmnopqrst";
			$melange=str_shuffle($carac);
			$token=$melange;
			$dateT=date('Y-m-d H:i:s');

			$req = self::$connexion->prepare("INSERT INTO mtvlist.jeton (token,creation,expiration) 
				VALUES ('$token',$dateT',$validite)");
			$req->execute (array($validite));
			return $token;
		}

		static function getToken($token){

			$req_token = self::$connexion->prepare ("SELECT token FROM mtvlist.jeton WHERE token=$token");
			$req_token->execute(array($token));

			return $oeuvre = $req_oeuvre->fetch();	

		}

		static function effaceToken($token){

			$reqDel= self::$connexion->prepare ("DELETE FROM mtvlist.jeton WHERE token=$token");
			return $reqDel->execute (array($token));
		}

		static function effaceTokenNonValides(){
			$reqDel= self::$connexion->prepare ("DELETE FROM mtvlist.jeton WHERE NOW()<=DATE_ADD(creation,INTERVAL expiration second);");

			return $reqDel->execute (array());
		}
	}
	
?>
