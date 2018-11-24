<?php
	require_once("include/vue_generique.php");
	require_once("include/controleur_generique.php");

	class VueAccueil extends VueGenerique{
	
		function __construct(){
			parent::__construct();
		}

		function affiche($message){
			echo "$message";
		}


		// Affiche l'accueil carousel des 4 news les plus récentes, les oeuvres le mieux notées à droite, et des films aléatoirement dans le bloc de gauche.
		function afficher_accueil($images,$oeuvres,$topdiffu,$diap){							
				$repertoire="image/";
				?>
					  <head>
					    <meta charset="utf-8">
					    <meta http-equiv="X-UA-Compatible" content="IE=edge">
					    <meta name="viewport" content="width=device-width, initial-scale=1">
					    <title>Accueil</title>
					    <link rel= "stylesheet" href= "stylesheet.css"/>
					    <link rel="stylesheet" type='text/css' href='css/bootstrap.min.css'/>
					  </head>

					    <div id="myCarousel" class="carousel slide container" data-ride="carousel">
					      <div class="row">
					        <!-- Indicators -->
					        <ol class="carousel-indicators">
					          <li data-target="" data-slide-to="0" class="active"></li>
					          <li data-target="" data-slide-to="1"></li>
					          <li data-target="" data-slide-to="2"></li>
					          <li data-target="" data-slide-to="3"></li>
					        </ol>

					        <!-- Wrapper for slides -->
					        <div class="carousel-inner" role="listbox">
					          <div class="item active">
					          <a href="index.php?module=news&action=newsby_id&idnews=<?php echo $diap[0]['idnews']?>">
					            <img src="<?php echo $repertoire.$diap[0]['image_news'] ?>" alt="">
					          </a>
					            <div class="carousel-caption">
					              <h3><?php echo $diap[0]['titre_news'] ?></h3>
					              <p> <?php echo $diap[0]['preview_news'] ?></p>
					            </div>
					          </div>

					          <?php 
					          		$i = 1;
					          		while($i<4){			  
					          			$id = $diap[$i]['idnews'];
										$titrenews = htmlspecialchars($diap[$i]['titre_news'], ENT_SUBSTITUTE, "UTF-8");
										$imagenews = htmlspecialchars($diap[$i]['image_news'], ENT_SUBSTITUTE, "UTF-8");
										$preview = htmlspecialchars($diap[$i]['preview_news'], ENT_SUBSTITUTE, "UTF-8");

								?>
								          <div class="item">
								          <a href="index.php?module=news&action=newsby_id&idnews=<?php echo $id?>">
								            <img src="<?php echo $repertoire.$imagenews;?>" alt="">
								          </a>
								            <div class="carousel-caption">
								              <h3><?php echo $titrenews; ?></h3>
								              <p><?php echo $preview; ?></p>
								            </div>
								          </div>
					          <?php
					          			$i++;
					         		}					         	
					         ?>
					        </div>

					        <!-- Left and right controls -->
					        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					          <span class="sr-only">Previous</span>
					        </a>
					        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					          <span class="sr-only">Next</span>
					        </a>
					      </div>
					    </div>
					    
					    <section>
					      <div class="blockDroite col-md-2 col-md-push-10">
						        <div class="row topDiff">
						            <h2>Les mieux notés </h2>
						        </div>

						        <?php 
						        $j=0;
						        while($j<3){
									
										$id_dif = $topdiffu[$j]['idoeuvre'];
										$titreoeuvre = htmlspecialchars($topdiffu[$j]['titre_oeuvre'], ENT_SUBSTITUTE, "UTF-8");								
										?>
									<div class="row">
										<div class="card">
												<?php 	
											foreach($images as $value1){
												$idOeuvre = $value1['idoeuvre'];
												$idIm = $value1['idimage'];
												$image = $value1['image'];

												if($id_dif == $idOeuvre){
													?>
											           <a href="index.php?module=oeuvre&action=liste_oeuvreby_id&idoeuvre=<?php echo $id_dif?>"> 
											           		<img class="card-img-bottom" src="<?php echo $repertoire.$image; ?>" alt=""> 
											           </a>					             										         
												<?php
												}												
											}
										$j++;
												?>	
											 <div class="card-block">
											  	<h4 class="card-title"> <?php echo $titreoeuvre; ?></h4>
											 </div>
										 </div>										          
					       			</div>					      
					      		<?php 
					      			} 
					      		?>					
					      </div>
					      <div class="blockGauche col-md-10 col-md-pull-2">
					      <?php 
									foreach($oeuvres as $lesoeuvres){
										$id = $lesoeuvres['idoeuvre'];
										$titreoeuvre = htmlspecialchars($lesoeuvres['titre_oeuvre'], ENT_SUBSTITUTE, "UTF-8");
										$resume = htmlspecialchars($lesoeuvres['resume_oeuvre'], ENT_SUBSTITUTE, "UTF-8");
									
										?>
									<div class="row">
												<?php 										
											foreach($images as $value1){
												$idOeuvre = $value1['idoeuvre'];
												$idIm = $value1['idimage'];
												$image = $value1['image'];

												if($id == $idOeuvre){
													?>
													<img class="col-md-3" src=" <?php echo $repertoire.$image;?>" alt=""/>
												<?php
												}
											}
												?>
												<div class="col-md-9 textNews">
													<?php echo "<h2>$titreoeuvre</h2>";
											        	 echo " <p> $resume </p><a href=index.php?module=oeuvre&action=liste_oeuvreby_id&idoeuvre=$id>voir plus</a>"?>             
					            				</div>
					       			</div>
					        	<hr>
					      		<?php 
					      			} 
					      		?>
					      </div>
					    </section>  
				<?php
		}
	}
?>
