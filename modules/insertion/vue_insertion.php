<?php
	require_once("include/vue_generique.php");
	require_once("include/controleur_generique.php");

	class VueInsertion extends VueGenerique{
	
		function __construct(){
			parent::__construct();

		}

		function vue_erreur($message) {
					echo $message;
		}


		
		function vue_insertion() {
			?>
			<li><a href=index.php?module=insertion&action=form_ajoutoeuvre> Insérer oeuvre</a></li>
			<li><a href=index.php?module=insertion&action=form_ajoutpersonnage> Insérer personnage</a></li>
			<li><a href=index.php?module=insertion&action=form_ajoutpersonne> Insérer personne</a></li>
			<li><a href=index.php?module=insertion&action=form_ajoutimage> Insérer image</a></li>
			<li><a href=index.php?module=insertion&action=form_ajoutnews> Insérer news</a></li>
			<?php
		}

		function vue_insertion_oeuvre($genres) {

			$token_insertion_oeuvre = uniqid(rand(), true);

	          $_SESSION['token_insertion_oeuvre'] = $token_insertion_oeuvre;

	          $_SESSION['token_time_insertion_oeuvre'] = time();

			?>
			<form action="index.php?module=insertion&action=ajout_oeuvre" method="post">
			   <p>
			       <label for="titre_oeuvre">Titre :</label>
			       <input type="text" name="titre_oeuvre"/>
			       <br />
			       <label for="resume_oeuvre">Résumé :</label>
			       <input type="text" name="resume_oeuvre"/>
			       <br />
			       <label> Type : </label>
			       <br />
			       Anime : <input type="radio" name="type" value="Anime"/>
			       <br />
       			   Film : <input type="radio" name="type" value="Film"/>
       			   <br />
       			   Série : <input type="radio" name="type" value="Serie"/>
       			   <br />
			       <label> En parution : </label>
			       <br />
			       Oui : <input type="radio" name="enparution" value="1"/>
			       <br />
       			   Non : <input type="radio" name="enparution" value="0"/>
       			   <br />
			       <label for="nbsaison">Nombre de saison(s) :</label>
			       <input type="text" name="nbsaison"/>
			       <br />
			       <label for="nbepisode">Nombre d'épisode(s) :</label>
			       <input type="text" name="nbepisode"/>
			       <br />
			       <label for="datesortie_oeuvre">Date de sortie de l'oeuvre :</label>
			       <input type="date" name="datesortie_oeuvre"/>
			       <br />
			       <label for="genre">Genre :</label>
			       <br />
			       <?php
					foreach ($genres as $genre) {
				                echo '<input type="checkbox" name="genre_'.$genre['idgenre'].'" value="'.$genre['idgenre'].'">',' '.$genre['genre'].'<br />';
					}
					?>
					<br /> 
					 <input type="hidden" name="token_insertion_oeuvre" id="token_time_insertion_oeuvre" value="<?php echo $token_insertion_oeuvre;?>"/>
			        <input type="submit" value="Envoyer" />
			   </p>
			</form>
			<?php
		}

		function vue_insertion_image($oeuvres, $personnages, $personnes) {

			$token_insertion_image = uniqid(rand(), true);

	          $_SESSION['token_insertion_image'] = $token_insertion_image;

	          $_SESSION['token_time_insertion_image'] = time();


			?>
			<form action="index.php?module=insertion&action=ajout_image" method="post">
			    <p>
				    <label for="image">Image :</label>
				    <input type="text" name="image"/>
				    <br />
				    <label for="titre">Titre :</label>
				    <input type="text" name="titre"/>
				    <br />
				    <label for="oeuvre">Oeuvre :</label>
					<input list="oeuvres" name="oeuvre">
					<datalist id="oeuvres">
						<?php
						foreach ($oeuvres as $oeuvre) {
					                echo '<option name="oeuvre_'.$oeuvre['idoeuvre'].'"value="'.$oeuvre['idoeuvre'].'">', $oeuvre['titre_oeuvre'];
						}
						?>
				    </datalist>
				    <br />
				    <label for="personnage">Personnage :</label>
					<input list="personnages" name="personnage">
					<datalist id="personnages">
						<?php
						foreach ($personnages as $personnage) {
					                echo '<option name="personnage_'.$personnage['idpersonnage'].'"value="'.$personnage['idpersonnage'].'">', $personnage['nom_personnage'];
						}
						?>
				    </datalist>
				    <br />
				    <label for="personne">Personne :</label>
					<input list="personnes" name="personne">
					<datalist id="personnes">
						<?php
						foreach ($personnes as $personne) {
					                echo '<option name="personne_'.$personne['idpersonne'].'"value="'.$personne['idpersonne'].'">', $personne['nom_personne'];
						}
						?>
				    </datalist>
				    <br />
				    <input type="hidden" name="token_insertion_image" id="token_time_insertion_image" value="<?php echo $token_insertion_image;?>"/>
			        <input type="submit" value="Envoyer" />
			    </p>
			</form>
			<?php
		}

		function vue_insertion_personnage($oeuvres, $personnes) {

			$token_insertion_personnage = uniqid(rand(), true);

	          $_SESSION['token_insertion_personnage'] = $token_insertion_personnage;

	          $_SESSION['token_time_insertion_personnage'] = time();

			?>
			<form action="index.php?module=insertion&action=ajout_personnage" method="post">
			   	<p>
			       	<label for="titre_oeuvre">Nom :</label>
			       	<input type="text" name="nom_personnage"/>
			       	<br />
			       	<label for="resume_oeuvre">Prénom :</label>
			       	<input type="text" name="prenom_personnage"/>
			       	<br />
			       	<label for="enparution">Pseudonyme :</label>
			       	<input type="text" name="pseudonyme_personnage"/>
			       	<br />
			       	<label for="oeuvre">Oeuvre :</label>
				   	<input list="oeuvres" name="oeuvre">
			       	<datalist id="oeuvres">
						<?php
						foreach ($oeuvres as $oeuvre) {
					                echo '<option name="oeuvre_'.$oeuvre['idoeuvre'].'"value="'.$oeuvre['idoeuvre'].'">', $oeuvre['titre_oeuvre'];
						}
						?>
				    </datalist>
				    <br />
				    <label for="personne">Personne :</label>
					<input list="personnes" name="personne">
					<datalist id="personnes">
						<?php
						foreach ($personnes as $personne) {
					                echo '<option name="personne_'.$personne['idpersonne'].'"value="'.$personne['idpersonne'].'">', $personne['nom_personne'];
						}
						?>
				    </datalist>
				    <br />
			       	<input type="hidden" name="token_insertion_personnage" id="token_time_insertion_personnage" value="<?php echo $token_insertion_personnage;?>"/>

			       	<input type="submit" value="Envoyer" />
			       
			   	</p>
			</form>
			<?php
		}

		function vue_insertion_personne() {

			$token_insertion_personne = uniqid(rand(), true);

	          $_SESSION['token_insertion_personne'] = $token_insertion_personne;

	          $_SESSION['token_time_insertion_personne'] = time();


			?>
			<form action="index.php?module=insertion&action=ajout_personne" method="post">
			   <p>
			       <label for="titre_oeuvre">Nom :</label>
			       <input type="text" name="nom_personne"/>
			       <br />
			       <label for="resume_oeuvre">Prénom :</label>
			       <input type="text" name="prenom_personne"/>
			       <br />
			       <label for="enparution">Nationalité :</label>
			       <input type="text" name="nationalite_personne"/>
			       <br />
			       <label for="enparution">Date de naissance :</label>
			       <input type="date" name="datenaissance_personne"/>
			       <br />
			       <label for="enparution">Biographie :</label>
			       <input type="text" name="biographie_personne"/>
			       <br />

			       <input type="hidden" name="token_insertion_personne" id="token_time_insertion_personne" value="<?php echo $token_insertion_personne;?>"/>
			       <input type="submit" value="Envoyer" />
			       
			   </p>
			</form>
			<?php
		}

		function vue_insertion_news() {

			$token_insertion_news = uniqid(rand(), true);

	          $_SESSION['token_insertion_news'] = $token_insertion_news;

	          $_SESSION['token_time_insertion_news'] = time();

			?>
			<form action="index.php?module=insertion&action=ajout_news" method="post">
			   <p>
			       <label for="titre_news">Titre :</label>
			       <input type="text" name="titre_news"/>
			       <br />
			       <label for="image_news">Image :</label>
			       <input type="text" name="image_news"/>
			       <br />
			       <label for="preview_news">Preview :</label>
			       <input type="text" name="preview_news"/>
			       <br />
			       <label for="contenu_news">Contenu :</label>
			       <br />
			       <textarea rows="4" cols="50" name="contenu_news"></textarea>
			       <br />

			       <input type="hidden" name="token_insertion_news" id="token_time_insertion_news" value="<?php echo $token_insertion_news;?>"/>
			       <input type="submit" value="Envoyer" />
			       
			   </p>
			</form>
			<?php
		}
	}
?>