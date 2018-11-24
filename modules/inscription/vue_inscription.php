<?php

	class VueInscription extends VueGenerique{
			
				function __construct(){
					parent::__construct();

				}

				function vue_erreur($message) {
					echo $message;
				}

        // Formulaire d'inscription.
				function vue_form_ajout_user(){

          $token_inscription = uniqid(rand(), true);

          $_SESSION['token_inscription'] = $token_inscription;

          $_SESSION['token_time_inscription'] = time();

				?>
				   <head>
	    				 <meta charset="UTF-8"/>
	                     <title> Inscription MyTVList</title>
	   					 <LINK href="modules/inscription/style2.css" rel="stylesheet" type="text/css">
	   			   </head>
    				<body>
        				 <div class="modal-dialog">
           						 <div class="modalite-container">
             						  <h1>Bienvenue sur MyTVList</h1><br>
              						  <form action="index.php?module=inscription&action=ajout_user" method='post'>
                   						<label for="prenom" class="modalite-titre">Prénom*</label>
                   						 <input type="text" name="prenomuser" placeholder="">

                   						<label for="username" class="modalite-titre">Nom*</label>
                   						 <input type="text" name="nomuser" placeholder="">

                    					<label for="email" class="modalite-titre">Email*</label>
                    					 <input type="text" name="mail" placeholder="">

                   						<label for="identifiant" class="modalite-titre">Identifiant*</label>
                    					 <input type="text" name="login" placeholder="">

                    					<label for="mdp" class="modalite-titre">Mot de passe*</label>
                    					 <input type="password" name="mdp" placeholder="">

                   						<label for="cmdp" class="modalite-titre">Confirmer mot de passe*</label>
                    						<input type="password" name="mdp2" placeholder="">
                    						<label for="cmdp" class="modalite-titre-naissance"><DATA>Date de naissance*</DATA></label>
                    								<div class="naissance">
                       								<?php
                        								  echo "<SELECT name='jour' Size='1'>";
                        								  echo "<optgroup label='jour'>";
   
                         										 for($jour=1; $jour<=31;$jour++){        //Lister les jours
                           										  if ($jour < 10){            //Lister les jours pour pouvoir leur ajouter un 0 devant
                                										echo "<OPTION>0$jour<br></OPTION>";
                             										  }
                             											else {
                                											echo "<OPTION>$jour<br></OPTION>";
                           											}
                               								 }
                               							echo "<optgroup>";
                         								  echo "</SELECT>";

                         								  echo '<SELECT name="mois" Size="1">';
                         								  echo "<optgroup label='mois'>";
                        								  $mois = array(1=>'Janvier', 2=>'Février', 3=>'Mars', 4=>'Avril', 5=>'Mai', 6=>'Juin', 7=>'Juillet', 8=>'Aout', 9=>'Septembre', 10=>'Octobre', 11=>'Novembre', 12=>'Decembre');
      
                         								 foreach($mois as $key => $moi){
                            								echo '<option value="' . $key . '">' . $moi . '</option>';
                        								  }

                        								 echo "<optgroup>";
                         								 echo "</SELECT>";

                         								 $date = date('Y');       //On prend l'année en cours
       
                         								 echo '<SELECT name="y" Size="1">';
                         								 echo "<optgroup label='année'>";
                           
                              						 for ($y=1950; $y<=$date; $y++) {           //De l'année 1950 à l'année actuelle
                                   						echo "<OPTION><br>$y<br></OPTION>"; }
                                   						echo "<optgroup>";
                          								echo "</SELECT>";
                      								 ?>
                    								</div>
                                   <input type="hidden" name="token_inscription" id="token_time_inscription" value="<?php echo $token_inscription;?>"/>
                   		 					<input type="submit" name="submit" class="login modalite-submit" value="S'inscrire">
                						</form>
                    
                					<div class="login-help">
                  							<a href="index.php?module=connexion&action=connexion">Je possède déjà un compte</a>
                					</div>
            				</div>
        				</div>
   					 </body>
				<?php
				}
	}


?>