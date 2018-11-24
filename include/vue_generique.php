<?php

	class VueGenerique{

		protected $titre;
		protected $contenu;
		static $start=0;

		function __construct(){
			$this->contenu = "";
			$this->titre = "MyTVList";
			if(self::$start == 0){
				self::$start=1;
				ob_start();
			}
		}

		function getTitre(){
			return $this->titre;
		}

		function getContenu(){
			return $this->contenu;
		}

		function tamponVersContenu(){
			$this->contenu.=ob_get_clean();
		
		}
	
		function vue_erreur($message){
			
			echo "$message";

		}

		function vue_confirm($messageconf){

			echo "$messageconf";
		}

	}


?>
