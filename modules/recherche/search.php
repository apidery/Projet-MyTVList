<?php

	$connexion = new PDO("mysql:host=localhost;dbname=mtvlist" , "Pidery" , "projetmontreuil");
	$connexion->query("SET NAMES utf8");

	$term = $_POST['term'];

	echo $term;

	$requete = $connexion->prepare("SELECT idoeuvre, titre_oeuvre FROM mtvlist.oeuvre WHERE titre_oeuvre LIKE CONCAT('%',?, '%') ORDER BY titre_oeuvre DESC");


	$requete->execute(array($term));

	$ret = $requete->fetchAll(PDO::FETCH_ASSOC);

	if(empty($ret)){
		echo "Aucun résultats.";
	}
	else{
		foreach ($ret as $p){
			$titre = $p['titre_oeuvre'];
		      $s = "<div id='rechercheTab'>
				<div class='row'>
				    <img class='col-md-3' src='docStrg.jpg' alt=''>
				    <div class='col-md-9 textNews'>
				      <h4> $titre </h4>
				    	<a href='index.php?module=oeuvre&action=liste_oeuvreby_id&idoeuvre= $titre >voir plus</a>
				    </div>
				</div>
		";
	   		 
	   	}	 
		
		echo $s;
	}
?>