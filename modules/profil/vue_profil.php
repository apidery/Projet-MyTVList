<?php
	require_once("include/vue_generique.php");
	require_once("include/controleur_generique.php");

	class VueProfil extends VueGenerique{
	
		function __construct(){
			parent::__construct();

		}

		//Affiche les informations d'un utilisateur.
		function affiche_profil($info){

					$id = $info['iduser'];
					$nom = htmlspecialchars($info['nom'], ENT_SUBSTITUTE, "UTF-8");
					$prenom = htmlspecialchars($info['prenom'], ENT_SUBSTITUTE, "UTF-8");
					$mail = htmlspecialchars($info['mail'], ENT_SUBSTITUTE, "UTF-8");
					$login = htmlspecialchars($info['login'], ENT_SUBSTITUTE, "UTF-8");
					$pp = htmlspecialchars($info['photo_profil'], ENT_SUBSTITUTE, "UTF-8");
					$datenaissance = $info['datenaissance'];
					$dateinscription = $info['dateinscription'];
					$repertoire = "image/";

			?>
					<link rel="stylesheet" type="text/css" href="modules/profil/style.css">
    				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    				<title>Profil</title>
					<div class="container">
					    <div class="row">
					            <div class="well well-sm">
					                <div class="row">
					                    <div class="col-sm-6 col-md-4">
					                        <img src="<?php echo $repertoire.$pp?>" alt="" class="img-rounded img-responsive">
					                    </div>
					                    <div class="col-sm-6 col-md-6">
					                        <h4><?php echo "$prenom $nom"; ?></h4>                
					                        <p>
					                            <i class="glyphicon glyphicon-user"></i><?php echo $login ?>
					                            <br>
					                            <i class="glyphicon glyphicon-envelope"></i><?php echo $mail ?>
					                            <br>
					                            <i class="glyphicon glyphicon-gift"></i><?php echo $datenaissance ?>
					                            <br>
					                            <i class="glyphicon glyphicon-calendar"></i><?php echo $dateinscription ?></p>
					                        <!-- Split button -->
					                        <div class="btn-group">
					                             <a href="index.php?module=profil&action=modifier_profil&iduser=<?php echo $id?>" class="btn btn-primary">Modifier votre profil</a>
					                        </div>
					                    </div>
					                </div>
					            </div>
					        </div>
					    </div>
		<?php 
					
		}

		// Affiche un formulaire de modification des informations d'un utilisateur.
		function vue_form_modif_user($info){


				$id = $info['iduser'];
				$nom = htmlspecialchars($info['nom'], ENT_SUBSTITUTE, "UTF-8");
				$prenom = htmlspecialchars($info['prenom'], ENT_SUBSTITUTE, "UTF-8");
				$mail = htmlspecialchars($info['mail'], ENT_SUBSTITUTE, "UTF-8");
				$login = htmlspecialchars($info['login'], ENT_SUBSTITUTE, "UTF-8");
				$pp = htmlspecialchars($info['photo_profil'], ENT_SUBSTITUTE, "UTF-8");
				$datenaissance = $info['datenaissance'];
				$dateinscription = $info['dateinscription'];
				$repertoire = "image/";	

			    $token_profil = uniqid(rand(), true);
		        $_SESSION['token_profil'] = $token_profil;
		        $_SESSION['token_time_profil'] = time();

			?>

			<link rel="stylesheet" type="text/css" href="modules/profil/style.css">
    		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    		<title>Modification profil </title>
			<form action="index.php?module=profil&action=modifie_profil&iduser=<?php echo $_SESSION['iduser'] ?>" enctype="multipart/form-data" method="post">
			   <div class="container">
				    <h1>Modifiez votre profil</h1>
				  	<hr>
					<div class="row">
				      <!-- left column -->
				      <div class="col-md-3">
				        <div class="text-center">
				          <img src="<?php echo $repertoire.$pp?>" id="modif_pp" class="avatar" alt="avatar">
				          <h6>Choisissez une nouvelle photo...</h6>
							<!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
							<input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
							<!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->
							<input name="userfile" type="file" />
				        </div>
				      </div>
				      
				      <!-- edit form column -->
				      <div class="col-md-9 personal-info">
				        <h3>Information personnelles</h3>
				          <div class="form-group">
				            <label class="col-lg-3 control-label">Prénom:</label>
				            <div class="col-lg-8">
				              <input class="form-control" name="prenom" type="text" placeholder="<?php echo $prenom?>">
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-lg-3 control-label">Nom:</label>
				            <div class="col-lg-8">
				              <input class="form-control" name="nom" type="text" placeholder="<?php echo $nom?>">
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-lg-3 control-label">Email:</label>
				            <div class="col-lg-8">
				              <input class="form-control" name="mail" type="text" placeholder="<?php echo $mail?>">
				            </div>
				          </div>
				           <div class="form-group">
				            <label class="col-md-3 control-label">Date naissance:</label>
				            <div class="col-md-8">
				              <input class="form-control" name="datenaissance" type="date" placeholder="<?php echo $datenaissance?>">
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-md-3 control-label">Username:</label>
				            <div class="col-md-8">
				              <input class="form-control" name="login" type="text" placeholder="<?php echo $login?>">
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-md-3 control-label">Mot de passe:</label>
				            <div class="col-md-8">
				              <input class="form-control" name="lastmdp" type="password" placeholder="Entrez votre mot de passe ">
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-md-3 control-label">Nouveau mot de passe:</label>
				            <div class="col-md-8">
				              <input class="form-control" name="newmdp" type="password" placeholder="Confirmer nouveau mot de passe">
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="col-md-3 control-label"></label>
				            <div class="col-md-8">
				              <input type="hidden" name="token_profil" id="token_time_profil" value="<?php echo $token_profil;?>"/>

				              <input type="submit" class="btn btn-primary" value="Modifier">
				              <span></span>
				            </div>
				          </div>
				      </div>
				   </div>
				</div>			       
			   </p>
			</form>

	<?php

		}
	}

?>