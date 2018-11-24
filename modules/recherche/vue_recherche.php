<?php
	require_once("include/vue_generique.php");
	require_once("include/controleur_generique.php");

	class VueRecherche extends VueGenerique{
	
		function __construct(){
			parent::__construct();

		}

		// Affiche la liste des résultats d'une recherche.
		function vue_liste_des_recherche($recherche,$images,$term) {
				echo "<ul>";
		?>
					<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
					<link rel="stylesheet" type="text/css" href="modules/recherche/style.css">
					<div class="container">
					    <hgroup class="mb20">
							<h1>Résultat(s)</h1>
							<h2 class="lead"><strong class="text-danger"><?php echo sizeof($recherche); ?></strong> Résultat(s) trouvé pour la recherche <strong class="text-danger"><?php echo $term?></strong></h2>								
						</hgroup>

					    <section class="col-xs-12 col-sm-6 col-md-12">

					    <?php 
					    	foreach($recherche as $find){
								$id = $find['idoeuvre'];
								$titreoeuvre = htmlspecialchars($find['titre_oeuvre'], ENT_SUBSTITUTE, "UTF-8");
								$resume = htmlspecialchars($find['resume_oeuvre'], ENT_SUBSTITUTE, "UTF-8");
								$date = $find['datesortie_oeuvre'];
								$repertoire="image/";
								?>
									<article class="search-result row">
										<div class="col-xs-12 col-sm-12 col-md-3">

										<?php
											foreach($images as $value1){
												$idOeuvre = $value1['idoeuvre'];
												$image = $value1['image'];												
												if($id == $idOeuvre){
														?>
											<a href="index.php?module=oeuvre&action=liste_oeuvreby_id&idoeuvre=<?php echo $id; ?>" class="thumbnail"><img src="<?php echo $repertoire.$image; ?>" alt="Image" /></a>
											<?php
												}
											}
											?>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-2">
											<ul class="meta-search">
												<li><i class="glyphicon glyphicon-calendar"></i> <span><?php echo $date ?></span></li>
											</ul>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-7 excerpet">
											<h3><a href="index.php?module=oeuvre&action=liste_oeuvreby_id&idoeuvre=<?php echo $id; ?>" title=""><?php echo $titreoeuvre ?></a></h3>
											<p><?php echo $resume ?></p>						
							                <span class="plus"><a href="index.php?module=oeuvre&action=liste_oeuvreby_id&idoeuvre=<?php echo $id; ?>" ><i class="glyphicon glyphicon-plus"></i></a></span>
										</div>
										<span class="clearfix borda"></span>
									</article>
						<?php
							}
						?>
						</section>
					</div>					
		<?php

		}

		function tableau_recherche($recherche,$images){

			foreach($recherche as $find){
					$id = $find['idoeuvre'];
					$titreoeuvre = htmlspecialchars($find['titre_oeuvre'], ENT_SUBSTITUTE, "UTF-8");
					$repertoire="image/";

					foreach($images as $value1){
						$idOeuvre = $value1['idoeuvre'];
						$image = $value1['image'];
					
						if($id == $idOeuvre){
							?>
							<img src=" <?php echo $repertoire.$image; ?>" alt=""/>
			<?php
						}
			?>
						<ul class="list-group" id="contact-list">
			                    <li class="list-group-item">
			                        <div class="col-xs-12 col-sm-3">
			                            <img src="<?php echo $repertoire.$image; ?>" alt="images" class="img-responsive img-circle" />
			                        </div>
			                        <div class="col-xs-12 col-sm-9">
			                            <span class="name"><?php echo "<h2>$titreoeuvre</h2>"; ?></span><br/>
			                        </div>
			                        <div class="clearfix"></div>
			                    </li>
			            </ul>

      <?php
      			}
      		}
		}
	}
?>