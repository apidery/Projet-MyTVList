<?php
	require_once("include/vue_generique.php");
	require_once("include/controleur_generique.php");

	class VueOeuvre extends VueGenerique{
	
		function __construct(){
			parent::__construct();
		}

		// Affiche les oeuvres leur genres et leur images.
		function vue_liste_oeuvre($genre,$image,$oeuvre) {
				$type = $oeuvre[0][7];
				echo "<ul>";				
				echo "<h1>$type(s): </h1></br> ";
				echo "<title>$type</title>";

				?>				
				<link href="modules/accueil/css/bootstrap.min.css" rel="stylesheet" type=""/>
				<link href='modules/oeuvre/style.css' rel="stylesheet" type="text/css" />				 

				<?php 
						foreach($oeuvre as $cle){
							$id = $cle['idoeuvre'];
							$titreoeuvre = htmlspecialchars($cle['titre_oeuvre'], ENT_SUBSTITUTE, "UTF-8");
							$resume = htmlspecialchars($cle['resume_oeuvre'], ENT_SUBSTITUTE, "UTF-8");
							$parution =  $cle['enparution'];
							$nbsaison =  $cle['nbsaison'];
							$nbepisode = $cle['nbepisode'];
							$datesortie = $cle['datesortie_oeuvre'];
												
							$repertoire="image/";

							?>
						<div class="col-sm-6 col-md-4">
						   	<div class="thumbnail">
								<div class="card">
							        <div class="sous_trans">
						                <span>
								            <?php 
								            echo "Date de sortie : ".$datesortie."</br>";
											if($parution==1){
												echo "Cette oeuvre est actuellement en parution.</br>";
											}
											else{
												echo "Cette oeuvre n'est plus en parution. </br>";
											}	

											if($cle['type']=='Serie' || $cle['type']=='Anime'){
												echo "Nombre de saison : ".$nbsaison."</br>";
												echo "Nombre d'épisode : ".$nbepisode."</br>";
											}

					
											foreach($image as $value1){
												$idOeuvre = $value1['idoeuvre'];
												$idIm = $value1['idimage'];
												$images = $value1['image'];
												$titre = $value1['titre'];
												if($id == $idOeuvre){
													?>
													</span>
													<a href="index.php?module=oeuvre&action=liste_oeuvreby_id&idoeuvre=<?php echo $id?>">
														<img src=" <?php echo $repertoire.$images; ?>" alt=""/>
													</a>
													<?php
												}
											}
									?>
									</div>
								</div>						
								<?php 
									echo "<h3> $titreoeuvre</br></h3>";
								?>
								<div class="synopsis">
									<span>
								<?php 		
										echo $resume."</br>";
										echo "</br>"."<a href=index.php?module=personnage&action=liste_personnage&idoeuvre=$id> Les personnages</a>";
								?>
									</span>
						</div>
					</div>
				</div>
				
			<?php
				}	

		}

		// Affiche une oeuvre avec ses genres, son images, ses commentaires, sa note et ses personnages.
		function vue_oeuvre($genre,$image,$oeuvre,$perso,$commentaire,$note) {

					$token_commentaire = uniqid(rand(), true);

				    $_SESSION['token_commentaire'] = $token_commentaire;

				    $_SESSION['token_time_commentaire'] = time();
									
					$id = $oeuvre['idoeuvre'];
					$titreoeuvre = htmlspecialchars($oeuvre['titre_oeuvre'], ENT_SUBSTITUTE, "UTF-8");
					$resume = htmlspecialchars($oeuvre['resume_oeuvre'], ENT_SUBSTITUTE, "UTF-8");
					$parution =  $oeuvre['enparution'];
					$nbsaison =  $oeuvre['nbsaison'];
					$nbepisode = $oeuvre['nbepisode'];
					$datesortie = $oeuvre['datesortie_oeuvre'];
					$repertoire="image/";
					$cpt=0;
					$nbGenre=0;
					$prenom_perso1 = htmlspecialchars($perso[0]['prenom_personnage'], ENT_SUBSTITUTE, "UTF-8");
					$nom_perso1 = htmlspecialchars($perso[0]['nom_personnage'], ENT_SUBSTITUTE, "UTF-8");
					$id_perso1 = $perso[0]['idpersonne'];
					$prenom_perso2 = htmlspecialchars($perso[1]['prenom_personnage'], ENT_SUBSTITUTE, "UTF-8");
					$nom_perso2 = htmlspecialchars($perso[1]['nom_personnage'], ENT_SUBSTITUTE, "UTF-8");
					$id_perso2 = $perso[0]['idpersonne'];


					echo "<title>$titreoeuvre</title>";
				
					foreach($image as $value1){
						$idOeuvre = $value1['idoeuvre'];
						$idIm = $value1['idimage'];
						$images = $value1['image'];
						$titre = $value1['titre'];

						if($id == $idOeuvre){
							?>
							<link href="modules/accueil/css/bootstrap.min.css" rel="stylesheet">
   							<link rel= "stylesheet" href= "modules/oeuvre/style.css"/>

   							<script src="modules/oeuvre/stars.js"></script>
					        <script type="text/javascript"></script>

   						 <body id="pageOeuvre">
							<section class="container col-md-8 col-md-push-2">
						      <div class= "row blocTitre" >
						        <h1 style="font-weight: bold;"> <?php echo $titreoeuvre?> </h1>
						      </div>
						      <hr>
						      <div class= "row blocOeuvre">
						        <div class= "col-md-4">
						          <img src="<?php echo $repertoire.$images; ?>" alt="Illustration">
						        </div>

						        	<?php
						}
				    }
						        	?>

						        <div class= "col-md-8 texteOeuvre">
						          <dl class="dl-horizontal">
						            <dt>Date de sortie :</dt>
						               <dd><?php echo $datesortie; ?> </dd><br>
						            <dt>Genre(s) :</dt>

						            <?php

						            		foreach($genre as $value2){						            			
												$ido = $value2['idoeuvre'];														
												if($id == $ido){																
														$cpt++;																			
												}																				
											}

						            		foreach($genre as $value2){						            			
												$ido = $value2['idoeuvre'];
												$idg = $value2['idgenre'];
												$genres = $value2['genre'];
												
												if($id == $ido){												
													echo "<dd> $genres </dd>";
												}
											}
											echo "</br>";
									?>
						            <dt>Avec :</dt>
						              <dd><?php echo "<a href='index.php?module=personne&idpersonnage=$id_perso1&action=get_personne'>$prenom_perso1 $nom_perso1</a>, <a href='index.php?module=personne&idpersonnage=$id_perso2&action=get_personne'>$prenom_perso2 $nom_perso2</a> <a href='index.php?module=personnage&action=liste_personnage&idoeuvre=$id'>, suite </a>"; ?></dd></br>

						            <dt> Donner une note :</dt>

						            <dd>
							            <div class="container">
										    <div class="row lead">
										      <div id="hearts" class="starrr" data-rating='<?php echo (int)$note[0]['note']; ?>'></div>			        
										       <input type="hidden" id="id_oeuvre_note" value="<?php echo $id?>">

										       <?php
										       		if(isset($_SESSION['iduser'])){
										       			$idvot = $_SESSION['iduser'];
										       		}
										       		else{
										       			$idvot = null;
										       		}
										       ?>
										       <input type="hidden" id='id_votant' value="<?php echo $idvot?>" />
										       <input type="hidden" id='tableau_result'/>
											</div>
										</div>
									</dd>
						          </dl>
						        </div>
						      </div>
						      <hr>
						      <div class= "row">
						        <div class= "col-md-12">
						          <h2 style="font-weight: bold;"> Résumé : </h2> <br>
						          <p> <?php echo $resume; ?> </p>
						        </div>
						      </div>
						      <hr> 
						      <div class= "row">
						        <div class= "col-md-12">
						        <h2 style="font-weight: bold;"> Les commentaires : </h2> <br>

						        <?php 
						        	if(empty($commentaire)){
						        		if(isset($_SESSION['iduser']))
						        			echo "Soyez le premier à commenter.";
						        		else
						        			echo "Aucun commentaire.";
						        	}
						        ?>

						        </div>
							        <div class= "row">

					<?php
							        	foreach($commentaire as $com){	
							        		$login_user= htmlspecialchars($com['login'] , ENT_SUBSTITUTE, "UTF-8");
							        		$id_user = $com['iduser'];
							        		$idcom = $com['idcommentaire'];
							        		$image_user=$com['photo_profil'];
							        		$le_commentaire = htmlspecialchars($com['commentaire'], ENT_SUBSTITUTE, "UTF-8");
							        		$date_publi = $com['datepublication'];

							        		if(isset($_SESSION['iduser']))
							        			$user_co = $_SESSION['iduser'];

					?>
											<div class= "col-md-10 col-md-push-1 lescoms">
									          <h4><a href=""><img src="<?php echo $repertoire.$image_user; ?>"></a> <a href=""><?php echo $login_user; ?></a> : </h4> 
									          <p> <?php echo $le_commentaire; ?></p>

									          <?php 
									          	if(isset($_SESSION['iduser']))
									          		if($id_user==$user_co || $_SESSION['idroit'] == 0){

									          			echo "<a href=index.php?module=commentaire&action=sup_commentaire&key=1&id=$id&idcom=$idcom> Supprimer </a>";

									          	}?>
									          
									        </div>	
					<?php																				
										}
					?>
						<div id="tableau_t"></div>
							       </div>  
						      </div>

					<?php
						      if(isset($_SESSION['iduser'])){  

					?>
									 <form action="index.php?module=commentaire&action=commenter&key=1&id=<?php echo$id?>" method='post'>
									 	 <h2 style="font-weight: bold;"> Commenter l'oeuvre : </h2><br>
		 								 <textarea name="commentaire"  rows="12" cols="70"> </textarea><br>
		 								 <input type="hidden" name="token_commentaire" id="token_commentaire" value="<?php echo $token_commentaire;?>"/>
		 								 <input type="submit" value="Commenter"/>
									</form> 
					    </section>					  
					  </body>
							
			<?php
						}
						
		}


		// Affiche le classement des oeuvres.
			function vue_oeuvre_classement($image,$oeuvres_classement,$genre,$note){
				$type = mb_strtolower($oeuvres_classement[0]['type'])."s";
				$cpt =0;
				$place = 1;

			?>
				<title><?php echo "Classement des $type" ?></title>

				<link rel="stylesheet" type="text/css" href="modules/oeuvre/style.css"/>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


				 <div class="wrapper">

			      <div class="box">
			      <h1>Classement des <?php echo "$type"?></h1>

			        <!-- main -->
		
			        <div class="column col-sm-9" id="main">
			            <div class="col-sm-12">  
			              <div class="page-header text-muted">
			                Top <?php echo $type; ?>
			              </div>
			            </div>

			            	 <?php
			        foreach($oeuvres_classement as $cle){

							$id = $cle['idoeuvre'];
							$titreoeuvre = htmlspecialchars($cle['titre_oeuvre'], ENT_SUBSTITUTE, "UTF-8");
							$resume = htmlspecialchars($cle['resume_oeuvre'], ENT_SUBSTITUTE, "UTF-8");
							$repertoire="image/";
			?>

			            <div class="row">    
				              <div class="col-sm-2">

				              <?php
						      foreach($image as $value1){
								$idOeuvre = $value1['idoeuvre'];
								$idIm = $value1['idimage'];
								$images = $value1['image'];
								$titre = $value1['titre'];

								if($id == $idOeuvre){

				              ?>
				                 <a href="index.php?module=oeuvre&action=liste_oeuvreby_id&idoeuvre=<?php echo $id?>" class="pull-right"><img id="imagesclass" src="<?php echo $repertoire.$images;?>"></a>
				               <?php
				                 }
				               }
				              ?>
				              </div>
				              <div class="col-sm-10">
				                <h3><?php echo $place.". ".$titreoeuvre; $place++; ?> </h3>
				                <div class="col-md-3">
				                  <h5>Genre :</h5>
				          
				                  <h5>Note :</h5>
				                  <h5>Résumé :</h5>
				                </div>
				                <div class="col-md-8">

				                <?php
				               	foreach($genre as $value2){						            			
										$ido = $value2['idoeuvre'];														
										if($id == $ido){																
												$cpt++;																			
										}																				
								}
								?>

								<h5>

								<?php

						        foreach($genre as $value2){						            			
										$ido = $value2['idoeuvre'];
										$idg = $value2['idgenre'];
										$genres = $value2['genre'];
												
										if($id == $ido){												
											echo "$genres"." ";
										}
								}

								?>
								</h5>

								<?php
								
					            	
					           foreach($note as $lesnotes){
					           
									$idOeuvre = $lesnotes['idoeuvre'];
									$lanote = (int)$lesnotes['note'];

										if($id == $idOeuvre){

								?>
					               		 <h5><?php echo $lanote; ?></h5>

					              <?php
					             		}
					         	}
					              ?>
					                <h5><?php echo $resume;?></h5>
					                <h4><small class="text-muted"><a href="index.php?module=oeuvre&action=liste_oeuvreby_id&idoeuvre=<?php echo $id?>" class="text-muted">Voir plus</a></small>
				                </div>
				              </div> 
			            </div>

			            <div class="row divider">    
			               <div class="col-sm-12"><hr></div>
			            </div>

			           <?php
				}
			?>

			        </div>			            
			    </div>
			  </div>
<?php
			}

	}

?>