<?php

	class ControleurGenerique{
	
		protected $modele;
		protected $vue;

		function __construct($modele,$vue){
			$this->modele = $modele;
			$this->vue = $vue;
			
		}

		function getVue(){
			return $this->vue;
		}

	}

?>

