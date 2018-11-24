
<html>
	 <head>
	  	
			    <meta charset="utf-8">
			    <meta http-equiv="X-UA-Compatible" content="IE=edge">
			    <meta name="viewport" content="width=device-width, initial-scale=1">		    
			    <link rel= "stylesheet" href= "modules/accueil/stylesheet.css"/>
			    <link rel="stylesheet" type='text/css' href='modules/accueil/css/bootstrap.min.css'/>

			    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  				<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

			    <script type="text/javascript" src="./jquery.min.js"></script>
				<script type="text/javascript" src="./jquery.autocomplete.min.js"></script>
	 </head>

	 <body>
	 		<header>
	 			<?php
	 				echo "</br></br></br>";
	 			?>
	 		<div id='b'>
	 		 <nav class="navbar navbar-default navbar-fixed-top">
					   <div class="container-fluid">
					        <div class="navbar-header">
					          <a href="index.php?module=accueil&action=aficcheaccueil"><img class="navbar-brand logo" src="image/logo.png" alt=""></a>
					        </div>
					        <ul class="nav navbar-nav">
					          <li><a href="index.php?module=news&action=liste_news">News</a></li>
					          <li class="dropdown">
					            <a class="dropdown-toggle" data-toggle="dropdown" href="index.php?module=oeuvre&action=liste_anime">Animes
					            <span class="caret"></span></a>
					            <ul class="dropdown-menu">
					              <li><a href="index.php?module=oeuvre&action=liste_anime">Les animes</a></li>
					              <li><a href="index.php?module=oeuvre&action=classement_anime&type=Anime">Classement des animés</a></li>			           
					            </ul>
					          </li>
					          <li class="dropdown">
					            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Films
					            <span class="caret"></span></a>
					            <ul class="dropdown-menu">
					              <li><a href="index.php?module=oeuvre&action=liste_film">Les films</a></li>
					              <li><a href="index.php?module=oeuvre&action=classement_film&type=Film">Classement des films</a></li>             
					            </ul>
					          </li> 
					          <li class="dropdown">
					            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Séries
					            <span class="caret"></span></a>
					            <ul class="dropdown-menu">
					              <li><a href="index.php?module=oeuvre&action=liste_serie">Les séries</a></li>
					              <li><a href="index.php?module=oeuvre&action=classement_serie&type=Serie">Classement des séries</a></li>           
					            </ul>
					          </li>
					        </ul>

					        <form class="navbar-form navbar-left" action="index.php?module=recherche&action=rechercher" method='post'>
					        <div class="form-group">
  							<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
					          <script type="text/javascript"></script>
					          
						          <input type="text" class="form-control" id="search" autocomplete="on" name="recherche"  placeholder="Ex: Titanic, Brad Pitt...">

						          <div id='a'></div>
					    
								<script>	
									 					
						            $(document).ready(function() {
						            	$('#search').keyup( function(){					            		$field = $(this);						 
						            		traitement($field);
						            	});
						            });

						            function traitement($field){
						            	if( $field.val().length > 3 ){
								            $.ajax({
								            	type : 'POST',
								            	url : './modules/recherche/search.php',
								            	data: {
								            		term:$field.val()
								            	},

								            	success : function(data) {
								            		$('#a').html(data);
								            		//alert('Fonctionne..');
								            	},
								            	error: function(data){
								            		$('#a').html(data);
								            		alert('Erreur..');
								            	}
								            });
								        }
						            }	

								</script>
					          </div>
					          <button type="submit" class="btn btn-default">Rechercher</button>
					        </form>
					        <ul class="nav navbar-nav navbar-right">
					          <?php
		                                if(isset($_SESSION['iduser'])) {
		                                	if(isset($_SESSION['idroit'])) {
		                                		if($_SESSION['idroit']==0){
		                       ?>
				                           		<li><a href="index.php?module=insertion&action=liste_action"> Admin connecté cliquer pour insérer </a></li>
				               <?php
				                           		}

				                ?>
				                           		<li><a href=index.php?module=profil&action=voir_profil&iduser=<?php echo $_SESSION['iduser']?> ><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['prenom']?></a></li>
				                <?php

				                           	}
				                ?>
				                                <li><a href="index.php?module=connexion&action=deconnexion"><span class="glyphicon glyphicon-log-in"></span> Déconnexion</a></li>

		                      <?php
		                      				
		                                }
		                                else{
		                        ?>
			                                <li><a href=index.php?module=connexion&action=connexion><span class="glyphicon glyphicon-user"></span> Connexion</a></li>

			                                <li><a href=index.php?module=inscription&action=form_inscription><span class="glyphicon glyphicon-plus"></span> Inscription </a></li>
		                                
					         	<?php 
					         			}
		          			   ?>
					        </ul>
					      </div>
					    </nav>
					    </div>
					    </header>
					    

					    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
					    <script src="modules/accueil/js/bootstrap.min.js"></script>

				
				 		<?php echo $module->getControleur()->getVue()->getContenu(); ?>
				
	 </body>

</html>
