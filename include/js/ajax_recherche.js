
					            $(document).ready(function() {
					            	$('#recherche').keyup( function(){
					            		$field = $(this);
					            		traitement($field);
					            	});
					            });

					            function traitement($field){

						            $.ajax({
						            	type : 'POST',
						            	url : 'index.php?module=recherche&action=rechercher',
						            	data: {
						            		search:$field.val()
						            	},

						            	success : function(data) {
						            		$('#tab').html(data);
						            	},
						            	error: function(data){
						            		$('#tab').html(data);
						            		alert('Erreur..');
						            	}

						            });
					            }
					       