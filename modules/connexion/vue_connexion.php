<?php

	class VueConnexion extends VueGenerique{
			
				function __construct(){
					parent::__construct();

				}

				function vue_erreur($message) {
					echo $message;
				}

				// Formulaire pour la connexion.
				function vue_form_connexion(){

					$token_connexion = uniqid(rand(), true);

					$_SESSION['token_connexion'] = $token_connexion;

					$_SESSION['token_time_connexion'] = time();
				?>
		
					<html>
					    <head>
					    <meta charset="UTF-8"/>
					    <title> Connexion</title>
					    <LINK href="modules/connexion/style.css" rel="stylesheet" type="text/css">
					    </head>


					    <body>
					        <div class="modal-dialog">
					            <div class="modalite-container">
					                <h1>Entrez votre identifiant ou votre adresse mail et mot de passe</h1><br>
					                <form action="index.php?module=connexion&action=vers_connexion" method='post'>
						                <input type="text" name="login" placeholder="identifiant ou  mail">
						                <input type="password" name="mdp" placeholder="mot de passe">
						                <input type="hidden" name="token_connexion" id="token_time_connexion" value="<?php echo $token_connexion;?>"/>
						                <input type="submit" class="login modalite-submit" value="Se connecter">
					                </form>
					                <div class="login-help">
					                	<a href="index.php?module=inscription&action=form_inscription">Inscription</a> - <a href="#">Mot de passe oublié ?</a>
					                </div>
					            </div>
					        </div>
					    </body>
					</html>  

				<?php
				}

	}


?>