<?php
	require_once("include/vue_generique.php");
	require_once("include/controleur_generique.php");

	class VueNews extends VueGenerique{
	
		function __construct(){
			parent::__construct();

		}

		// Affiche les news 
		function vue_liste_news($lesnews){

			$repertoire = "image/";
			$image1 = $lesnews[0]['image_news']

			?>				
				<head>
				    <title>News</title>
				    <meta charset="UTF-8"/>
					<link rel="stylesheet" type="text/css" href="modules/news/stylesheet.css"/>
				    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
				</head>
				    <div class="contenu">
				        <h1>News</h1>
				        <div class="news-panel">
				            <div class="first">
				                <div id="firstnews">
				                    <div class="titre. carousel-inner" role="listbox">
				                        <img src="<?php echo $repertoire.$image1; ?>" />
				                        <div class="carousel-caption">
				                            <h3><?php echo $lesnews[0]['titre_news']; ?></h3>
				                            <p><?php echo $lesnews[0]['preview_news']; ?></p>
				                        </div>
				                    </div>
				                </div>
				            </div>
				           
				            <div class="next">
				            	<?php 
					          		$i = 1;
					          		while($i<sizeof($lesnews)){			  
					          			$id = $lesnews[$i]['idnews'];
										$titrenews = htmlspecialchars($lesnews[$i]['titre_news'], ENT_SUBSTITUTE, "UTF-8");
										$imagenews = htmlspecialchars($lesnews[$i]['image_news'], ENT_SUBSTITUTE, "UTF-8");
										$preview = htmlspecialchars($lesnews[$i]['preview_news'], ENT_SUBSTITUTE, "UTF-8");

								?>							           	  
							                <div class="col-md-4">
							                    <img class="news-img-show" src="<?php echo $repertoire.$imagenews; ?>">
							                </div>
							                <div class="col-md-6">
							                    <div class="news-row news-header">
							                        <?php echo $titrenews; ?>
							                        <div class="news-header-seperator"></div>
							                    </div>
							                    <div class="news-row news-desc">
							                       <?php echo $preview; ?>
							                    </div>
							                </div>							               
							          
				            <?php
				            		$i++;
				            		}
				            ?>
				               </div>
				        </div>
				    </div>

	<?php

		}

	}

?>