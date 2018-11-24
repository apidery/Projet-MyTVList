<?php

	require_once ("modules/news/modele_news.php");
	require_once ("include/controleur_generique.php");
	require_once ("modules/news/vue_news.php");

	class ControleurNews extends ControleurGenerique{

		function __construct(){

			$this->modele = new ModeleNews();
			$this->vue = new VueNews();

		}

		// Renvoi la liste des news à la vue.
		function liste_news(){

			if(!$news = $this->modele->get_liste_news()){
				$this->vue->vue_erreur ("Aucune news trouvé");
			}

			$this->vue->vue_liste_news($news);
			
		}


	}
